<?php

namespace App\Http\Controllers\Api;

use App\Helpers\BicSwiftCode;
use App\Helpers\Customer\CreditCard;
use App\Helpers\Customer\Customer;
use App\Helpers\Customer\Wallet;
use App\Http\Controllers\Controller;
use App\Mail\Account\CheckoutCheck;
use App\Mail\Account\DemandeContact;
use App\Mail\Account\UpdateStatusCheck;
use App\Models\Core\Bank;
use App\Models\Customer\CustomerCheck;
use App\Models\Customer\CustomerCreditCard;
use App\Models\Customer\CustomerWallet;
use App\Models\User\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function contact(Request $request)
    {
        $user = User::find($request->get('user_id'));
        foreach (User::where('agent', 1)->get() as $agent) {
            \Mail::to($agent)->send(new DemandeContact($user, $request->get('object'), $request->get('message'), $request->get('response')));
        }

        return response()->json();
    }

    public function bankInfo(Request $request, BicSwiftCode $bicSwiftCode)
    {
        if (\Str::substr($request->get('bic'), 8, 10) == 'XXX') {
            $swift = \Str::substr($request->get('bic'), 0, 8);
        } else {
            $swift = $request->get('bic');
        }
        $bank = $bicSwiftCode->getBankInformationsBySwiftCode($swift);
        $bank_2 = Bank::where('name', 'LIKE', '%' . $bank->first()['bank_name'] . '%')->first();

        return response()->json(["bank" => $bank->first(), "info" => $bank_2]);
    }

    public function simulate(Request $request)
    {
        switch ($request->get('action')) {
            case 'overdraft':
                return $this->overdraft($request);
                break;
        }
    }

    private function overdraft($request)
    {
        sleep(3);
        $r = 0;
        $taux = config("tax.overdraft");
        $incoming = $request->get('incoming');
        $customer = json_decode($request->get('customer'));

        $result = $incoming / 3;

        if ($result <= 300) {
            $r--;
            $reason = "Votre revenue est inférieur à " . eur(1000);
        } else {
            $r++;
        }

        if ($customer->situation->pro_category != "Sans Emploie") {
            $r++;
        } else {
            $r--;
            $reason = "Votre situation professionnel ne permet pas un découvert bancaire";
        }

        if (CustomerWallet::where("customer_id", $customer->id)->get()->sum('balance') >= 0) {
            $r++;
        } else {
            $r--;
            $reason = "La somme de vos comptes bancaires est débiteur.";
        }

        if (CustomerWallet::where('customer_id', $customer->id)->get()->sum('outstanding') > 0) {
            $r--;
            $reason = "Vous avez déjà un découvert";
        } else {
            $r++;
        }

        if ($r == 4) {
            return response()->json([
                "access" => true,
                "value" => $result > 1000 ? 1000 : ceil($result/100)*100,
                "taux" => $taux . " %"
            ]);
        } else {
            return response()->json([
                "access" => false,
                "error" => $reason
            ]);
        }
    }

    public function getCard(Request $request)
    {
        $card = CustomerCreditCard::find($request->get('card_id'));

        $arr = [
            "type" => CreditCard::getType($card->type),
            "brand" => \Str::ucfirst(\Str::lower($card->brand)),
            "support" => \Str::ucfirst(\Str::lower($card->support)),
            "nameCard" => Customer::getName($card->customer),
            "debit" => CreditCard::getDebit($card->debit),
            "card" => $card,
            "numCard" => CreditCard::getCreditCard($card->number, true),
        ];

        return response()->json($arr);
    }

    public function lockCard(Request $request, $number)
    {
        $card = CustomerCreditCard::where('number', $number)->first();

        if($card->status == 'ACTIVE') {
            $card->status = 'INACTIVE';
            $card->save();
        } else {
            $card->status = 'ACTIVE';
            $card->save();
        }

        return $card->status;
    }

    public function getPlafond(Request $request, $number)
    {
        $card = CustomerCreditCard::where('number', $number)->first();
        $payment_month = $card->wallet->transactions()->where('type', 'payment')->where('confirmed', 1)->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->get()->sum('amount');
        $withdraw_month = $card->wallet->transactions()->where('type', 'withdraw')->where('confirmed', 1)->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->get()->sum('amount');

        $payment_dispo = $card->payment_limit - $payment_month;
        $retrait_dispo = $card->withdraw_limit - $withdraw_month;

        $payment_dispo_percent = ($payment_month * 100) / $card->payment_limit;
        $withdraw_dispo_percent = ($withdraw_month * 100) / $card->withdraw_limit;

        return response()->json([
            "payment" => [
                "limit" => eur($card->payment_limit),
                "dispo" => eur($payment_dispo),
                "percent_usage" => $payment_dispo_percent
            ],
            "withdraw" => [
                "limit" => eur($card->withdraw_limit),
                "dispo" => eur($retrait_dispo),
                "percent_usage" => $withdraw_dispo_percent
            ]
        ]);
    }

    public function getCode(Request $request, $number)
    {
        $card = CustomerCreditCard::where('number', $number)->first();
        return response()->json($card->code);
    }

    public function externalPayment($number)
    {
        $card = CustomerCreditCard::where('number', $number)->first();
        if($card->external_payment == 1) {
            $card->external_payment = 0;
            $card->save();
        } else {
            $card->external_payment = 1;
            $card->save();
        }

        return response()->json($card->external_payment);
    }

    public function abroadPayment($number)
    {
        $card = CustomerCreditCard::where('number', $number)->first();
        if($card->abroad_payment == 1) {
            $card->abroad_payment = 0;
            $card->save();
        } else {
            $card->abroad_payment = 1;
            $card->save();
        }

        return response()->json($card->abroad_payment);
    }

    public function storeCheck(Request $request)
    {
        $wallet = CustomerWallet::where('uuid', $request->get('uuid'))->first();
        if($wallet->checks()->count() >= 2) {
            return response()->json([
                "status" => 500,
                "error" => "Votre quota de Chéquier à été atteint"
            ]);
        } else {
            $reference = rand(1000000,9999999);
            $check = $wallet->checks()->create([
                "reference" => $reference,
                "tranche_start" => $reference,
                "tranche_end" => $reference + 40,
                "customer_wallet_id" => $wallet->id,
                "customer_id" => $wallet->customer->id,
                "status" => "checkout"
            ]);

            \Mail::to($check->customer->user)->send(new CheckoutCheck($check->customer, $check));

            return response()->json([
                'reference' => $check->reference,
                'statement' => $check->getStatus($check->status),
                'status' => 200
            ]);
        }

    }

    public function updateStatusCheck(Request $request, $reference)
    {
        $check = CustomerCheck::where('reference', $reference)->first();

        switch ($request->get('status')) {
            case 'checkout':
                $check->status = 'checkout';
                $check->save();
                break;

            case 'manufacture':
                $check->status = 'manufacture';
                $check->save();
                break;

            case 'ship':
                $check->status = 'ship';
                $check->save();
                break;

            case 'outstanding':
                $check->status = 'outstanding';
                $check->save();
                break;

            case 'finish':
                $check->status = 'finish';
                $check->save();
                break;

            case 'destroy':
                $check->status = 'destroy';
                $check->save();
                break;

            default:
                $check->status = 'checkout';
                $check->save();
                break;
        }

        \Mail::to($check->customer->user)->send(new UpdateStatusCheck($check));

        return response()->json();
    }
}

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
use App\Models\Core\DocumentTransmiss;
use App\Models\Core\LoanPlan;
use App\Models\Customer\CustomerCheck;
use App\Models\Customer\CustomerCreditCard;
use App\Models\Customer\CustomerLevy;
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

            case 'facelia':
                return $this->facelia($request);
                break;
        }
    }

    private function facelia($request)
    {
        //dd($request->all());
        //sleep(3);
        if($request->get('type') == 'sim_duration') {
            $amount = $request->get('amount');
            $duration = $request->get('duration');

            $amount_n = $amount / $duration;



            $facelia_interest = LoanPlan::with('interests')->find(1);
            //dd($facelia_interest->interests[0]->percent_interest);
            if($duration <= 3) {
                $interest_amount = $amount * ($facelia_interest->interests[0]->percent_interest / 100) / $duration;
                $taux = $facelia_interest->interests[0]->percent_interest;
            } elseif ($duration > 3 && $duration <= 5) {
                $interest_amount = $amount * ($facelia_interest->interests[1]->percent_interest / 100) / $duration;
                $taux = $facelia_interest->interests[1]->percent_interest;
            } elseif ($duration > 5 && $duration <= 10) {
                $interest_amount = $amount * ($facelia_interest->interests[2]->percent_interest / 100) / $duration;
                $taux = $facelia_interest->interests[2]->percent_interest;
            } elseif ($duration > 10 && $duration <= 20) {
                $interest_amount = $amount * ($facelia_interest->interests[3]->percent_interest / 100) / $duration;
                $taux = $facelia_interest->interests[3]->percent_interest;
            } else {
                $interest_amount = $amount * ($facelia_interest->interests[4]->percent_interest / 100) / $duration;
                $taux = $facelia_interest->interests[4]->percent_interest;
            }

            $mensuality = $amount_n + $interest_amount;
            $capital = $mensuality * $duration;
            if($request->get('insurance') != null) {
                switch ($request->get('insurance')) {
                    case 'D':
                        $assurance = $mensuality * (3.90 / 100);
                        $mensuality = $mensuality + $assurance;
                        break;

                    case 'DIM':
                        $assurance = $mensuality * (6.90 / 100);
                        $mensuality = $mensuality + $assurance;
                        break;

                    case 'DIMC':
                        $assurance = $mensuality * (9.79 / 100);
                        $mensuality = $mensuality + $assurance;
                        break;

                    default:
                        $assurance = 0;
                        $mensuality = $mensuality + $assurance;

                }
            } else {
                $assurance = 0;
                $mensuality = $mensuality + $assurance;
            }

            return response()->json([
                "amount" => $amount,
                "interest" => $interest_amount * $duration,
                "du" => $amount + ($interest_amount * $duration),
                "mensuality" => $duration,
                "amount_mensuality" => $mensuality,
                "taux" => $taux,
                "type_assurance" => $request->get('assurance') != null ? $request->get('insurance') : "Aucune",
                "assurance" => $request->get('assurance') != null ? $assurance : 0
            ]);
            //return response()->json([$interest_amount, $mensuality, $amount_n, $capital]);
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

    public function deleteLevy($uuid)
    {
        $levy = CustomerLevy::where('uuid', $uuid)->first();
        $levy->status = 'rejected';
        $levy->save();

        return response()->json();
    }

    public function getDocument($document_id)
    {
        $document = DocumentTransmiss::find($document_id);

        return response()->json($document);
    }
}

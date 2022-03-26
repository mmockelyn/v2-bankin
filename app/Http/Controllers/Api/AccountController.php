<?php

namespace App\Http\Controllers\Api;

use App\Helpers\BicSwiftCode;
use App\Helpers\Customer\Wallet;
use App\Http\Controllers\Controller;
use App\Mail\Account\DemandeContact;
use App\Models\Core\Bank;
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
                "value" => ceil($result/100)*100,
                "taux" => $taux . " %"
            ]);
        } else {
            return response()->json([
                "access" => false,
                "error" => $reason
            ]);
        }
    }
}

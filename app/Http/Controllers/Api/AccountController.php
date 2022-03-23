<?php

namespace App\Http\Controllers\Api;

use App\Helpers\BicSwiftCode;
use App\Http\Controllers\Controller;
use App\Mail\Account\DemandeContact;
use App\Models\Core\Bank;
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
        if(\Str::substr($request->get('bic'), 8,10) == 'XXX') {
            $swift = \Str::substr($request->get('bic'), 0, 8);
        } else {
            $swift = $request->get('bic');
        }
        $bank = $bicSwiftCode->getBankInformationsBySwiftCode($swift);
        $bank_2 = Bank::where('name', 'LIKE', '%'.$bank->first()['bank_name'].'%')->first();

        return response()->json(["bank" => $bank->first(), "info" => $bank_2]);
    }
}

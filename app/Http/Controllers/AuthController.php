<?php

namespace App\Http\Controllers;

use App\Models\Customer\CustomerIndividual;
use App\Services\Stripe;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function verifyIdentity(Request $request, Stripe $stripe)
    {
        $session = $stripe->client->identity->verificationSessions->create([
            "type" => "document",
            "metadata" => [
                "user_id" => $request->user()->id
            ]
        ]);
        return view("auth.verifyIdentity", [
            "client_secret" => $session->client_secret
        ]);
    }

    public function authCode(Request $request)
    {
        $customer = CustomerIndividual::where('customer_id', $request->user()->customer->id)->first();

        $customer->identityVerify = 1;
        $customer->save();

        return view("auth.authCode");
    }

    public function authCodeInsert(Request $request)
    {
        $request->user()->customer()->update([
            "auth_code" => base64_encode($request->get('auth_code')),
            "status_open_account" => "completed"
        ]);

        return redirect()->route('suivi');
    }

    public function code(Request $request)
    {
        return view('auth.code', [
            "uri_previous" => $request->has('uri_previous') ? $request->get('uri_previous') : null
        ]);
    }

    public function codeVerify(Request $request)
    {
        if(base64_decode($request->user()->customer->auth_code) == $request->get('auth_code')) {
            session()->put('auth.authCode_confirmed_at', time());
            return redirect()->to(url()->previous(-2), '', '', '');
        } else {
            return redirect()->back()->with('error', "Code Invalide");
        }
    }
}

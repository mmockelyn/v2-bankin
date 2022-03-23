<?php

namespace App\Http\Controllers\Front;

use App\Helpers\Customer\CreditCard;
use App\Helpers\Customer\Transaction;
use App\Http\Controllers\Controller;
use App\Models\Customer\CustomerWallet;
use App\Services\Stripe;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('front.index');
    }

    public function suivi(Request $request)
    {
        return view('front.suivi');
    }

    public function checkout(Request $request, Stripe $stripe)
    {
        //dd($request->all());
        if($request->get('amount') <= 10 || $request->get('amount') >= 500) {
            return redirect()->back()->with('error', "Le montant doit être compris entre 10 € et 500 € Maximum !");
        } else {
            $wallet = CustomerWallet::where('uuid', $request->get('number_account'))->first();
            $session = $stripe->client->checkout->sessions->create([
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => 'Alimentation initial du compte N°'.$wallet->number_account,
                        ],
                        'unit_amount' => $request->get('amount') * 100,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('checkout.success', ["wallet" => $wallet->number_account, "amount" => $request->get('amount')]),
                'cancel_url' => route('checkout.cancel'),
                'metadata' => [
                    "number_account" => $wallet->number_account
                ],
                'payment_method_types' => ["card", "sepa_debit"]
            ]);


            return redirect()->to($session->url, 303);
        }
    }

    public function checkoutSuccess(Request $request, Transaction $transaction, CreditCard $card)
    {
        $wallet = CustomerWallet::where('number_account', $request->get('wallet'))->first();
        $package = $wallet->customer->package;
        $transaction->create("credit","deposit","Alimentation Initial du compte bancaire", $request->get('amount'), $wallet->id, 2, 11, null, true);
        if($package->price != 0) {
            $transaction->create("debit","fee","Cotisation Pack ".$package->name, $package->price, $wallet->id, 2, 8, null);
        }

        $wallet->customer->status_open_account = 'terminated';
        $wallet->customer->save();

        $wallet->status = "ACTIVE";
        $wallet->save();

        $card->createCard($wallet, 'physical', 'CLASSIC', "IMMEDIATE");

        return redirect()->route('suivi');
    }

    public function checkoutCancel()
    {
        return redirect()->route('suivi')->with('error', "Vous avez annuler votre dépot d'argent");
    }
}

<?php

namespace App\Http\Controllers\Account;

use App\Helpers\Customer\CreditCard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return view('account.payment.index');
    }

    public function add_cart(Request $request)
    {
        //dd($request->all());
        $customer = $request->user()->customer;

        if ($customer->cards()->get()->count() > $customer->setting->nb_carte_physique) {
            return redirect()->back()->with('error', 'Quota de carte bancaire physique dépasser. Veuillez contacter le service commercial');
        } else {
            $credit_cart = new CreditCard();
            try {
                $credit_cart->createCard($customer->wallets()->find($request->get('customer_wallet_id')), 'VISA', $request->get('support'),
                    $request->get('debit'));

                return redirect()->back()->with('success', "Votre nouvelle carte bancaire vient de vous être attribuer");
            }catch (\Exception $exception) {
                \Log::critical($exception);
                return redirect()->back()->with('error', "Erreur lors de la commande de votre carte bancaire");
            }
        }
    }

    public function virtual(Request $request)
    {
        return view('account.payment.virtual.index');
    }
}

<?php

namespace App\Http\Controllers\Account;

use App\Helpers\Customer\DocumentFile;
use App\Helpers\Customer\Loan;
use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;
use App\Models\Customer\CustomerLoan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;
use Twilio\Rest\Client;

class SubscriptionController extends Controller
{
    public function index(Request $request)
    {
        //dd($request->all());
        if(url()->previous() == '/auth/code/verify') {
            dd($request->all());
            $document = $request->user()->customer->documents()->get()->latest();
            return view('account.subscribe.signate', [
                "customer" => $request->user()->customer,
                "wallet" => $request->user()->customer->wallets()->first(),
                "contract" => $document
            ]);
        }

        return view('account.subscribe.index');
    }

    public function store(Request $request)
    {

        switch ($request->get('action')) {
            case 'overdraft':
                return $this->storeOverdraft($request);
                break;

            case 'facelia':
                return $this->storeFacelia($request);

        }
    }

    public function overdraft(Request $request)
    {
        return view("account.subscribe.overdraft", [
            "customer" => $request->user()->customer
        ]);
    }

    public function subscribe(Request $request)
    {
        switch ($request->get('type') == 'facelia') {
            case 'facelia':
                return view('account.subscribe.loan.facelia');
        }
    }

    public function loanSignate(Request $request, $uuid)
    {
        $loan = CustomerLoan::where('uuid', $uuid)->first();

        $twillo = new Client(config('twilio-notification-channel.account_sid'), config('twilio-notification-channel.auth_token'));
        $verif = $twillo->verify->v2->services('VA29791f087369ca5f8c19e5629b40665e')
            ->verifications
            ->create(\App\Helpers\Customer\Customer::getPhone($loan->customer), "sms");

        return view('account.subscribe.loan.signate', [
            "loan" => $loan,
            "verif" => $verif->url
        ]);
    }

    private function storeOverdraft($request)
    {
        Carbon::setLocale('fr');
        $customer = Customer::find(json_decode($request->get('customer'))->id);
        $wallet = $customer->wallets()->where('type', 'account')->where("status", "ACTIVE")->first();
        if(isset($wallet)) {
            // Définie Overdraft
            $wallet->outstanding = $request->get('amount');
            $wallet->save();

            try {
                $pdf = $this->generateContract("overdraft", $customer);
                //dd($customer, $wallet, $pdf);
                return view('account.subscribe.signate', [
                    "customer" => $customer,
                    "wallet" => $wallet,
                    "contract" => $pdf
                ]);
            }catch (\Exception $exception) {
                return redirect()->back()->with("error", $exception->getMessage());
            }
        } else {
            return redirect()->back()->with('warning', "Aucun Comptes actif");
        }
    }

    private function storeFacelia($request)
    {
        Carbon::setLocale('fr');
        $loan = new Loan();

        $simulate = $loan->simulate($request->get('amount'), $request->get('duration'), $request->get('insurance'));

        $check = $loan->checkAvailibilityContract($simulate, $request->user()->customer);

        if($check == 'DECLINED') {
            $contract = $loan->create(
                $request->get('amount'), $simulate['interest'], $simulate['du'], $simulate['amount_mensuality'], $simulate['mensuality'], $request->get('insurance'), 1, $request->user()->customer->wallets()->first()->id, $request->user()->customer->id, 3
            );
            $template = '
            <div class="card shadow-sm">
                <div class="card-header bg-danger">
                    <h3 class="card-title text-white">Votre demande de crédit renouvellable FACELIA</h3>

                </div>
                <div class="card-body">
                    <p>
                    Nous avons bien reçu votre de financement d\'un montant de '.eur($request->get("amount")).' et nous en remercions.<br>
                    Toutefois, votre situation actuel ne nous permet pas de répondre favorablement à votre demande.
                    </p>
                </div>
            </div>
            ';
        } elseif ($check == 'WAITING') {
            $contract = $loan->create(
                $request->get('amount'), $simulate['interest'], $simulate['du'], $simulate['amount_mensuality'], $simulate['mensuality'], $request->get('insurance'), 1, $request->user()->customer->wallets()->first()->id, $request->user()->customer->id, 1
            );
            $template = '
            <div class="card shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-white">Votre demande de crédit renouvellable FACELIA</h3>

                </div>
                <div class="card-body">
                    <p>
                    Nous avons bien reçu votre de financement d\'un montant de '.eur($request->get("amount")).' et nous en remercions.<br>
                    Nous ne pouvons donner une suite favorable immédiatement.<br>
                    Notre équipe va étudier votre dossier, et nous reviendrons vers vous le plus rapidement possible (Entre 12h et 24h).
                    </p>
                </div>
            </div>
            ';
        } else {
            $contract = $loan->create(
                $request->get('amount'), $simulate['interest'], $simulate['du'], $simulate['amount_mensuality'], $simulate['mensuality'], $request->get('insurance'), 1, $request->user()->customer->wallets()->first()->id, $request->user()->customer->id, 2
            );
            $template = '
            <div class="card shadow-sm">
                <div class="card-header bg-success">
                    <h3 class="card-title text-white">Votre demande de crédit renouvellable FACELIA</h3>

                </div>
                <div class="card-body">
                    <p>
                    Nous avons bien reçu votre de financement d\'un montant de '.eur($request->get("amount")).' et nous en remercions.<br>
                    Votre demande à été étudier et nous pouvons donner une suite favorable.<br>
                    Vous allez recevoir un email avec un lien afin de signer vos document contractuel.
                    </p>
                </div>
            </div>
            ';
        }

        return response()->json($template);
    }

    private function generateContract($type, $customer)
    {
        $agence = $customer->user->agence;
        $header = view()
            ->make("agence.pdf.header_basic")
            ->with('agence', $agence)
            ->with('customer', $customer)
            ->render();

        $file = new DocumentFile();

        switch ($type) {
            case "overdraft":
                $name = "Autorisation de découvert N°".$customer->wallets()->first()->number_account;

                $document = $file->createDocument(
                    $name, $customer, 3, true, null
                );

                $pdf = PDF::loadView('agence.pdf.contract.loan.decouvert', compact('agence', 'customer', 'document'));
                $pdf->setOption('enable-local-file-access', true);
                $pdf->setOption('viewport-size','1280x1024');
                $pdf->setOption('header-html', $header);
                $pdf->setOption('footer-right','[page]/[topage]');
                $pdf->setOption('footer-font-size',8);
                $pdf->setOption('margin-left',0);
                $pdf->setOption('margin-right',0);
                $pdf->save(public_path('/storage/gdd/'.$customer->id.'/contract/'.\Str::slug($name).'.pdf'), true);

                return $document;
                break;
        }
    }
}

<?php

namespace App\Http\Controllers\Account;

use App\Helpers\Customer\DocumentFile;
use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class SubscriptionController extends Controller
{
    public function index(Request $request)
    {
        dd($request->all());
        if(url()->previous() == '/auth/code/verify') {
            dd($request->all());
            $document = $request->user()->customer->documents()->get()->latest();
            return view('account.subscribe.signate', [
                "customer" => $request->user()->customer,
                "wallet" => $request->user()->customer->wallets()->first(),
                "contract" => $document
            ]);
        }
    }

    public function store(Request $request)
    {

        switch ($request->get('action')) {
            case 'overdraft':
                return $this->storeOverdraft($request);
                break;

        }
    }

    public function overdraft(Request $request)
    {
        return view("account.subscribe.overdraft", [
            "customer" => $request->user()->customer
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
                    $name,
                    $customer,
                    3,
                    true
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

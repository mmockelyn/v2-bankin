<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SubscriptionController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request)
    {
        switch ($request->get('action')) {
            case 'overdraft':
                $this->storeOverdraft($request);
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
                return $this->generateContract("overdraft", $customer);
            }catch (\Exception $exception) {
                return redirect()->back()->with("error", $exception->getMessage());
            }
        } else {
            return redirect()->back()->with('warning', "Aucun Comptes actif");
        }
    }

    private function generateContract($type, $customer)
    {
        switch ($type) {
            case "overdraft":
                $agence = $customer->user->agence;
                //dd($agence);


                $pdf = Pdf::loadView('agence.pdf.contract.loan.decouvert', compact('customer', 'agence'))
                    ->setOptions(["enable-local-file-access" => true])
                    ->setOptions(["viewport-size" => "1280x1024"])
                    ->setOptions(["footer-right" => ["[page]/[topage]"]])
                    ->setOptions(["footer-font-size" => 8])
                    ->setOptions(["margin-left" => 0])
                    ->setOptions(["margin-right" => 0]);

                $pdf->save(public_path('/storage/gdd/'.$customer->id."/contract/decouvert.pdf"));
                return $pdf->stream("decouvert.pdf");
                break;
        }
    }
}

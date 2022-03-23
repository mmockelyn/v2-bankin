<?php

namespace App\Http\Controllers\Account;

use App\Helpers\Customer\Transaction;
use App\Http\Controllers\Controller;
use App\Models\Customer\CustomerBeneficiaire;
use App\Models\Customer\CustomerWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TransferController extends Controller
{
    public function index(Request $request)
    {
        return view('account.transfer.index');
    }

    public function create(Request $request)
    {
        $wallets = $request->user()->customer->wallets;
        $beneficiaires = $request->user()->customer->beneficiaires();

        if($request->has('beneficiaire')) {
            $beneficiaire_s = $beneficiaires->where('uuid', $request->get('beneficiaire'))->first();

            return view("account.transfer.create", compact('wallets', 'beneficiaires', 'beneficiaire_s'));
        } elseif($request->has('amount')) {
            $beneficiaires = $beneficiaires->get();
            return view("account.transfer.create", compact('wallets', 'beneficiaires'));
        }

        $beneficiaires = $beneficiaires->get();

        return view("account.transfer.create", compact('wallets', 'beneficiaires'));
    }

    public function store(Request $request, Transaction $transaction)
    {
        //Vérification du formulaire du virement
        $request->validate([
            "amount" => ["required", "string"],
            "from" => ["required"],
            "to" => ["required"],
            "type" => ["required"],
            "reason" => ["required", "string"]
        ]);

        // Création du virement

        $wallet = CustomerWallet::where('uuid', $request->get('from'))->first();
        $bene_to = CustomerBeneficiaire::where('uuid', $request->get('to'))->first();
        $transfer = $wallet->transfers()->create([
            "amount" => $request->get('amount'),
            "reference" => \Str::upper(\Str::random(8)),
            "reason" => $request->get('reason'),
            "type" => $request->get('type'),
            "customer_wallet_id" => $wallet->id,
            "customer_beneficiaire_id" => $bene_to->id
        ]);

        if($transfer->type == 'immediat') {
            // Vérifie le solde du compte
            if (($wallet->balance + $wallet->outstanding) < $transfer->amount) {
                $transfer->status = 'pending';
                $transfer->save();
            } else {
                $transfer->status = 'in_transit';
                $transfer->save();
            }$transaction->create('debit','transfer', $transfer->reason, $transfer->amount, $wallet->id, 2, 11, null, false, null, null, false);
        } elseif($transfer->type == 'differed') {
            $transfer->status = 'pending';
            $transfer->transfer_date = $request->get('transfer_date');
            $transfer->save();
            $transaction->create('debit','transfer', $transfer->reason, $transfer->amount, $wallet->id, 2, 11, null, false, null, $request->get('transfer_date'), false);
        } else {
            $transfer->status = 'pending';
            $transfer->recurring_start = $request->get('recurring_start');
            $transfer->recurring_end = $request->get('recurring_end');
            $transfer->save();


            $diff = $transfer->recurring_start->diffInMonths($transfer->recurring_end);

            for ($i=0; $i <= $diff; $i++) {
                $date_start = Carbon::createFromTimestamp(strtotime($request->get('recurring_start')));
                $wallet->transfers()->create([
                    "amount" => $request->get('amount'),
                    "reference" => \Str::upper(\Str::random(8)),
                    "reason" => $request->get('reason'),
                    "type" => $request->get('type'),
                    "customer_wallet_id" => $wallet->id,
                    "customer_beneficiaire_id" => $bene_to->id,
                    "transfer_date" => $date_start->addMonths($i)
                ]);
            }
        }

        return redirect()->route('account.transfer.index')->with('success', "Votre virement à été enregistrer avec succès");
    }

    public function history(Request $request)
    {
        return view("account.transfer.history");
    }
}

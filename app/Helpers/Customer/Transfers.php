<?php


namespace App\Helpers\Customer;


use App\Models\Customer\CustomerTransfer;

class Transfers
{
    public static function recurringTransfer()
    {
        $transfers = CustomerTransfer::with('wallet')->where('type', 'permanent')->where('transfer_date', '!=', null)->get();
        $transaction = new Transaction();

        foreach ($transfers as $transfer) {
            if($transfer->transfer_date == now()->startOfDay()) {
                $transfer->status = 'in_transit';
                $transfer->save();

                $transaction->create('debit', 'transfer', $transfer->reason, $transfer->amount, $transfer->wallet->id, 2, 11, null, false, null, $transfer->transfer_date->addDay(), true);
            }
        }
    }

    public static function getStatusLabel($status)
    {
        switch ($status) {
            case 'paid':
                return "<span class='badge badge-lg badge-success'>Virement Exécuter</span>";
                break;

            case 'pending':
                return "<span class='badge badge-lg badge-warning'>Virement en attente</span>";
                break;

            case 'in_transit':
                return "<span class='badge badge-lg badge-info'>Virement en cours</span>";
                break;

            case 'canceled':
                return "<span class='badge badge-lg badge-danger'>Virement Annuler</span>";
                break;

            case 'failed':
                return "<span class='badge badge-lg badge-danger'>Virement Refusé</span>";
        }
    }
}

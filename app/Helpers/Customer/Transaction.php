<?php


namespace App\Helpers\Customer;


use App\Models\Customer\CustomerTransaction;
use App\Models\Customer\CustomerWallet;
use App\Notifications\Customer\Transaction\CreatedTransaction;

class Transaction
{
    public function create($type, $type_transaction, $description, $amount, $wallet, $category, $subcategory_id, $meta = [], $confirm = true, $designation = null, $confirmed_at = null, $notif = true)
    {
        if($type == 'debit') {
            CustomerTransaction::create([
                "uuid" => \Str::uuid(),
                "type" => $type_transaction,
                "friendlyName" => $designation,
                "name" => $description,
                "amount" => 0.00 - (float)$amount,
                "confirmed" => $confirm,
                "metadata" => $meta,
                "customer_wallet_id" => $wallet,
                "category_id" => $category,
                "subcategory_id" => $subcategory_id,
                "confirmed_at" => $confirmed_at
            ]);
        } else {
            CustomerTransaction::create([
                "uuid" => \Str::uuid(),
                "type" => $type_transaction,
                "friendlyName" => $designation,
                "name" => $description,
                "amount" => $amount,
                "confirmed" => $confirm,
                "metadata" => $meta,
                "customer_wallet_id" => $wallet,
                "category_id" => $category,
                "subcategory_id" => $subcategory_id,
                "confirmed_at" => $confirmed_at
            ]);
        }

        $transaction = CustomerTransaction::with('wallet')->latest()->first();

        $wallet = CustomerWallet::find($wallet);
        if($confirm == true) {
            $wallet->balance += $transaction->amount;
            $wallet->save();
        } else {
            $wallet->balance_coming += $amount;
            $wallet->save();
        }

        if($notif == true) {
            $wallet->customer->user->notify(new CreatedTransaction($wallet->customer->user, $transaction));
        }

        return $transaction;
    }
}

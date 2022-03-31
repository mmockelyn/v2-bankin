<?php


namespace App\Helpers\Customer;


use App\Helpers\IbanGenerator;
use App\Models\Customer\CustomerWallet;

class Wallet
{
    public function create($customer, $agency)
    {
        $iban = new IbanGenerator();
        $customer = \App\Models\Customer\Customer::find($customer);
        return CustomerWallet::create([
            "uuid" => \Str::uuid(),
            "number_account" => rand(10000000000,99999999999),
            "type" => "account",
            "status" => "PENDING",
            "iban" => $iban->generate(10, $customer),
            "customer_id" => $customer->id,
            "agency_id" => $agency
        ]);
    }

    public static function formatNameAccountForSelect($wallet)
    {
        switch ($wallet->type) {
            case 'account':
                $type = "Compte Courant"; break;

            case 'loan':
                $type = "Crédit"; break;

            case 'investment':
                $type = "Compte épargne"; break;
        }

        return $type." - ".$wallet->number_account;
    }
}

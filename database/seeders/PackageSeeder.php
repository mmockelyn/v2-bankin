<?php

namespace Database\Seeders;

use App\Models\Core\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Package::create(['name' => "Essentiel", "price" => 0, "type_prlv" => "MENSUAL", 'type' => "pack",
            "visa_classic" => true,
            "check_deposit" => true,
            "payment_withdraw" => true,
            "overdraft" => false,
            "cash_deposit" => false,
            "withdraw_international" => false,
            "payment_international" => false,
            "payment_insurance" => false,
            "check" => false,
            "nb_carte_physique" => 1,
            "nb_carte_virtuel" => 0
        ]);

        Package::create(['name' => "Confort", "price" => 3.50, "type_prlv" => "MENSUAL", 'type' => "pack",
            "visa_classic" => true,
            "check_deposit" => true,
            "payment_withdraw" => true,
            "overdraft" => true,
            "cash_deposit" => true,
            "withdraw_international" => true,
            "payment_international" => false,
            "payment_insurance" => false,
            "check" => false,
            "nb_carte_physique" => 3,
            "nb_carte_virtuel" => 1
        ]);

        Package::create(['name' => "Premium", "price" => 9.90, "type_prlv" => "MENSUAL", 'type' => "pack",
            "visa_classic" => true,
            "check_deposit" => true,
            "payment_withdraw" => true,
            "overdraft" => true,
            "cash_deposit" => true,
            "withdraw_international" => true,
            "payment_international" => true,
            "payment_insurance" => true,
            "check" => true,
            "nb_carte_physique" => 99,
            "nb_carte_virtuel" => 99
            ]);
    }
}

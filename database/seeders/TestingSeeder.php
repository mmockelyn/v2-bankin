<?php

namespace Database\Seeders;

use App\Models\Core\Agency;
use App\Models\Customer\Customer;
use App\Models\Customer\CustomerBeneficiaire;
use App\Models\Customer\CustomerBeneficiaireBank;
use App\Models\Customer\CustomerCompany;
use App\Models\Customer\CustomerCreditCard;
use App\Models\Customer\CustomerIndividual;
use App\Models\Customer\CustomerSetting;
use App\Models\Customer\CustomerSituation;
use App\Models\Customer\CustomerTransaction;
use App\Models\Customer\CustomerWallet;
use App\Models\User\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TestingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PackageSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SubcategorySeeder::class);
        $this->call(LoanPlanSeeder::class);
        \Artisan::call("bridge:import");

        $users = User::factory(rand(5, 15))->create();
        $agence = Agency::factory()->create();

        foreach ($users as $user) {
            $customer = Customer::factory()->create(["user_id" => $user->id]);
            if($customer->type_account == "INDIVIDUAL"){
                $c = CustomerIndividual::factory()->create(["customer_id" => $customer->id]);
                $customer->friendlyName = $c->firstname.' '.$c->lastname;
                $customer->save();
            } else {
                $c = CustomerCompany::factory()->create(["customer_id" => $customer->id]);
                $customer->friendlyName = $c->name;
                $customer->save();
            }

            if ($customer->status_open_account == 'terminated') {

                $wallet = CustomerWallet::factory()->create([
                    "customer_id" => $customer->id,
                    "agency_id" => $agence->id,
                ]);

                CustomerCreditCard::factory(rand(1,5))->create([
                    "customer_wallet_id" => $wallet->id,
                    "customer_id" => $customer->id
                ]);

                $transactions = CustomerTransaction::factory(rand(10,100))->create([
                    "customer_wallet_id" => $wallet->id
                ]);

                foreach ($transactions as $transaction) {
                    if($transaction->confirmed == true) {
                        $wallet->balance = $wallet->balance + $transaction->amount;
                        $wallet->save();
                    } else {
                        $wallet->balance_coming = $wallet->balance_coming + $transaction->amount;
                        $wallet->save();
                    }
                }

                CustomerSetting::factory()->create([
                    "customer_id" => $customer->id
                ]);

                CustomerSituation::factory()->create([
                    "customer_id" => $customer->id
                ]);

                $beneficiaires = CustomerBeneficiaire::factory(rand(1,10))->create([
                    "customer_id" => $customer->id
                ]);

                foreach ($beneficiaires as $beneficiaire) {
                    CustomerBeneficiaireBank::factory()->create([
                        "customer_beneficiaire_id" => $beneficiaire->id
                    ]);
                }
            }

        }

        $agent = User::create([
            "name" => "Mockelyn Maxime",
            "email" => "mmockelyn@bzhm.tk",
            "password" => \Hash::make("rbU89a-4"),
            "agency_id" => 1,
            "agent" => 1,
            "identifiant" => Str::upper(Str::random(10))
        ]);
    }
}

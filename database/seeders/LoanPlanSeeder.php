<?php

namespace Database\Seeders;

use App\Models\Core\LoanPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoanPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LoanPlan::query()->create([
            "name" => "Credit Renouvelable Facelia",
            "min_amount" => 500.00,
            "max_amount" => 5000.00,
            "max_duration" => 3,
            "instruction" => "Crédit Renouvelable"
        ])->interests()->create([
            "percent_interest" => 5.99,
            "duration" => 3,
            "loan_plan_id" => 1
        ])->create([
            "percent_interest" => 7.97,
            "duration" => 5,
            "loan_plan_id" => 1
        ])->create([
            "percent_interest" => 11.25,
            "duration" => 10,
            "loan_plan_id" => 1
        ])->create([
            "percent_interest" => 14.76,
            "duration" => 20,
            "loan_plan_id" => 1
        ])->create([
            "percent_interest" => 19.12,
            "duration" => 36,
            "loan_plan_id" => 1
        ]);

        LoanPlan::query()->create([
            "name" => "Credit Travaux",
            "min_amount" => 500.00,
            "max_amount" => 35000.00,
            "max_duration" => 7,
            "instruction" => "Credit Travaux Personnel"
        ])->interests()->create([
            "percent_interest" => 0.4,
            "duration" => 12,
            "loan_plan_id" => 2
        ])->create([
            "percent_interest" => 2.99,
            "duration" => 24,
            "loan_plan_id" => 2
        ])->create([
            "percent_interest" => 4.91,
            "duration" => 84,
            "loan_plan_id" => 2
        ]);

        LoanPlan::query()->create([
            "name" => "Credit Auto-Moto",
            "min_amount" => 500.00,
            "max_amount" => 35000.00,
            "max_duration" => 7,
            "instruction" => "Credit Auto-Moto Personnel"
        ])->interests()->create([
            "percent_interest" => 0.4,
            "duration" => 12,
            "loan_plan_id" => 3
        ])->create([
            "percent_interest" => 2.99,
            "duration" => 24,
            "loan_plan_id" => 3
        ])->create([
            "percent_interest" => 4.91,
            "duration" => 84,
            "loan_plan_id" => 3
        ]);

        LoanPlan::query()->create([
            "name" => "Credit Immobilier",
            "min_amount" => 500.00,
            "max_amount" => 99999.00,
            "max_duration" => 25,
            "instruction" => "Credit Travaux Personnel"
        ])->interests()->create([
            "percent_interest" => 0.4,
            "duration" => 24,
            "loan_plan_id" => 4
        ])->create([
            "percent_interest" => 2.99,
            "duration" => 96,
            "loan_plan_id" => 4
        ])->create([
            "percent_interest" => 4.91,
            "duration" => 300,
            "loan_plan_id" => 4
        ]);
    }
}

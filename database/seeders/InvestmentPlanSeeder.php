<?php

namespace Database\Seeders;

use App\Models\Core\InvestmentPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvestmentPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InvestmentPlan::query()->create([
            "name" => "Livret A",
            "percent_rate" => 1,
            "interest_place" => "quinzaine",
            "limit" => 22500.00
        ])->create([
            "name" => "Livret LLDS / Livret Développement Durable",
            "percent_rate" => 1,
            "interest_place" => "quinzaine",
            "limit" => 12000.00
        ])->create([
            "name" => "Livret Carte Epargne",
            "percent_rate" => 0.01,
            "interest_place" => "quinzaine",
            "limit" => null
        ]);
    }
}

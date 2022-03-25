<?php

namespace Database\Seeders;

use App\Models\Core\Agency;
use App\Models\Core\Bank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $agencies = Agency::query()
            ->create([
                "bic" => "BZHMFRPPXXX",
                "name" => "FINBANK NET",
                "ville" => "Nantes",
                "country" => "FR",
                "code_banque" => rand(10000,90000),
                "code_guichet" => rand(10000,90000)
            ])->create([
                "bic" => "BZHMFRPPNAN",
                "name" => "FINBANK GRAND OUEST",
                "ville" => "Nantes",
                "country" => "FR",
                "code_banque" => rand(10000,90000),
                "code_guichet" => rand(10000,90000)
            ]);

        $agences = Agency::all();

        foreach ($agences as $agency) {
            Bank::query()->create([
                "bridge_id" => 506,
                "name" => $agency->name,
                "logo" => config('app.url').'/storage/logo_carre_80.png',
                "primary_color" => "5ec4ff",
                "country" => $agency->country,
                "bic" => $agency->bic
            ]);
        }
    }
}

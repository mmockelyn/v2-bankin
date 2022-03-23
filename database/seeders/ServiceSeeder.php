<?php

namespace Database\Seeders;

use App\Models\Core\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create(["name" => "Abonnement Alert PLUS", "price" => 2.00, "type_prlv" => "MENSUAL"]);
        Service::create(["name" => "Tenue de compte", "price" => 0, "type_prlv" => "TRIM"]);
        Service::create(["name" => "Comission Intervention", "price" => 2.50, "type_prlv" => "PONCTUAL"]);
        Service::create(["name" => "Ouverture d'un Livret A Supplémentaire", "price" => 15.00, "type_prlv" => "PONCTUAL"]);
        Service::create(["name" => "Ouverture d'un Livret LLDS Supplémentaire", "price" => 15.00, "type_prlv" => "PONCTUAL"]);
        Service::create(["name" => "Carte physique supplémentaire", "price" => 25.00, "type_prlv" => "PONCTUAL"]);
        Service::create(["name" => "Carte virtuel supplémentaire", "price" => 10.00, "type_prlv" => "PONCTUAL"]);
    }
}

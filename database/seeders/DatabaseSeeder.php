<?php

namespace Database\Seeders;

use App\Models\Core\Agency;
use App\Models\Core\DocumentCategory;
use App\Models\User\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AgencySeeder::class);
        $this->call(PackageSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SubcategorySeeder::class);
        $this->call(LoanPlanSeeder::class);
        $this->call(DocumentCategorySeeder::class);
        \Artisan::call("bridge:import");
        //\Artisan::call("import:car");

        $agent = User::create([
            "name" => "Mockelyn Maxime",
            "email" => "mmockelyn@bzhm.tk",
            "password" => \Hash::make("rbU89a-4"),
            "agency_id" => 1,
            "agent" => 1,
            "identifiant" => Str::upper(Str::random(10))
        ]);

        clear();
    }
}

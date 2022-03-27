<?php

namespace Database\Seeders;

use App\Models\Core\DocumentCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DocumentCategory::query()->create([
            "name" => "Assurance"
        ])->create([
            "name" => "Comptes"
        ])->create([
            "name" => "Contrats Signés"
        ])->create([
            "name" => "Courriers"
        ]);
    }
}

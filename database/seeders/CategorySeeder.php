<?php

namespace Database\Seeders;

use App\Models\Core\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(["name" => "Alimentation", "color" => "danger", "icon" => "fa-shopping-cart"]);
        Category::create(["name" => "Banque et assurance", "color" => "primary", "icon" => "fa-university"]);
        Category::create(["name" => "Education & Famille", "color" => "danger", "icon" => "fa-users"]);
        Category::create(["name" => "Epargne", "color" => "success", "icon" => "fa-hand-holding-usd"]);
        Category::create(["name" => "Impot & Taxes", "color" => "info", "icon" => "fa-percent"]);
        Category::create(["name" => "Juridique & Administratif", "color" => "primary", "icon" => "fa-balance-scale"]);
        Category::create(["name" => "Logement & Maison", "color" => "danger", "icon" => "fa-house-user"]);
        Category::create(["name" => "Loisirs & Vacances", "color" => "primary", "icon" => "fa-umbrella-beach"]);
        Category::create(["name" => "Revenus & rentrées d'argent", "color" => "info", "icon" => "fa-wallet"]);
        Category::create(["name" => "Santé", "color" => "success", "icon" => "fa-hand-holding-heart"]);
        Category::create(["name" => "Shopping & Services", "color" => "warning", "icon" => "fa-shopping-bag"]);
        Category::create(["name" => "Transaction Exclue", "color" => "gray-700", "icon" => "fa-times-circle"]);
        Category::create(["name" => "Transport", "color" => "primary", "icon" => "fa-bus"]);
    }
}

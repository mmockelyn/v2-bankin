<?php

namespace Database\Seeders;

use App\Models\Core\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subcategory::create(["category_id" => 1, "name" => "Hypermarché", "color" => "danger", "icon" => null]);
        Subcategory::create(["category_id" => 1, "name" => "Commerçant", "color" => "danger", "icon" => null]);
        Subcategory::create(["category_id" => 1, "name" => "Restaurant", "color" => "danger", "icon" => null]);
        Subcategory::create(["category_id" => 1, "name" => "Restauration Rapide", "color" => "danger", "icon" => null]);
        Subcategory::create(["category_id" => 1, "name" => "Alimentation - Autre", "color" => "danger", "icon" => null]);

        Subcategory::create(["category_id" => 2, "name" => "Crédit", "color" => "primary", "icon" => null]);
        Subcategory::create(["category_id" => 2, "name" => "Crédit Consommation", "color" => "primary", "icon" => null]);
        Subcategory::create(["category_id" => 2, "name" => "Frais Bancaire", "color" => "primary", "icon" => null]);
        Subcategory::create(["category_id" => 2, "name" => "Frais d'incident", "color" => "primary", "icon" => null]);
        Subcategory::create(["category_id" => 2, "name" => "Titre", "color" => "primary", "icon" => null]);
        Subcategory::create(["category_id" => 2, "name" => "Autre", "color" => "primary", "icon" => null]);

        Subcategory::create(["category_id" => 3, "name" => "Assurance scolaire", "color" => "danger", "icon" => null]);
        Subcategory::create(["category_id" => 3, "name" => "Fournitures scolaire", "color" => "danger", "icon" => null]);
        Subcategory::create(["category_id" => 3, "name" => "Garde d'enfant", "color" => "danger", "icon" => null]);
        Subcategory::create(["category_id" => 3, "name" => "Scolarité & Etude", "color" => "danger", "icon" => null]);
        Subcategory::create(["category_id" => 3, "name" => "Soutien scolaire", "color" => "danger", "icon" => null]);
        Subcategory::create(["category_id" => 3, "name" => "Autre", "color" => "danger", "icon" => null]);

        Subcategory::create(["category_id" => 4, "name" => "Epargne Logement", "color" => "success", "icon" => null]);
        Subcategory::create(["category_id" => 4, "name" => "Epargne Retraite", "color" => "success", "icon" => null]);
        Subcategory::create(["category_id" => 4, "name" => "Livrets", "color" => "success", "icon" => null]);
        Subcategory::create(["category_id" => 4, "name" => "Placement financier", "color" => "success", "icon" => null]);
        Subcategory::create(["category_id" => 4, "name" => "Autre", "color" => "success", "icon" => null]);

        Subcategory::create(["category_id" => 5, "name" => "Contributions Sociales", "color" => "info", "icon" => null]);
        Subcategory::create(["category_id" => 5, "name" => "ISF", "color" => "info", "icon" => null]);
        Subcategory::create(["category_id" => 5, "name" => "Impot sur le revenu", "color" => "info", "icon" => null]);
        Subcategory::create(["category_id" => 5, "name" => "Taxe d'habitation et foncière", "color" => "info", "icon" => null]);
        Subcategory::create(["category_id" => 5, "name" => "Autre", "color" => "info", "icon" => null]);

        Subcategory::create(["category_id" => 6, "name" => "Avocat", "color" => "primary", "icon" => null]);
        Subcategory::create(["category_id" => 6, "name" => "Frais d'huissier", "color" => "primary", "icon" => null]);
        Subcategory::create(["category_id" => 6, "name" => "Pension alimentaire", "color" => "primary", "icon" => null]);
        Subcategory::create(["category_id" => 6, "name" => "Autre", "color" => "primary", "icon" => null]);

        Subcategory::create(["category_id" => 7, "name" => "Ameublement & appareil", "color" => "danger", "icon" => null]);
        Subcategory::create(["category_id" => 7, "name" => "Assurance habitation", "color" => "danger", "icon" => null]);
        Subcategory::create(["category_id" => 7, "name" => "Crédit immobilier", "color" => "danger", "icon" => null]);
        Subcategory::create(["category_id" => 7, "name" => "Energie", "color" => "danger", "icon" => null]);
        Subcategory::create(["category_id" => 7, "name" => "Internet & téléphonie", "color" => "danger", "icon" => null]);
        Subcategory::create(["category_id" => 7, "name" => "Loyer & Traites", "color" => "danger", "icon" => null]);
        Subcategory::create(["category_id" => 7, "name" => "Travaux - Entretien", "color" => "danger", "icon" => null]);
        Subcategory::create(["category_id" => 7, "name" => "Autre", "color" => "danger", "icon" => null]);

        Subcategory::create(["category_id" => 8, "name" => "Bar", "color" => "primary", "icon" => null]);
        Subcategory::create(["category_id" => 8, "name" => "Expo, Musée, Cinéma", "color" => "primary", "icon" => null]);
        Subcategory::create(["category_id" => 8, "name" => "Hôtel", "color" => "primary", "icon" => null]);
        Subcategory::create(["category_id" => 8, "name" => "Livre, Magazines", "color" => "primary", "icon" => null]);
        Subcategory::create(["category_id" => 8, "name" => "Sport, Gym, et Equipement", "color" => "primary", "icon" => null]);
        Subcategory::create(["category_id" => 8, "name" => "Vidéo, Musique et Jeux", "color" => "primary", "icon" => null]);
        Subcategory::create(["category_id" => 8, "name" => "Autre", "color" => "primary", "icon" => null]);

        Subcategory::create(["category_id" => 9, "name" => "Aides et Allocation", "color" => "info", "icon" => null]);
        Subcategory::create(["category_id" => 9, "name" => "Dividende & Placement", "color" => "info", "icon" => null]);
        Subcategory::create(["category_id" => 9, "name" => "Dons", "color" => "info", "icon" => null]);
        Subcategory::create(["category_id" => 9, "name" => "Note de Frais", "color" => "info", "icon" => null]);
        Subcategory::create(["category_id" => 9, "name" => "Pension Alimentaire", "color" => "info", "icon" => null]);
        Subcategory::create(["category_id" => 9, "name" => "Pension de retraite", "color" => "info", "icon" => null]);
        Subcategory::create(["category_id" => 9, "name" => "Remboursements de Soins", "color" => "info", "icon" => null]);
        Subcategory::create(["category_id" => 9, "name" => "Revenue Locatif", "color" => "info", "icon" => null]);
        Subcategory::create(["category_id" => 9, "name" => "Salaires", "color" => "info", "icon" => null]);
        Subcategory::create(["category_id" => 9, "name" => "Autre", "color" => "info", "icon" => null]);

        Subcategory::create(["category_id" => 10, "name" => "Consultation médical", "color" => "success", "icon" => null]);
        Subcategory::create(["category_id" => 10, "name" => "Mutuelle", "color" => "success", "icon" => null]);
        Subcategory::create(["category_id" => 10, "name" => "Opticien", "color" => "success", "icon" => null]);
        Subcategory::create(["category_id" => 10, "name" => "Pharmacie", "color" => "success", "icon" => null]);
        Subcategory::create(["category_id" => 10, "name" => "Autre", "color" => "success", "icon" => null]);

        Subcategory::create(["category_id" => 11, "name" => "Autre", "color" => "warning", "icon" => null]);

        Subcategory::create(["category_id" => 12, "name" => "Transaction Différé", "color" => "gray-700", "icon" => null]);
        Subcategory::create(["category_id" => 12, "name" => "Virement Interne", "color" => "gray-700", "icon" => null]);
        Subcategory::create(["category_id" => 12, "name" => "Autre", "color" => "gray-700", "icon" => null]);

        Subcategory::create(["category_id" => 13, "name" => "Assurance Auto", "color" => "primary", "icon" => null]);
        Subcategory::create(["category_id" => 13, "name" => "Carburant", "color" => "primary", "icon" => null]);
        Subcategory::create(["category_id" => 13, "name" => "Entretien", "color" => "primary", "icon" => null]);
        Subcategory::create(["category_id" => 13, "name" => "Location Vehicule", "color" => "primary", "icon" => null]);
        Subcategory::create(["category_id" => 13, "name" => "Péage & Stationnement", "color" => "primary", "icon" => null]);
        Subcategory::create(["category_id" => 13, "name" => "Taxi & VTC", "color" => "primary", "icon" => null]);
        Subcategory::create(["category_id" => 13, "name" => "Train, Avion, Ferry", "color" => "primary", "icon" => null]);
        Subcategory::create(["category_id" => 13, "name" => "Transport en commun", "color" => "primary", "icon" => null]);
        Subcategory::create(["category_id" => 13, "name" => "Vélo", "color" => "primary", "icon" => null]);
        Subcategory::create(["category_id" => 13, "name" => "Autre", "color" => "primary", "icon" => null]);
    }
}

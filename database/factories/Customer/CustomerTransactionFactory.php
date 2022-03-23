<?php

namespace Database\Factories\Customer;

use App\Models\Core\Category;
use App\Models\Core\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer\CustomerTransaction>
 */
class CustomerTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $subcategories_count = Subcategory::all()->count();
        $subcategories_rand = rand(1,$subcategories_count);
        $subcategories = Subcategory::find($subcategories_rand);
        $type = ['deposit','withdraw','payment','transfer','sepa','fee','subscription'];
        return [
            "uuid" => $this->faker->uuid,
            "type" => $type[rand(0,6)],
            "name" => $this->faker->sentence,
            "amount" => $this->faker->randomFloat(2,-125, 125),
            "confirmed" => $this->faker->boolean,
            "created_at" => $this->faker->dateTimeBetween('-45 months', 'now', 'Europe/Paris'),
            "subcategory_id" => $subcategories->id,
            "category_id" => $subcategories->category_id
        ];
    }
}

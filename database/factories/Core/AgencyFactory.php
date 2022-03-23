<?php

namespace Database\Factories\Core;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Core\Agency>
 */
class AgencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "bic" => $this->faker->swiftBicNumber,
            "name" => config("app.name"),
            "ville" => $this->faker->city,
            "country" => $this->faker->countryCode,
            "code_banque" => $this->faker->numberBetween(10000,99999),
            "code_guichet" => $this->faker->numberBetween(10000,99999),
        ];
    }
}

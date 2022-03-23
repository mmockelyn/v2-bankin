<?php

namespace Database\Factories\Customer;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer\CustomerBeneficiaire>
 */
class CustomerBeneficiaireFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $type = ["corporate", "retail"];
        $choice = $type[rand(0,1)];
        $civility = ["M", "MME"];

        return [
            "uuid" => $this->faker->uuid,
            "type" => $choice,
            "company" => $choice == 'corporate' ? $this->faker->company : null,
            "civility" => $choice != 'corporate' ? $civility[rand(0,1)] : null,
            "firstname" => $choice != 'corporate' ? $this->faker->firstName : null,
            "lastname" => $choice != 'corporate' ? $this->faker->lastName : null,
        ];
    }
}

<?php

namespace Database\Factories\Customer;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer\CustomerCompany>
 */
class CustomerCompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $rand = rand(0,1);
        return [
            "name" => $this->faker->company,
            "type" => "SAS",
            "siret" => rand(10000000000000,99999999999999),
            "address" => $this->faker->address,
            "addressbis" => $rand == 1 ? $this->faker->streetAddress : null,
            "postal" => $this->faker->postcode,
            "city" => $this->faker->city,
            "country" => $this->faker->countryCode,
            "contactName" => $this->faker->firstName.' '.$this->faker->lastName,
            "email" => $this->faker->email,
            "phone" => $this->faker->phoneNumber
        ];
    }
}

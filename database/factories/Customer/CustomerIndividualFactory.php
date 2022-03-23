<?php

namespace Database\Factories\Customer;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer\CustomerIndividual>
 */
class CustomerIndividualFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $rand = rand(0,1);
        $identification = ['PASSPORT','DRIVER','NATIONAL','OTHER'];
        return [
            "firstname" => $this->faker->firstName,
            "lastname" => $this->faker->lastName,
            "middlename" => $rand == 1 ? $this->faker->firstName : null,
            "address" => $this->faker->address,
            "addressbis" => $rand == 1 ? $this->faker->streetAddress : null,
            "postal" => $this->faker->postcode,
            "city" => $this->faker->city,
            "country" => $this->faker->countryCode,
            "datebirth" => $this->faker->dateTime(now()->subYears(18)),
            "phone" => $this->faker->phoneNumber,
        ];
    }
}

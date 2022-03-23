<?php

namespace Database\Factories\Customer;

use App\Helpers\Bank;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer\CustomerBeneficiaireBank>
 */
class CustomerBeneficiaireBankFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $banks = \App\Models\Core\Bank::all()->toArray();
        $choice = $banks[rand(0,count($banks))];
        return [
            "uuid" => $this->faker->uuid,
            "currency" => $this->faker->currencyCode,
            "bankname" => $choice['name'],
            "iban" => $this->faker->iban,
            "bic" => $choice['bic'],
            "bank_id" => $choice["id"]
        ];
    }
}

<?php

namespace Database\Factories\Customer;

use App\Helpers\IbanGenerator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer\CustomerWallet>
 */
class CustomerWalletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $ibangen = new IbanGenerator();
        $status = ['PENDING','ACTIVE','FAILED','SUSPENDED','CLOSED'];
        return [
            "uuid" => $this->faker->uuid,
            "number_account" => $this->faker->numberBetween(10000000000,99999999999),
            "status" => $status[rand(0,4)],
            'iban' => $this->faker->iban('FR')
        ];
    }
}

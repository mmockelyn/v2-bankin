<?php

namespace Database\Factories\Customer;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer\CustomerCreditCard>
 */
class CustomerCreditCardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "exp_month" => $this->faker->month,
            "exp_year" => $this->faker->year(now()->addYears(6)),
            "number" => $this->faker->creditCardNumber,
            "cvc" => $this->faker->numberBetween(100,999),
            "code" => $this->faker->numberBetween(1000,9999),
            "withdraw_limit" => $this->faker->numberBetween(1000,99999),
            "payment_limit" => $this->faker->numberBetween(100,9999),
        ];
    }
}

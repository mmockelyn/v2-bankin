<?php

namespace Database\Factories\Customer;

use App\Helpers\Customer\Levy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer\CustomerLevy>
 */
class CustomerLevyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = \Faker\Factory::create('fr_FR');
        $status = ['waiting','processed','rejected','return','refunded'];
        return [
            "creditor" => $faker->company.' - '.Levy::generateICS(),
            "uuid" => $faker->uuid,
            "mandat" => Levy::generateRUM(),
            "amount" => $faker->randomFloat(2,1,9999),
            "status" => $status[rand(0,4)],
            "created_at" => $faker->dateTimeBetween('-2 years', now())
        ];
    }
}

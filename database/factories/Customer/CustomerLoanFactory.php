<?php

namespace Database\Factories\Customer;

use App\Helpers\Customer\Loan;
use App\Models\Core\LoanPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer\CustomerLoan>
 */
class CustomerLoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $loan = new Loan();
        $amount = rand(500,99999);
        $duration = rand(3,300);
        $simulate = $loan->simulate($amount, $duration, "D");
        return [
            "uuid" => $this->faker->uuid,
            "reference" => \Str::upper(\Str::random(8)),
            "amount_loan" => $amount,
            "amount_interest" => $simulate['interest'],
            "amount_du" => $simulate['du'],
            "mensuality" => $simulate['amount_mensuality'],
            "duration" => $simulate['mensuality'],
            "loan_plan_id" => LoanPlan::all()->random(),
        ];
    }
}

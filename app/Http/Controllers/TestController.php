<?php

namespace App\Http\Controllers;


use App\Helpers\Customer\Loan;
use App\Models\Core\LoanPlan;
use App\Models\Customer\Customer;
use App\Models\Customer\CustomerLoan;

class TestController extends Controller
{
    public function test()
    {
        $loan = new Loan();
        $customer = Customer::find(2);
        $simulate = $loan->simulate(5000, 36, "D");
        //dd($loanp);

        return $loan->checkAvailibilityContract($simulate, $customer);
    }
}

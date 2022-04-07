<?php

namespace App\Http\Controllers;


use App\Helpers\Customer\Loan;
use App\Models\Customer\Customer;

class TestController extends Controller
{
    public function test()
    {
        $loan = new Loan();
        $customer = Customer::find(22);

        return $loan->generatePdfDialogue($customer, 'GTPMM4445');
    }
}

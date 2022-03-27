<?php

namespace App\Http\Controllers;

use App\Helpers\Customer\Customer;
use App\Helpers\Customer\Transaction;
use App\Models\Customer\CustomerTransfer;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
        $customer = \App\Models\Customer\Customer::find(1);
        return Customer::generateConvention($customer);
    }
}

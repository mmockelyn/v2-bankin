<?php

namespace App\Http\Controllers;

use App\Helpers\Customer\Transaction;
use App\Mail\Account\CheckoutCheck;
use App\Models\Customer\Customer;
use App\Models\Customer\CustomerTransfer;
use App\Services\Github;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    public function test()
    {
        $reference = rand(100000,999999);
        $check = collect([
            "id" => 1,
            "reference" => $reference,
            "tranche_start" => $reference,
            "tranche_end" => $reference + 40,
        ]);

        $customer = Customer::find(1);

        //dd($check, $customer);

        return new CheckoutCheck($customer, $check);
    }
}

<?php

namespace App\Http\Controllers;

use App\Helpers\Customer\Customer;
use App\Helpers\Customer\Transaction;
use App\Models\Customer\CustomerTransfer;
use App\Services\Github;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    public function test()
    {
        dd(\request()->user()->devices()->latest()->first());
    }
}

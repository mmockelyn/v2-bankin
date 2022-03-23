<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer\CustomerTransaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function info(Request $request, $uuid)
    {
        return response()->json(CustomerTransaction::with('category', 'subcategory')->where('uuid', $uuid)->first());
    }
}

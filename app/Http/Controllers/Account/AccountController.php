<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Customer\CustomerWallet;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function dashboard()
    {
        return view('account.index');
    }

    public function detail(Request $request, $uuid)
    {
        //dd($request->get('q'));
        $wallet = CustomerWallet::with('customer', 'agency', 'transactions', 'loans')->where('uuid', $uuid)->first();
        if($request->has('q')) {
            $transactions = $wallet->transactions()->orderBy('created_at', 'desc')->get();
        } else {
            $transactions = $wallet->transactions()->where('name', 'LIKE', '%'.$request->get('q').'%')->orderBy('created_at', 'desc')->get();
        }
        //dd($transactions);

        return view('account.detail', compact('wallet', 'transactions'));
    }
}

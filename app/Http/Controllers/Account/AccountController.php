<?php

namespace App\Http\Controllers\Account;

use App\Helpers\Customer\Customer;
use App\Http\Controllers\Controller;
use App\Models\Core\Package;
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
        if ($request->has('q')) {
            $transactions = $wallet->transactions()->orderBy('created_at', 'desc')->get();
        } else {
            $transactions = $wallet->transactions()->where('name', 'LIKE', '%' . $request->get('q') . '%')->orderBy('created_at', 'desc')->get();
        }
        //dd($transactions);

        return view('account.detail', compact('wallet', 'transactions'));
    }

    public function edit(Request $request)
    {
        $packages = Package::all();
        return view('account.edit', compact('packages'));
    }

    public function update(Request $request)
    {
        $customer = $request->user()->customer;
        if($request->get('package_id') == $request->user()->customer->package->id)
        {
            return redirect()->back()->with('warning', "Veuillez choisir un plan différent du précédent");
        } else {
            $request->user()->customer->package_id = $request->get('package_id');
            $request->user()->customer->save();
            $package = Package::find($request->get('package_id'));
            try {
                $customer->setting()->first()->update([
                    "nb_carte_physique" => $package->nb_carte_physique,
                    "nb_carte_virtuel" => $package->nb_carte_virtuel,
                    "cheque" => $package->check
                ]);
                Customer::generateAvenantConvention($customer);
            }catch (\Exception $exception) {
                \Log::critical($exception->getMessage());
                dd($exception->getMessage());
            }

            return redirect()->back()->with('success', "Votre souscription au plan ".$package->name." à été prise en compte");
        }
    }
}

<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Core\Bank;
use App\Models\Customer\CustomerBeneficiaire;
use App\Models\Customer\CustomerWallet;
use Illuminate\Http\Request;
use Intervention\Validation\Rules\Bic;
use Intervention\Validation\Rules\Iban;

class BeneficiaireController extends Controller
{
    public function list()
    {
        $beneficiaires = auth()->user()->customer->beneficiaires;
        //dd($beneficiaires);
        return view('account.transfer.beneficiaire.list', compact('beneficiaires'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "iban" => new Iban(),
            "bic" => ["required", new Bic()]
        ]);

        $bankInfo = \Http::post(config('app.url').'/api/account/bank', ["bic" => $request->get('bic')])->object();

        $beneficiaire = $request->user()->customer->beneficiaires()->create([
            "type" => $request->get('type'),
            "company" => $request->get('company'),
            "civility" => $request->get('civility'),
            "firstname" => $request->get('firstname'),
            "lastname" => $request->get('lastname'),
            "customer_id" => $request->user()->customer->id,
            "uuid" => \Str::uuid()
        ]);

        $beneficiaire->bank()->create([
            "bankname" => $bankInfo->info->name,
            "iban" => $request->get('iban'),
            "bic" => $request->get('bic'),
            "titulaire" => $request->has('titulaire') ? 1 : 0,
            "customer_beneficiaire_id" => $beneficiaire->id,
            "bank_id" => $bankInfo->info->id,
            "uuid" => \Str::uuid()
        ]);

        return redirect()->back()->with('success', "Votre bénéficiaire à été ajouté avec succès");
    }

    public function edit(Request $request, $uuid)
    {
        if($request->isJson()) {
            $arr = [];

            $beneficiaire = CustomerBeneficiaire::with('bank')->where('uuid', $uuid)->first();

            $arr = [
                "beneficiaire" => $beneficiaire,
                "bank" => Bank::find($beneficiaire->bank->bank->id),
            ];

            return response()->json($arr);
        } else {
            $beneficiaire = CustomerBeneficiaire::with('bank')->where('uuid', $uuid)->first();

            return view("account.transfer.beneficiaire.edit", compact('beneficiaire'));
        }
    }

    public function update(Request $request, $uuid)
    {
        $beneficiaire = CustomerBeneficiaire::with('bank')->where('uuid', $uuid)->first();

        if($beneficiaire->type == 'corporate') {
            $beneficiaire->company = $request->get('company');
            $beneficiaire->save();
        } else {
            $beneficiaire->civility = $request->get('civility');
            $beneficiaire->firstname = $request->get('firstname');
            $beneficiaire->lastname = $request->get('lastname');
            $beneficiaire->save();
        }

        $beneficiaire->bank->titulaire = $request->has('titulaire') ? 1 : 0;
        $beneficiaire->bank->save();

        return redirect()->route('account.transfer.beneficiaire.list')->with('success', "Votre bénéficiaire à été modifié avec succès");
    }

    public function destroy($uuid)
    {
        CustomerBeneficiaire::where('uuid', $uuid)->first()->delete();

        return response()->json();
    }
}

<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function profil()
    {
        $user = User::with('customer', 'agence')->find(auth()->user()->id);
        $login = $user->logins()->latest()->first();
        return view('account.settings.profil', compact('user', 'login'));
    }

    public function updateProfil(Request $request)
    {
        $this->middleware("password.confirm");
        switch ($request->get('action')) {
            case 'updatePhoneMail':
                $request->validate([
                    "email" => ["email"],
                ]);

                $customer = auth()->user()->customer;

                if($customer->type_account == 'INDIVIDUAL') {
                    $customer->individual->phone = $request->get('phone');
                    $customer->individual->save();
                } else {
                    $customer->business->phone = $request->get('phone');
                    $customer->business->email = $request->get('email');
                    $customer->business->save();
                }
                $customer->user->email = $request->get('email');
                $customer->user->save();

                $customer->setting->notif_com_sms = $request->has('notif_com_sms') ? 1 : 0;
                $customer->setting->notif_com_apps = $request->has('notif_com_apps') ? 1 : 0;
                $customer->setting->notif_com_mail = $request->has('notif_com_mail') ? 1 : 0;
                $customer->setting->save();

                return response()->json(null, 200);
                break;

            case 'updateSituation':
                try {
                    $customer = auth()->user()->customer->situation;
                    $customer->legal_capacity = $request->get('legal_capacity');
                    $customer->family_situation = $request->get('family_situation');
                    $customer->logement = $request->get('logement');
                    $customer->logement_at = $request->get('logement_at');
                    $customer->child = $request->get('child');
                    $customer->person_charged = $request->get('person_charged');
                    $customer->pro_category = $request->get('pro_category');
                    $customer->pro_profession = $request->get('pro_profession');
                    $customer->pro_incoming = $request->get('pro_incoming');
                    $customer->patrimoine = $request->get('patrimoine');
                    $customer->rent = $request->get('rent');
                    $customer->credit = $request->get('credit');
                    $customer->divers = $request->get('divers');
                    $customer->save();

                    return response()->json(null);
                }catch (\Exception $exception) {
                    return response()->json($exception->getMessage(), 500);
                }
                break;

            default:
                return response()->json(["error" => "Erreur lors de l'éxecution de la requete"], 500);
        }
    }

    public function updatePassword(Request $request)
    {
        $password_hash = \Hash::make($request->get('password'));

        if($password_hash != $request->user()->password) {
            $request->user()->password = $password_hash;
            $request->user()->save();

            return response()->json();
        } else {
            return response()->json(['message' => "Votre nouveau mot de passe doit être différent de l'ancien"]);
        }
    }
}

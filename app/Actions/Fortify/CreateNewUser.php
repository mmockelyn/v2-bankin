<?php

namespace App\Actions\Fortify;

use App\Helpers\Customer\Customer;
use App\Helpers\Customer\DocumentFile;
use App\Models\User\User;
use App\Notifications\Auth\PhoneVerificationNotification;
use App\Notifications\Customer\CreatePasswordNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Str;
use PDF;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User\User
     */
    public function create(array $input)
    {
        //dd($input);
        $cus = new Customer();
        $password = \Str::random(10);
        Validator::make($input, [
            "package_id" => ["required"],
        ])->validate();

        $user = User::create([
            "name" => $input['type_account'] == 'INDIVIDUAL' ? $input['firstname']." ".$input["lastname"] : $input['name'],
            "email" => $input['type_account'] == 'INDIVIDUAL' ? $input['email_part'] : $input['email_pro'],
            "password" => Hash::make($password),
            "agency_id" => 1,
            "identifiant" => Str::upper(Str::random(10))
        ]);
        $customer = $cus->create(
            $input['type_account'],
            $input['type_account'] == 'INDIVIDUAL' ? $input['firstname']." ".$input["lastname"] : $input['name'],
            $user->id,
            $input['package_id'],
            $input['civility'],
            $input['firstname'],
            $input['lastname'],
            $input['middlename'],
            $input['address_part'] ? $input['address_part'] : $input['address_pro'],
            $input['addressbis_part'] ? $input['addressbis_part'] : $input['addressbis_pro'],
            $input['postal_part'] ? $input['postal_part'] : $input['postal_pro'],
            $input['city_part'] ? $input['city_part'] : $input['city_pro'],
            $input['country_part'] ? $input['country_part'] : $input['country_pro'],
            $input['datebirth'],
            $input['phone_part'] ? $input['phone_part'] : $input['phone_pro'],
            $input['name'] ? $input['name'] : null,
            $input['type'] ? $input['type'] : null,
            $input['siret'] ? $input['siret'] : null,
            $input['email_part'] ? $input['phone_part'] : $input['phone_pro']
        );

        $user->notify(new PhoneVerificationNotification('sms', true));
        $user->notify(new CreatePasswordNotification($password, $user));
        Customer::generateConvention($customer);

        return $user;
    }
}

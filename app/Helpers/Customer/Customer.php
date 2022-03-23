<?php


namespace App\Helpers\Customer;


use App\Models\Core\Package;
use App\Models\Customer\CustomerCompany;
use App\Models\Customer\CustomerIndividual;
use NSpehler\LaravelInsee\Facades\Insee;

class Customer
{
    public function create($type_account, $friendlyName, $user_id, $package, $civility, $firstname, $lastname, $middlename, $address, $addressbis, $postal, $city, $country, $datebirth, $phone, $email, $company = null, $type = null, $siret = null)
    {
        $customer = \App\Models\Customer\Customer::create([
            "type_account" => $type_account,
            "friendlyName" => $friendlyName,
            "user_id" => $user_id,
            "package_id" => $package
        ]);

        if ($type_account == "INDIVIDUAL") {
            CustomerIndividual::create([
                "civility" => $civility,
                "firstname" => $firstname,
                "lastname" => $lastname,
                "middlename" => $middlename,
                "address" => $address,
                "addressbis" => $addressbis,
                "postal" => $postal,
                "city" => $city,
                "country" => $country,
                "datebirth" => $datebirth,
                "phone" => $phone,
                "customer_id" => $customer->id,
            ]);
        } else {
            CustomerCompany::create([
                "name" => $company,
                "type" => $type,
                "siret" => $siret,
                "address" => $address,
                "addressbis" => $addressbis,
                "postal" => $postal,
                "city" => $city,
                "country" => $country,
                "contactName" => $friendlyName,
                "email" => $email,
                "phone" => $phone,
                "customer_id" => $customer->id
            ]);
        }

        $package = Package::find($package);

        $customer->setting()->create([
            "nb_carte_physique" => $package->nb_carte_physique,
            "nb_carte_virtuel" => $package->nb_carte_virtuel,
            "cheque" => $package->check
        ]);
    }


    public static function verified_account()
    {
        $customers = \App\Models\Customer\Customer::with('individual', 'business', 'user')->get();


        foreach ($customers as $customer) {
            if ($customer->status_open_account == 'completed') {
                if ($customer->type_account == 'INDIVIDUAL') {
                    // Vérifier l'age d'un client
                    if ($customer->individual->datebirth <= now()->subYears(18)) {
                        $customer->status_open_account = 'accepted';
                        $customer->save();
                        self::createAccount($customer);
                    } else {
                        $customer->status_open_account = 'declined';
                        $customer->save();
                    }
                } else {
                    // Vérifie si le siret est valide
                    $res = Insee::siret($customer->business->siret);
                    if ($res->header->statut == 404) {
                        $customer->status_open_account = 'declined';
                        $customer->save();
                    } else {
                        $customer->status_open_account = 'accepted';
                        $customer->save();
                    }
                }
            }
        }
    }

    public static function getPhone($customer)
    {
        if ($customer->type_account == 'INDIVIDUAL') {
            return $customer->individual->phone;
        } else {
            return $customer->business->phone;
        }
    }

    public static function getType($customer)
    {
        if ($customer->type_account == "INDIVIDUAL") {
            return "Personne Physique (Particulier)";
        } else {
            return "Personne Morale (Professionnel)";
        }
    }

    public static function getCivility($civility)
    {
        return $civility == "M" ? "Monsieur" : "Madame";
    }

    public static function getEmail($email, $obscure = true)
    {
        if ($obscure == true) {
            $mail_parts = explode("@", $email);
            $length = strlen($mail_parts[0]);
            $show = floor($length / 2);
            $hide = $length - $show;
            $replace = str_repeat("*", $hide);

            return substr_replace($mail_parts[0], $replace, $show, $hide) . "@" . substr_replace($mail_parts[1], "**", 0, 2);
        } else {
            return $email;
        }
    }

    public static function getName($customer)
    {
        if($customer->type_account == 'BUSINESS') {
            return $customer->business->company;
        } else {
            return $customer->individual->civility.'. '.$customer->individual->firstname.' '.$customer->individual->lastname;
        }
    }

    private static function createAccount($customer)
    {
        $wallet = new Wallet();
        $account = $wallet->create($customer->id, 1);

    }
}

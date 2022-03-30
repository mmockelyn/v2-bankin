<?php


namespace App\Helpers\Customer;


use App\Mail\Account\FirstPaymentRequired;
use App\Mail\Account\Welcome;
use App\Models\Core\Package;
use App\Models\Customer\CustomerCompany;
use App\Models\Customer\CustomerIndividual;
use NSpehler\LaravelInsee\Facades\Insee;
use PDF;

class Customer
{
    public function create($type_account, $friendlyName, $user_id, $package, $civility, $firstname, $lastname, $middlename, $address, $addressbis, $postal, $city, $country, $datebirth, $phone, $email, $company = null, $type = null, $siret = null)
    {
        $wallet = new Wallet();
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

        $customer->situation()->create([
            "customer_id" => $customer->id
        ]);

        $wallet->create($customer->id, 1);


        return $customer;
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
                        \Mail::to($customer->user)->send(new FirstPaymentRequired($customer));
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
                        \Mail::to($customer->user)->send(new FirstPaymentRequired($customer));
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

    public static function getFirstname($customer)
    {
        if($customer->type_account == 'BUSINESS') {
            return $customer->business->company;
        } else {
            return $customer->individual->firstname;
        }
    }

    public static function getAdress($customer)
    {
        if($customer->type_account == 'BUSINESS') {
            return $customer->company->address.' - '.$customer->company->postal.' '.$customer->company->city;
        } else {
            return $customer->individual->address.' - '.$customer->individual->postal.' '.$customer->individual->city;
        }

    }

    public static function getAdressLetter($customer)
    {
        if($customer->type_account == 'BUSINESS') {
            return $customer->company->address.'<br>'
                .isset($customer->company->addressbis) ? $customer->company->addressbis."<br>" : "<br>"
                .$customer->company->postal." ".$customer->company->city."<br>";
        } else {
            return $customer->individual->address.'<br>'
            .isset($customer->individual->addressbis) ? $customer->individual->addressbis."<br>" : "<br>"
                .$customer->individual->postal." ".$customer->individual->city."<br>";
        }

    }

    public static function generateConvention($customer)
    {
        $agence = $customer->user->agence;
        $header = view()
            ->make("agence.pdf.header_basic")
            ->with('agence', $agence)
            ->with('customer', $customer)
            ->render();

        $file = new DocumentFile();
        $name = "Souscription Convention relation particulier - CUS".$customer->user->identifiant." - ".now()->format('Ymd');

        $document = $file->createDocument($name, $customer, 3, true, true, true, true, now());

        $pdf = PDF::loadView('agence.pdf.account.conv_part', compact('agence', 'customer', 'document', 'name'));
        $pdf->setOption('enable-local-file-access', true);
        $pdf->setOption('viewport-size','1280x1024');
        $pdf->setOption('header-html', $header);
        $pdf->setOption('footer-right','[page]/[topage]');
        $pdf->setOption('footer-font-size',8);
        $pdf->setOption('margin-left',0);
        $pdf->setOption('margin-right',0);
        $pdf->save(public_path('/storage/gdd/'.$customer->id.'/contract/'.\Str::slug($name).'.pdf'), true);

        \Mail::to($customer->user)->send(new Welcome($customer, $document));
    }

    private static function createAccount($customer)
    {
        $wallet = new Wallet();
        $account = $wallet->create($customer->id, 1);

    }

}

<?php


namespace App\Helpers\Customer;


use App\Jobs\Account\WelcomeContractJob;
use App\Mail\Account\FirstPaymentReceived;
use App\Notifications\Customer\Payment\CodeCreditCard;
use App\Notifications\Customer\Payment\NewCreditCard;
use Plansky\CreditCard\Generator;
use PDF;

class CreditCard
{
    public function createCard($wallet, $type_carte, $support, $debit, $withdraw = 500, $payment = 1500)
    {
        $code = rand(1000, 9999);
        $card = $wallet->cards()->create([
            "currency" => "EUR",
            "exp_month" => now()->format('m'),
            "exp_year" => now()->addYears(4)->format("Y"),
            "number" => $this->generateCard(),
            "status" => "INACTIVE",
            "type" => $type_carte,
            "brand" => "VISA",
            "support" => $support,
            "debit" => $debit,
            "cvc" => rand(100, 999),
            "external_payment" => true,
            "abroad_payment" => true,
            "code" => $code,
            "withdraw_limit" => $withdraw,
            "payment_limit" => $payment,
            "customer_wallet_id" => $wallet->id,
            "customer_id" => $wallet->customer->id
        ]);

        $wallet->customer->user->notify(new NewCreditCard($wallet->customer->user, $card));
        $wallet->customer->user->notify(new CodeCreditCard($card, $code));
        $document = self::generateContract($wallet->customer, $card);
        \Mail::to($wallet->customer->user)->send(new FirstPaymentReceived($wallet->customer));
        WelcomeContractJob::dispatch($wallet->customer, $document)->delay(now()->addMinutes(5));
    }

    public static function getCreditCard($number, $obscure = true)
    {
        if ($obscure == true) {
            return "XXXX XXXX XXXX " . \Str::substr($number, 12, 16);
        } else {
            return $number;
        }
    }

    public static function isDiffered($debit)
    {
        return $debit != 'DIFFERED' ? false : true;
    }

    public static function getDebit($debit)
    {
        return $debit == 'DIFFERED' ? "Différé" : "Immédiat";
    }

    public static function getType($type)
    {
        switch ($type) {
            case 'PHYSICAL':
                return 'Physique';
                break;

            case 'VIRTUAL':
                return 'Virtuel';
                break;
        }
    }

    public static function getContact($contact)
    {
        return $contact == 1 ? "OUI" : "NON";
    }

    private function generateCard()
    {
        $generator = new Generator();
        return $generator->single(42, 16);
    }

    public static function getStatusCard($status, $design = false)
    {
        if ($design == false) {
            switch ($status) {
                case 'ACTIVE':
                    return 'Active';
                    break;

                case 'INACTIVE':
                    return "Inactive";
                    break;

                case "CANCELED":
                    return "Annulé";
                    break;

                default:
                    return "Annnulé";
            }
        } else {
            switch ($status) {
                case 'ACTIVE':
                    return '<div class="ribbon-label bg-success">Active</div>';
                    break;

                case 'INACTIVE':
                    return '<div class="ribbon-label bg-warning">Inactive</div>';
                    break;

                case "CANCELED":
                    return '<div class="ribbon-label bg-danger">Annulé</div>';
                    break;

                default:
                    return '<div class="ribbon-label bg-danger">Annulé</div>';
            }
        }
    }

    // Generate Convention
    public static function generateContract($customer, $card)
    {
        $agence = $customer->user->agence;
        $header = view()
            ->make("agence.pdf.header_basic")
            ->with('agence', $agence)
            ->with('customer', $customer)
            ->render();

        $file = new DocumentFile();
        $reference = \Str::upper(\Str::random(10));
        $name = "Souscription Contrat Carte GFC" . $reference . " - " . now()->format('Ymd');

        $document = $file->createDocument($name, $customer, 3, $reference, true, true, true, now());

        $pdf = PDF::loadView('agence.pdf.account.conv_cb', compact('agence', 'customer', 'document', 'name', 'card'));
        $pdf->setOption('enable-local-file-access', true);
        $pdf->setOption('viewport-size', '1280x1024');
        $pdf->setOption('header-html', $header);
        $pdf->setOption('footer-right', '[page]/[topage]');
        $pdf->setOption('footer-font-size', 8);
        $pdf->setOption('margin-left', 0);
        $pdf->setOption('margin-right', 0);
        $pdf->save(public_path('/storage/gdd/' . $customer->id . '/contract/' . \Str::slug($name) . '.pdf'), true);

        return $document;
    }
}

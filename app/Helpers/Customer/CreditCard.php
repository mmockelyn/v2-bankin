<?php


namespace App\Helpers\Customer;


use App\Notifications\Customer\Payment\CodeCreditCard;
use App\Notifications\Customer\Payment\NewCreditCard;
use Plansky\CreditCard\Generator;

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
    }

    public static function getCreditCard($number, $obscure = true)
    {
        if ($obscure == true) {
            return "XXXX XXXX XXXX " . \Str::substr($number, 12, 16);
        } else {
            return $number;
        }
    }

    private function generateCard()
    {
        $generator = new Generator();
        return $generator->single(42, 16);
    }

    public static function getStatusCard($status, $design = false)
    {
        if ($design == false) {
            switch ($status)
            {
                case 'ACTIVE':
                    return 'Active';
                    break;

                case 'INACTIVE':
                    return "Inactive";
                    break;

                case "CANCELED":
                    return "Annulé";
                    break;

                default: return "Annnulé";
            }
        } else {
            switch ($status)
            {
                case 'ACTIVE':
                    return '<div class="ribbon-label bg-success">Active</div>';
                    break;

                case 'INACTIVE':
                    return '<div class="ribbon-label bg-warning">Inactive</div>';
                    break;

                case "CANCELED":
                    return '<div class="ribbon-label bg-danger">Annulé</div>';
                    break;

                default: return '<div class="ribbon-label bg-danger">Annulé</div>';
            }
        }
    }
}

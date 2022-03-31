<?php

namespace App\Mail\Account\Alert;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SuspendedAccount extends Mailable
{
    use Queueable, SerializesModels;

    public $wallet;
    public $solde;

    /**
     * Create a new message instance.
     *
     * @param $wallet
     * @param $solde
     */
    public function __construct($wallet, $solde)
    {
        //
        $this->wallet = $wallet;
        $this->solde = $solde;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Compte suspendu pour utilisation irrégulière de votre compte")->view('emails.account.alert.suspended_account', [
            "customer" => $this->wallet->customer,
            "solde" => $this->solde,
            "wallet" => $this->wallet
        ]);
    }
}

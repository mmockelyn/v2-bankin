<?php

namespace App\Mail\Account\Alert;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReactiveAccount extends Mailable
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
        return $this->subject("Réactivation de votre compte bancaire")->view('emails.account.alert.reactive_account', [
            "customer" => $this->wallet->customer,
            "solde" => $this->solde,
            "wallet" => $this->wallet
        ]);
    }
}

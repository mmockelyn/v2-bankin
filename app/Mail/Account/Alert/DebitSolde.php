<?php

namespace App\Mail\Account\Alert;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DebitSolde extends Mailable
{
    use Queueable, SerializesModels;

    public $customer;
    public $solde;
    public $wallet;

    /**
     * Create a new message instance.
     *
     * @param $customer
     * @param $solde
     * @param $wallet
     */
    public function __construct($customer, $solde, $wallet)
    {
        //
        $this->customer = $customer;
        $this->solde = $solde;
        $this->wallet = $wallet;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Attention solde débiteur")->view('emails.account.alert.debit_solde', [
            "customer" => $this->customer,
            "solde" => $this->solde,
            "wallet" => $this->wallet
        ]);
    }
}

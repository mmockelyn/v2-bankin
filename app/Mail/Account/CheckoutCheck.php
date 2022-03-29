<?php

namespace App\Mail\Account;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CheckoutCheck extends Mailable
{
    use Queueable, SerializesModels;

    public $customer;
    public $check;

    /**
     * Create a new message instance.
     *
     * @param $customer
     * @param $check
     */
    public function __construct($customer, $check)
    {
        //
        $this->customer = $customer;
        $this->check = $check;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Nouvelle commande de chéquier")->view('emails.account.payment.checkout_check', [
            "check" => $this->check,
            "customer" => $this->customer
        ]);
    }
}

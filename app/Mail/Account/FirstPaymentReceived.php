<?php

namespace App\Mail\Account;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FirstPaymentReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $customer;

    /**
     * Create a new message instance.
     *
     * @param $customer
     */
    public function __construct($customer)
    {
        //
        $this->customer = $customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.account.first_payment_received', [
            "customer" => $this->customer
        ])->subject("Ouverture de votre compte ".config('app.name')." : votre 1er versement a bien été effectué");
    }
}

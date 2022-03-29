<?php

namespace App\Mail\Account;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UpdateStatusCheck extends Mailable
{
    use Queueable, SerializesModels;

    public $check;

    /**
     * Create a new message instance.
     *
     * @param $check
     */
    public function __construct($check)
    {
        //
        $this->check = $check;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.account.payment.update_status_check', [
            "check" => $this->check,
            "customer" => $this->check->customer
        ]);
    }
}

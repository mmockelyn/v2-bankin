<?php

namespace App\Mail\Account;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DemandeContact extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $subject;
    public $message;
    public $response;

    /**
     * Create a new message instance.
     *
     * @param $user
     * @param $subject
     * @param $message
     * @param $response
     */
    public function __construct($user, $subject, $message, $response)
    {
        //
        $this->user = $user;
        $this->subject = $subject;
        $this->message = $message;
        $this->response = $response;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('console@bzhm.tk')
            ->markdown('emails.account.contact', [
                "user" => $this->user,
                "subject" => $this->subject,
                "message" => $this->message,
                "response" => $this->response
            ]);
    }
}

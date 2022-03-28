<?php

namespace App\Mail\Account;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Welcome extends Mailable
{
    use Queueable, SerializesModels;

    public $customer;
    public $document;

    /**
     * Create a new message instance.
     *
     * @param $customer
     * @param $document
     */
    public function __construct($customer, $document)
    {
        //
        $this->customer = $customer;
        $this->document = $document;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.account.welcome', [
            "customer" => $this->customer,
            "document" => $this->document
        ])->subject("Ouverture de votre compte ".config('app.name').": documents précontractuels à conserver")
            ->attachData(public_path('/storage/gdd/'.$this->customer->id.'/contract/'.\Str::slug($this->document->name).'.pdf'), \Str::slug($this->document->name).'.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}

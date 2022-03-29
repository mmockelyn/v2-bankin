<?php

namespace App\Mail\Account;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeContract extends Mailable
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
        return $this->markdown('emails.account.welcome_contract', [
            "customer" => $this->customer
        ])->subject("Bienvenue chez ".config('app.name'))
        ->attachData(public_path('/storage/gdd/'.$this->customer->id.'/contract/'.\Str::slug($this->document->name).'.pdf'), \Str::slug($this->document->name).'.pdf', [
            'mime' => 'application/pdf',
        ])->attachData(public_path('/storage/brochure/mobilite_bancaire_brochure.pdf'), 'mobilite_bancaire.pdf', [
            'mime' => 'application/pdf'
            ]);
    }
}

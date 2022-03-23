<?php

namespace App\Notifications\Customer\Transaction;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreatedTransaction extends Notification
{
    use Queueable;

    private $user;
    private $transaction;

    /**
     * Create a new notification instance.
     *
     * @param $user
     * @param $transaction
     */
    public function __construct($user, $transaction)
    {
        //
        $this->user = $user;
        $this->transaction = $transaction;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting("Bonjour ".$this->user->name)
                    ->line("Une transaction à été éffectué sur votre compte:".$this->transaction->wallet->number_account)
                    ->line('Son montant est de: '.eur($this->transaction->amount))
                    ->line("Désignation: ".$this->transaction->name)
                    ->salutation("Cordialement,")
                    ->from("no-reply@bzhmbank.io", config("app.name"));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            "type" => "transaction",
            "color" => "success",
            "title" => "Transaction Effectuer",
            "sub" => "Une transaction de ".eur($this->transaction->amount)." à été effectuer sur le compte: ".$this->transaction->wallet->number_account
        ];
    }
}

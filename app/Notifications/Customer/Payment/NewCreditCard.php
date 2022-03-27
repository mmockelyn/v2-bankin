<?php

namespace App\Notifications\Customer\Payment;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCreditCard extends Notification
{
    use Queueable;

    public $user;
    public $card;

    /**
     * Create a new notification instance.
     *
     * @param $user
     * @param $card
     */
    public function __construct($user, $card)
    {
        //
        $this->user = $user;
        $this->card = $card;
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
            ->subject("[".config("app.name")."] Votre nouvelle carte bancaire")
                    ->from("no-reply@bzhm-finance.tk")
                    ->markdown('emails.account.payment.new_credit_card', [
                        "user" => $this->user,
                        "card" => $this->card
                    ]);
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
            "type" => "creditcard",
            "color" => "success",
            "title" => "Nouvelle Carte Bancaire",
            "sub" => "Votre nouvelle carte bancaire vous à été envoyer"
        ];
    }
}

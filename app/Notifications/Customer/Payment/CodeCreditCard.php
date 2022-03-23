<?php

namespace App\Notifications\Customer\Payment;

use App\Helpers\Customer\CreditCard;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Twilio\TwilioChannel;
use NotificationChannels\Twilio\TwilioSmsMessage;

class CodeCreditCard extends Notification
{
    use Queueable;

    public $card;
    public $code;

    /**
     * Create a new notification instance.
     *
     * @param $card
     * @param $code
     */
    public function __construct($card, $code)
    {
        //
        $this->card = $card;
        $this->code = $code;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [TwilioChannel::class];
    }

    public function toTwilio($notifiable)
    {
        return (new TwilioSmsMessage())
            ->content("Votre code de carte bleu N° ".CreditCard::getCreditCard($this->card->number)." est le ".$this->code);
    }
}

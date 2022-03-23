<?php

namespace App\Notifications\Customer;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Twilio\TwilioChannel;
use NotificationChannels\Twilio\TwilioSmsMessage;

class CreatePasswordNotification extends Notification
{
    use Queueable;

    public $password;
    public $user;

    /**
     * Create a new notification instance.
     *
     * @param $password
     * @param $user
     */
    public function __construct($password, $user)
    {
        //
        $this->password = $password;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', TwilioChannel::class];
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
                    ->subject("[".config("app.name")."] Mot de passe provisoire")
                    ->greeting("Bonjour ".$this->user->name)
                    ->line("Votre compte à été créer avec succès. Votre mot de passe provisoire est le <strong>".$this->password."</strong>")
                    ->line("Ce mot de passe est bien évidament temporaire.<br>Veuillez le modifier sur votre espace client dès que possible.")
                    ->salutation("Cordialement")
                    ->from("no-reply@bzhmbank.io", config("app.name"));
    }

    public function toTwilio($notifiable)
    {
        return (new TwilioSmsMessage())
            ->content("Votre mot de passe provisoire est: {$this->password}");
    }
}

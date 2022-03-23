@component('mail::message')
# Bonjour {{ $user->name }}

    Votre nouvelle carte bancaire **{{ \App\Helpers\Customer\CreditCard::getCreditCard($card->number) }}** viens de vous être envoyer par courrier.
    Votre code confidentiel vous à été envoyer par SMS.

@endcomponent

@component('mail::message')
    @component('mail::panel')
        {{ config("app.name") }} vous informe sur votre compte
    @endcomponent

## Bonjour {{ \App\Helpers\Customer\Customer::getFirstname($customer) }}

    Votre premier versement est bien arrivé sur votre compte {{ config('app.name') }}.

    Ça y est, c’est officiel : votre compte bancaire est ouvert !

    Et c’est tout ? Pas tout à fait : vous allez recevoir dans quelques instants un mail avec votre identifiant client, votre contrat et toutes les infos utiles pour profiter pleinement de votre compte {{ config('app.name') }}.

On vous souhaite la bienvenue,<br>
{{ config('app.name') }}
@endcomponent

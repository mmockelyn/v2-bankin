@component('mail::message')
# Nouvelle demande de contact

## Information sur la demande
@component('mail::panel')
    **Motif:** {{ $subject }}

    **Etablissement d'où provient la demande:** {{ $user->agence->name }}

    **Marché:** {{ \App\Helpers\Customer\Customer::getType($user->customer) }}
@endcomponent

## Identité du demandeur
@if($user->customer->type_account == "INDIVIDUAL")
@component('mail::panel')
    **Civilité:** {{ \App\Helpers\Customer\Customer::getCivility($user->customer->individual->civility) }}

    **Identité:** {{ $user->name }}

    **Identifiant:** {{ $user->identifiant }}

    **Etablissement du client:** {{ $user->agence->name }}

@endcomponent

## Contact du demandeur
@component('mail::panel')
    **Téléphone:** {{ $user->customer->individual->phone }}

    **Email:** {{ $user->email }}

    **Canal de contact choisi:** {{ $response }}

@endcomponent
@else
@component('mail::panel')
    **Entreprise:** {{ $user->customer->business->type }} {{ $user->customer->business->name }}

    **Identité:** {{ $user->name }}

    **Identifiant:** {{ $user->identifiant }}

    **Etablissement du client:** {{ $user->agence->name }}

@endcomponent

## Contact du demandeur
@component('mail::panel')
    **Téléphone:** {{ $user->customer->business->phone }}

    **Email:** {{ $user->customer->business->email }}

    **Canal de contact choisi:** {{ $response }}

@endcomponent
@endif

## Détail de la demande
@component('mail::panel')
    {!! $message !!}
@endcomponent

@endcomponent

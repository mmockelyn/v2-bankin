@component('mail::message')
# Bonjour {{ \App\Helpers\Customer\Customer::getName($customer) }}

Vous êtes en train d’ouvrir votre compte {{ config('app.name') }}, voici vos documents précontractuels en pièces jointes :
    <ul>
        <li>Fiche d’information précontractuelle</li>
        <li>Document d’information tarifaire</li>
        <li>Conditions tarifaires</li>
        <li>Conditions générales banque au quotidien</li>
        <li>Conditions générales d'utilisation de l'application</li>
        <li>Politique de protection des données personnelles</li>
        <li>Le projet de votre contrat {{ config("app.name") }}</li>
    </ul>

Conservez ces documents, ils vous seront toujours utiles.
Pratique, ils sont au format numérique : plus besoin d’archives papier, c’est ça l’offre 100% mobile.

A Bientôt,
** L'équipe {{ config('app.name') }} **

@endcomponent

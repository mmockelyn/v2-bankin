@component('mail::message')
    @component('mail::panel')
        Maintenant, c'est simple de changer de banque avec la mobilité bancaire
    @endcomponent

    ## Bonjour {{ \App\Helpers\Customer\Customer::getFirstname($customer) }}

    **Vous venez d'ouvrir un compte {{ config('app.name') }}, bienvenue.**

    Pour commencer, votre espace client est maintenant accessible avec votre identifiant et votre adresse mail:
    **Identifiant:** {{ $customer->user->identifiant }}
    **Email:** {{ $customer->user->email }}

    Si vous souhaitez changer de banque et faire de {{ config('app.name') }} votre banque principale, **vous pouvez utiliser notre service Transbank**
    Ce service est accessible par l'intermédiaire de votre espace client **Rubrique "Mon Profil > Transbank".

    **Une fois votre inscription au service effectuer, on vous demandera de signer un mandat de mobilité. Et on s'occupe de tout** pour que vos prélèvements,
    et virement récurrents qui était sur votre ancien compte arrivent sur votre compte {{ config('app.name') }}.

    **De plus**, vous trouverez en pièces jointes des documents à conserver:

    <ul>
        <li>Votre Contrat</li>
        <li>Un guide sur la mobilité bancaire avec TransBank</li>
    </ul>

Merci de votre confiance, A Bientôt,<br>
{{ config('app.name') }}
@endcomponent

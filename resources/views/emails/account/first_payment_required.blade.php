@component('mail::message')
    @component('mail::panel')
        ## Maintenant, pour ouvrir son compte, on fait simplement un premier versement
    @endcomponent

    ## Bonjour {{ \App\Helpers\Customer\Customer::getName($customer) }},

    Bonne nouvelle : vos justificatifs ont été validés.
    Pour finaliser l’ouverture de votre compte, plus qu’une étape : faire un premier versement de 11 € minimum sur votre compte bancaire {{ config('app.name') }}.

    Vous pouvez l’effectuer soit :
    - par carte bancaire si vous avez réalisé votre identification par nos systèmes
    - par virement, depuis votre compte externe vers votre nouveau compte {{ config('app.name') }}, avec votre nom et votre prénom dans le libellé

@component('mail::button', ['url' => route('suivi')])
J'effectue mon premier versement
@endcomponent

A Bientôt,<br>
L'équipe {{ config('app.name') }}
@endcomponent

<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic - Bootstrap 5 HTML, VueJS, React, Angular & Laravel Admin Dashboard Theme
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->
<head>
    <base href="">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $name }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="{{ asset('/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/css/pdf.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('/assets/css/custom.css') }}" media="all">
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->
<body class="body white m-15 fs-5">
    <div class="fs-1 fw-bolder text-center mb-10">
        CONTRAT CARTE CB-{{ $card->brand }} {{ $card->support }}
        @if($card->support == "ELECTRON")
            A AUTORISATION SYSTEMATIQUE
        @else
            A AUTORISATION QUASI-SYSTEMATIQUE
        @endif
    </div>
    <div class="fs-4 fw-bold text-center mb-10">Fourniture d'une carte de {{ \App\Helpers\Customer\CreditCard::isDiffered($card->debit) == false ? 'Crédit' : 'Débit' }} (Carte de paiement internationnale à débit {{ \App\Helpers\Customer\CreditCard::getDebit($card->debit) }})</div>
    <div class="fw-bolder">TITULAIRE DU COMPTE ET DE LA CARTE: {{ \App\Helpers\Customer\Customer::getName($customer) }}</div>
    @if($customer->type_account == 'INDIVIDUAL')
        <div>Date de naissance: {{ $customer->individual->datebirth->format("d/m/Y") }}</div>
    @endif
    <div>Adresse: {{ \App\Helpers\Customer\Customer::getAdress($customer) }}</div>
    <div class="separator border-2 border-dark my-10"></div>
    <div class="fs-3 fw-bolder text-center">CONDITIONS PARTICULIERES</div>
    <table class="table border border-2 border-gray-800 mb-10">
        <tbody>
            <tr class="border-bottom border-gray-800 h-50px">
                <td class="p-5 w-50">Référence du contrat: {{ $document->reference }}</td>
                <td class="p-5 w-50">Numéro de compte support de la carte: {{ $card->wallet->number_account }}</td>
            </tr>
            <tr class="border-bottom border-gray-800 h-50px">
                <td class="p-5 w-50">Type de carte: {{ \App\Helpers\Customer\CreditCard::getType($card->type) }}</td>
                <td class="p-5 w-50">Type de débit: {{ \App\Helpers\Customer\CreditCard::getDebit($card->debit) }}</td>
            </tr>
            <tr class="border-bottom border-gray-800 h-50px">
                <td rowspan="2" class="p-5 w-50">Service CARTEGO souscrit: NON<br><br>Standard</td>
                <td class="p-5 w-50">Catégorie de la carte selon le règlement (UE) 2015/751 du 29/05/2015:<br>{{ \App\Helpers\Customer\CreditCard::isDiffered($card->debit) == false ? 'Crédit' : 'Débit' }}</td>
            </tr>
            <tr class="border-bottom border-gray-800 h-50px">
                <td class="p-5 w-50">Carte doté de la fonction sans contact: {{ \App\Helpers\Customer\CreditCard::getDebit($card->debit) }}</td>
            </tr>
        </tbody>
    </table>
    <p class="mb-5">
        Le titulaire de la carte et/ou du compte doit déclarer par téléphone dans les meilleurs délais, la perte, le vol de la carte ou
        l’utilisation frauduleuse des données de la carte au centre d'opposition de la Banque : 01.77.86.24.24 (prix d'un appel local).
    </p>
    <div class="fs-3 fw-bolder text-center">MODALITES D'UTILISATION</div>
    <p>Les plafonds d'autorisation de votre carte sont :</p>
    <table class="table border border-2 border-gray-800 mb-10">
        <tbody>
        <tr class="border-bottom border-gray-800 h-50px">
            <td class="p-5 w-50">
                <strong>Retraits:</strong> {{ eur($card->withdraw_limit) }} / 7 jours glissant
            </td>
            <td class="p-5 w-50">
                <strong>Paiement:</strong> {{ eur($card->payment_limit) }} / 7 jours glissant
            </td>
        </tr>
        </tbody>
    </table>
    <p>Les plafonds à l'étranger sont compris dans les plafonds France. Pour modifier ces plafonds, merci de consulter votre agence.</p>
    <p>
        Visualisation du code confidentiel sur l’espace de banque à distance :<br>
        Vous choisissez de recevoir le code confidentiel de votre carte par courrier lors de la souscription de la carte ou en cas de
        refabrication de la carte suite à une mise en opposition. Par exception, si vous faites opposition sur votre espace de banque à
        distance, via votre application mobile de votre Banque, le code confidentiel de votre nouvelle carte sera mis à disposition sur
        cet espace dans votre application bancaire mobile.
    </p>
    <p>
        Possibilité de bloquer/débloquer les paiements à distance :<br>
        Lors de la présente souscription, l’option « paiements à distance » de votre carte est activée. Vous reconnaissez avoir été
        informé de la possibilité d’activer et de désactiver la fonction de paiement à distance (internet, téléphone et courrier) de la
        carte souscrite, depuis votre espace de banque à distance si vous êtes abonné aux services de banque à distance de votre
        Banque, ou en adressant une demande à votre agence.
    </p>
    <p>Les comptes accessibles aux GAB sont, à la date de signature :</p>
    <p class="border border-gray-800">{{ $card->wallet->number_account }} {{ \App\Helpers\Customer\Customer::getName($customer) }}</p>
    <p>Pour votre sécurité, votre nouvelle carte est fabriquée et transportée inactive. Pour l'activer, vous devez effectuer un retrait sur
        un distributeur automatique de billets ou un paiement chez un commerçant, validé par votre code confidentiel*.</p>
    <p>Dans la mesure du possible et si vous y avez accès, l'activation de cotre carte peut ce faire par l'intermédiaire de votre espace client en tapant votre code SECURPASS.</p>
    <p>Fait le {{ now()->format('d/m/Y') }}</p>
    <table class="table table-rounded border gy-7 gs-7 m-10">
        <thead>
        <tr class="fw-bolder fs-5 text-gray-800 border-bottom border-gray-200 text-center">
            <th>Le titulaire</th>
            <th>La banque {{ $agence->name }}</th>
        </tr>
        </thead>
        <tbody>
        <tr class="h-50px">
            <td class="text-center fs-8">
                Signé éléctroniquement le {{ now()->format('d/m/Y') }}.<br>{{ \App\Helpers\Customer\Customer::getName($customer) }}
            </td>
            <td class="text-center fs-8">
                Signé éléctroniquement le {{ now()->format('d/m/Y') }} par la banque
            </td>
        </tr>
        </tbody>
    </table>
</body>
<!--end::Body-->
</html>

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
</body>
<!--end::Body-->
</html>

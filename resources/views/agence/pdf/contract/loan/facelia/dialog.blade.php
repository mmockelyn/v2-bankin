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
    <title></title>
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
<body class="body white">
    <div class="text-center fw-bolder fs-3 mb-15 border border-2">
        FICHE DE DIALOGUE: REVENUS ET CHARGES<br>
        SYNTHESE DE VOTRE SITUATION PERSONNEL
    </div>
    <table class="table table-rounded border border-3 border-gray-400 gs-7 m-10">
        <tbody>
            <tr>
                <td colspan="2" class="fw-bolder fs-3 border-bottom border-gray-200">Emprunteur</td>
            </tr>
            <tr>
                <td>Nom / Prénom</td>
                <td>{{ \App\Helpers\Customer\Customer::getName($customer) }}</td>
            </tr>
            <tr>
                <td>Date de Naissance</td>
                <td>{{ \App\Helpers\Customer\Customer::getBirthDate($customer) }}</td>
            </tr>
            <tr>
                <td>Téléphone</td>
                <td>{{ \App\Helpers\Customer\Customer::getPhone($customer) }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ \App\Helpers\Customer\Customer::getEmail($customer->user->email, false) }}</td>
            </tr>
        </tbody>
    </table>
    <table class="table table-rounded border border-3 border-gray-400 gs-7 m-10">
        <tbody>
            <tr>
                <td>Votre situation familiale: {{ $customer->situation->family_situation }}</td>
                <td>Votre habitation: {{ $customer->situation->logement }}</td>
            </tr>
            <tr>
                <td class="border-bottom border-bottom-gray-400">
                    Nombre d'enfant à charge: {{ $customer->situation->child }}<br>
                    Nombre de personne à charge: {{ $customer->situation->person_charged }}
                </td>
                <td class="border-bottom border-bottom-gray-400">Depuis {{ $customer->situation->logement_at->year }}</td>
            </tr>
            <tr>
                <td>Qualité Professionnel:</td>
                <td>{{ $customer->situation->pro_category }}</td>
            </tr>
            <tr>
                <td>Profession:</td>
                <td>{{ $customer->situation->pro_profession }}</td>
            </tr>
        </tbody>
    </table>
    <table class="table table-rounded border border-3 border-gray-400 gs-7 m-10">
        <tbody>
            <tr>
                <td colspan="1">Votre Budget Mensuel</td>
            </tr>
            <tr class="border-bottom border-gray-300">
                <td>
                    <div class="d-flex flex-column justify-content-between">
                        <span>Revenue Professionnel</span>
                        <span class="text-end">{{ eur($customer->situation->pro_incoming) }}</span>
                    </div>
                </td>
                <td>
                    <div class="d-flex flex-row justify-content-between">
                        <span>Loyer</span>
                        <span class="text-end">{{ eur(0.00) }}</span>
                    </div>
                    <div class="d-flex flex-row justify-content-between">
                        <span>Crédit</span>
                        <span class="text-end">{{ eur(0.00) }}</span>
                    </div>
                    <div class="d-flex flex-row justify-content-between">
                        <span>Divers</span>
                        <span class="text-end">{{ eur(0.00) }}</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Total Revenue Mensuel: {{ eur(2000.00) }}</td>
                <td>Total Charge Mensuel: {{ eur(0.00) }}</td>
            </tr>
        </tbody>
    </table>
    <table class="table table-rounded border-3 border-gray-400 gy-7 gs-7 m-10">
        <thead>
            <tr class="fw-bolder fs-5 text-gray-800 border-bottom border-gray-200 text-center">
                <th>Signature de l'emprunteur</th>
                <th>Signature du co-emprunteur</th>
                <th>Signature de la banque</th>
            </tr>
        </thead>
        <tbody>
            <tr class="h-50px">
                <td class="text-center fs-8">
                    @if($document->signed_by_client == true)
                        Signé éléctroniquement le {{ now()->format('d/m/Y') }}.<br>M. MOCKELYN
                    @endif
                </td>
                <td class="text-center fs-8"></td>
                <td class="text-center fs-8">
                    @if($document->signed_by_bank == true)
                        Signé éléctroniquement le {{ now()->format('d/m/Y') }} par la banque
                    @endif
                </td>
            </tr>
        </tbody>
    </table>



</body>
<!--end::Body-->
</html>

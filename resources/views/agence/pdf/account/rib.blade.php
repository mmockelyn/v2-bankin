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
    <table class="table gy-5 gx-5 gs-5 mb-10" style="width: 100%; border: #fff">
        <tbody>
            <tr>
                <td style="width: 50%;">
                    <span class="fw-bold fs-4 text-gray-600 mb-5">Titulaire du compte</span>
                    <div class="fw-bold">
                        {{ \App\Helpers\Customer\Customer::getName($customer) }}<br>
                        {!! \App\Helpers\Customer\Customer::getAdress($customer) !!}<br>
                    </div>
                </td>
                <td style="width: 50%;">
                    <span class="fw-bold fs-4 mb-5">Relevé d’Identité Bancaire</span>
                    <p class="text-gray-400 fs-5">
                        Ce relevé est destiné à être remis, sur leur demande, à vos créanciers ou
                        débiteurs appelés à faire inscrire des opérations à votre compte (virements,
                        paiements de quittances, etc.).<br>
                        Son utilisation vous garantit le bon enregistrement des opérations en cause et
                        vous évite ainsi des réclamations pour erreurs ou retards d'imputation.
                    </p>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table border gy-5 gx-5 gs-5 mb-20" style="width: 100%;">
        <tbody>
            <tr class="">
                <td class="fw-bold text-gray-600">IBAN</td>
                <td class="fw-bold text-gray-600">BIC</td>
            </tr>
            <tr class="bg-gray-200">
                <td>{{ $wallet->iban }}</td>
                <td>{{ $agence->bic }}</td>
            </tr>
        </tbody>
    </table>
    <table class="table border gy-5 gx-5 gs-5" style="width: 100%;">
        <tbody>
        <tr class="">
            <td class="fw-bold text-gray-600">Code Banque</td>
            <td class="fw-bold text-gray-600">Code Guichet</td>
            <td class="fw-bold text-gray-600">Numéro de compte</td>
        </tr>
        <tr class="bg-gray-200">
            <td>{{ $agence->code_banque }}</td>
            <td>{{ $agence->code_guichet }}</td>
            <td>{{ $wallet->number_account }}</td>
        </tr>
        </tbody>
    </table>
    <div class="separator separator-dashed border-gray-600 my-10"></div>
    <table class="table gy-5 gx-5 gs-5 mb-10" style="width: 100%; border: #fff">
        <tbody>
        <tr>
            <td style="width: 50%;">
                <span class="fw-bold fs-4 text-gray-600 mb-5">Titulaire du compte</span>
                <div class="fw-bold">
                    {{ \App\Helpers\Customer\Customer::getName($customer) }}<br>
                    {!! \App\Helpers\Customer\Customer::getAdress($customer) !!}<br>
                </div>
            </td>
            <td style="width: 50%;">
                <span class="fw-bold fs-4 mb-5">Relevé d’Identité Bancaire</span>
                <p class="text-gray-400 fs-5">
                    Ce relevé est destiné à être remis, sur leur demande, à vos créanciers ou
                    débiteurs appelés à faire inscrire des opérations à votre compte (virements,
                    paiements de quittances, etc.).<br>
                    Son utilisation vous garantit le bon enregistrement des opérations en cause et
                    vous évite ainsi des réclamations pour erreurs ou retards d'imputation.
                </p>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="table border gy-5 gx-5 gs-5 mb-20" style="width: 100%;">
        <tbody>
        <tr class="">
            <td class="fw-bold text-gray-600">IBAN</td>
            <td class="fw-bold text-gray-600">BIC</td>
        </tr>
        <tr class="bg-gray-200">
            <td>{{ $wallet->iban }}</td>
            <td>{{ $agence->bic }}</td>
        </tr>
        </tbody>
    </table>
    <table class="table border gy-5 gx-5 gs-5" style="width: 100%;">
        <tbody>
        <tr class="">
            <td class="fw-bold text-gray-600">Code Banque</td>
            <td class="fw-bold text-gray-600">Code Guichet</td>
            <td class="fw-bold text-gray-600">Numéro de compte</td>
        </tr>
        <tr class="bg-gray-200">
            <td>{{ $agence->code_banque }}</td>
            <td>{{ $agence->code_guichet }}</td>
            <td>{{ $wallet->number_account }}</td>
        </tr>
        </tbody>
    </table>

</body>
<!--end::Body-->
</html>

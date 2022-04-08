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
    <div class="text-center fw-bolder fs-3 mb-15 border border-2 m-10 p-3">
        INFORMATIONS PRECONTRACTUELLES EUROPEENNES NORMALISEES EN MATIERE DE CREDIT AUX CONSOMMATEURS
    </div>
    <div class="fs-4 p-10 mt-2 mb-5">UN CREDIT VOUS ENGAGE ET DOIT ETRE REMBOURSE. VERIFIEZ VOS CAPACITES DE REMBOURSEMENT AVANT DE VOUS ENGAGER.</div>
    <div class="m-10">
        <span class="fs-4 fw-bold">1. IDENTITE ET COORDONNEES DU PRETEUR / INTERMEDIAIRE DU CREDIT</span>
        <table class="table table-rounded table-striped  gy-7 gs-7 m-10 w-900px">
            <tbody>
                <tr class="">
                    <td class="fw-bolder">Preteur</td>
                    <td>
                        {{ $agence->name }}
                    </td>
                </tr>
                <tr class="">
                    <td class="fw-bolder">Adresse</td>
                    <td>
                        Siège social: 22 Rue Maryse Bastié, 85100 Les Sables d'Olonne<br>
                        Intermédiaire en assurance immatriculé à l'ORIAS sous le n°08 995 450.
                    </td>
                </tr>
                <tr class="">
                    <td class="fw-bolder">ADRESSE GEOGRAPHIQUE A UTILISER PAR L'EMPRUNTEUR</td>
                    <td>
                        Centre de relation clientèle<br>
                        4 Rue du Coudray<br>
                        44000 Nantes Cedex
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="m-10">
        <span class="fs-4 fw-bold">2. DESCRIPTION DES PRINCIPALES CARACTERISTIQUES DU CREDIT</span>
        <table class="table table-rounded table-striped  gy-7 gs-7 m-10 w-900px">
            <tbody>
            <tr class="">
                <td class="fw-bolder">Type de crédit</td>
                <td>
                    {{ \App\Helpers\Customer\Loan::getTypeContract($loan) }}
                </td>
            </tr>
            <tr class="">
                <td class="fw-bolder">
                    Le Montant total du crédit<br>
                    <i>Il s'agit du total des sommes rendues disponibles en vertu du contrat de crédit</i>
                </td>
                <td>
                    {{ eur($loan->amount_loan) }}
                </td>
            </tr>
            <tr class="">
                <td class="fw-bolder">
                    LES CONDITIONS DE MISE A DISPOSITION DES FONDS
                    <i>Il s’agit de la façon dont vous obtiendrez l’argent et du
                        moment auquel vous l’obtiendrez.</i>
                </td>
                <td>
                    <p class="fs-6">
                        Le montant total du crédit pourra être mis à la disposition de l'emprunteur à compter du 8ème jours suivant l'acceptation
                        du contrat de crédit.<br>
                        En cas de vente à distance, l'accord exprès de ce dernier sera requis pour commencer l'exécution du contrat de crédit avant expiration
                        du délai de rétractation.
                    </p>
                    <p class="fs-6">
                        Le montant total du crédit est versé en une seule fois à l’emprunteur après expiration du délai de
                        rétractation, à la date qu’il a indiquée lors de sa demande de crédit, sauf option " Versements
                        successifs ", ou sur demande expresse de la part de l’emprunteur de mise à disposition des fonds à
                        l’expiration des sept premiers jours suivant l’acceptation de l’offre de contrat de crédit.
                    </p>
                </td>
            </tr>
            <tr class="">
                <td class="fw-bolder">
                    LA DUREE DU CONTRAT DE CREDIT
                </td>
                <td>
                    {{ $loan->duration }} mois
                </td>
            </tr>
            <tr class="">
                <td class="fw-bolder">
                    Les Echéances<br>
                    <i>et le cas échéant, l'ordre dans lequel les échéances seront affectées</i>
                </td>
                <td>
                    <strong>Vous devrez payer ce qui suit:</strong><br>
                    Montant des échéances: {{ eur($loan->mensuality) }}<br>
                    Nombre des échéances: {{ $loan->duration }}<br>
                    Fréquences des échéances: Mensuelle<br><br>
                    <strong>Les intérêts et/ou frais seront dus de la manière suivante:</strong><br>
                    <ul>
                        <li>Intérêts: ils seront inclus dans le montant de l'échéance et perçus selon la même périodicité</li>
                        <li>Frais: ils seront déduits du 1er versement</li>
                        <li>Remboursement des primes d'assurances: En cas d’adhésion à l’assurance facultative, la prime
                            mensuelle d’assurance est à la charge des emprunteurs y compris celle relative à l’assurance
                            souscrite par les cautions. Elle est payable à la même date que l’échéance du crédit</li>
                    </ul>
                </td>
            </tr>
            <tr class="">
                <td class="fw-bolder">
                    LE MONTANT TOTAL QUE VOUS DEVREZ PAYER<br>
                    <i>Il s'agit du montant du capital emprunté majoré des
                        intérêts et des frais éventuels liés à votre crédit</i>
                </td>
                <td>
                    {{ eur($loan->amount_du) }}
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="m-10">
        <span class="fs-4 fw-bold">3. COUT DU CREDIT</span>
        <table class="table table-rounded table-striped  gy-7 gs-7 m-10 w-900px">
            <tbody>
            <tr class="">
                <td class="fw-bolder w-350px">Le Taux Débiteur</td>
                <td>
                    <table class="table table-row-border gy-7 gs-7 m-10">
                        <thead>
                            <tr>
                                <th>Durée de remboursement</th>
                                <th>Solde dù</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($loan->plan->interests as $interet)
                                <tr>
                                    <td>Jusqu'à {{ $interet->duration }} mois</td>
                                    <td>{{ $interet->percent_interest }} %</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr class="">
                <td class="fw-bolder">EST-IL OBLIGATOIRE POUR L’OBTENTION MEME DU
                    CREDIT OU CONFORMEMENT AUX CLAUSES ET
                    CONDITIONS COMMERCIALES DE CONTRACTER :</td>
            </tr>
            <tr class="">
                <td class="fw-bolder">UNE ASSURANCE LIEE AU CREDIT</td>
                <td>NON</td>
            </tr>
            </tbody>
        </table>
    </div>
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

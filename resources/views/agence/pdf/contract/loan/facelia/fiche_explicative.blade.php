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
<body class="body white m-10">
    <div class="mb-5">
        <span class="fs-4 fw-bolder">La présente fiche explicative est établie à l'attention de :</span><br>
        <span class="fs-4">{{ Str::upper(\App\Helpers\Customer\Customer::getName($customer)) }}</span>
    </div>
    <p>Elle a pour objet de vous permettre d'apprécier si le crédit proposé est adapté à vos besoins et à votre situation financière</p>

    <div class="m-10 p-5 border rounded-3 border-2 border-gray-400">
        <span class="fw-bolder mb-5"><u>{{ $loan->plan->name }}</u></span>
        <p>Ce crédit à la consommation vous a été proposé pour répondre à votre besoin de financement, sans que ce crédit soit nécessairement affecté à un projet
            spécifique.</p>
        <span class="fw-bolder mb-5 mt-5"><u>1 - Caractéristiques essentielles du crédit</u></span>
        <p>
            Les caractéristiques essentielles du crédit proposé vous ont été communiquées dans la
            matière de crédit aux consommateurs qui vous a été remise. Vous reconnaissez avoir pris connaissance notamment :
        </p>
        <ul class="list-unstyled">
            <li>- des principales caractéristiques du crédit proposé</li>
            <li>- du coût du crédit proposé</li>
            <li>- des autres aspects juridiques importants (droit de rétractation, remboursement anticipé …)</li>
        </ul>
        <p>
            A cette occasion, vous avez reçu de notre part toutes les explications nécessaires à la bonne compréhension de ces informations, afin de déterminer si le crédit
            proposé est adapté à vos besoins et à votre situation financière
        </p>
        <p>Ce crédit est dit « amortissable » dans la mesure où il se rembourse par échéances périodiques comprenant chacune une part de capital et une part d'intérêts.</p>
        <p>
            Vous avez la possibilité de reporter, d'un, deux ou trois mois, la date de votre première échéance de remboursement. Pendant cette période de report, vous n’avez
            aucune échéance à payer, cependant, les intérêts sont calculés au taux du crédit sur le capital versé. Ces intérêts sont prélevés avec la première échéance.
        </p>
        <p>
            Si vous optez pour un différé d'amortissement du capital :<br>
            Pendant la période de différé d'amortissement du capital, seules les primes d'assurances facultatives, si vous les avez souscrites, et les intérêts de la période de
            différé seront prélevés. Vos échéances ne comportent pas de remboursement du capital. A l'issue de cette période de différé, les échéances comprendront à la fois
            une part de capital et une part d’intérêts. Ce différé d'amortissement du capital entraine une augmentation du coût du crédit.
        </p>
        <p>
            Si vous optez pour un différé d'amortissement du capital et de paiement des intérêts :<br>
            Pendant la période de différé d'amortissement du capital et de paiement des intérêts, seules les primes d'assurances facultatives, si vous les avez souscrites,
            seront prélevées. Vos intérêts sont calculés au taux du crédit et capitalisés, ils s'ajoutent au montant emprunté. A l'issue de cette période de différé, les échéances
            comprendront à la fois une part de capital et une part d'intérêts. Ce différé d'amortissement du capital et de paiement des intérêts entraine une augmentation du
            coût du crédit.
        </p>
        <span class="fw-bolder mb-5 mt-5"><u>2 - Conséquences de ce crédit sur votre situation financière :</u></span>
        <p>
            <strong>Un crédit vous engage et doit être remboursé.</strong><br>
            Les conditions de ce crédit sont déterminées en fonction des informations relatives à votre situation financière, professionnelle et familiale que vous nous avez
            communiquées, et sur la base des préférences que vous avez exprimées. Il est donc important, pour l’appréciation de votre capacité de remboursement, que vous
            n'ayez omis de déclarer aucune charge.<br>
            Sur la base des informations que vous nous avez fournies, nous vous avons indiqué votre taux d'endettement de {{ round($loan->mensuality * 100 / $customer->situation->pro_incoming) }}% ainsi que votre « reste à vivre » de
            {{ eur(\App\Helpers\Customer\Loan::restIn($loan, $customer)) }}.
        </p>
        <span class="fw-bolder mb-5 mt-5"><u>3 - Conséquences de ce crédit sur votre situation financière en cas de défaut de paiement :</u></span>
        <p>
            Nous pourrons exiger le remboursement immédiat du capital restant dû, majoré des intérêts échus mais non payés, ainsi que d'une indemnité égale à 8 % du
            capital dû. Jusqu'à la date de règlement effectif, les sommes restant dues produisent les intérêts de retard, à un taux égal à celui du crédit. Si nous n'exigeons pas
            le remboursement immédiat du capital restant dû, nous pourrons exiger outre le paiement des échéances échues impayées, une indemnité égale à 8 % desdites
            échéances. Cependant, dans le cas où nous accepterions des reports d'échéances à venir, le taux de l'indemnité serait ramené à 4 % des échéances reportées.
            Vous êtes susceptible de faire l'objet d'une déclaration au fichier national des incidents de remboursement des crédits (FICP) tenu par la Banque de France et
            consultable par tous les établissements de crédit et les sociétés de financement.
        </p>
        <p><strong>L'emprunteur</strong> reconnais avoir attesté que le crédit sollicité n'a pas pour objet le remboursement d'au moins deux créances antérieures dont un crédit en cours.</p>
        <p class="fw-bolder">Toutefois, préalablement à toute difficulté financière, nous vous invitons à contacter votre agence pour étudier votre situation.</p>
        <p><strong>Nom(s) et prénom(s) de(s) (l)'emprunteur(s) et de(s) (l)'éventuelle(s) caution(s) :</strong> {{ \App\Helpers\Customer\Customer::getName($customer) }}</p>
    </div>
    <table class="table table-rounded border-3 border-gray-400 gy-7 gs-7 m-10 w-900px">
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

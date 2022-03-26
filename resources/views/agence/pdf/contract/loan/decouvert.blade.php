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
    <title>Autorisation de découvert permanent N°{{ $customer->wallets()->first()->number_account }}</title>
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
        OFFRE DE CONTRAT DE CRÉDIT<br>
        AUTORISATION DE DÉCOUVERT
    </div>
    <p class="p-10 fs-5 mb-10"><strong>La présente offre de crédit est faite en application de l’article L.312-1 et suivants du code de la consommation</strong>.<br>
        Offre de contrat de crédit émise par la {{ $agence->name }}, à {{ $agence->ville }}, le {{ now()->format('d/m/Y') }}<br>
        Durée de validité de l’offre : 15 jours à compter du {{ now()->format('d/m/Y') }}</p>

    <div class="bg-bank text-white p-10 fs-4 fw-bold">PRETEUR</div>
    <p class="p-10 fs-5 mb-10">
        {{ $agence->name }}, Société par Action simplifié Coopérative de BZHM à capital variable régie par les
        articles L512-2 et suivants du code monétaire et financier et l’ensemble des textes relatifs aux Banques Populaires et aux
        établissements de crédit, immatriculée au registre du commerce et des sociétés de Nantes sous le n°521 809 061, dont
        le siège social est situé 22 Rue Maryse Bastié -  44000 Nantes Cedex, intermédiaire en
        assurance immatriculé à l’ORIAS sous le n° 07 004 504.<br><br>
        <strong><i>Ci-après dénommée le « Prêteur » ou la « Banque »</i></strong>
    </p>
    <div class="bg-bank text-white p-10 fs-4 fw-bold">EMPRUNTEUR</div>
    <table class="table gy-5 gx-5">
        <tbody style="border: none;">
            <tr style="border: none;">
                <td class="fw-bold" style="text-decoration: underline">Titulaire du compte</td>
            </tr>
            <tr style="border: none;">
                <td class="p-5 fw-bolder">Nom, Prénom:</td>
                <td class="p-5">{{ \App\Helpers\Customer\Customer::getName($customer) }}</td>
                <td class="p-5 fw-bolder">Matricule:</td>
                <td class="p-5">{{ $customer->user->identifiant }}</td>
            </tr>
            <tr style="border: none;">
                <td class="p-5 fw-bolder">Adresse:</td>
                <td class="p-5" colspan="2">{{ \App\Helpers\Customer\Customer::getAdress($customer) }}</td>
            </tr>
        </tbody>
    </table>
    <strong class="p-10 fs-5 mb-10"><i>Ci-après dénommé(e)(s) l’"Emprunteur" ou le « Client »</i></strong>
    <div class="bg-bank text-white p-10 fs-4 fw-bold">CARACTERISTIQUES ESSENTIELLES DU CREDIT</div>
    <p class="p-10 fs-5 mb-10">
        <strong><u>Type de crédit:</u> AUTORISATION DE DECOUVERT</strong><br><br>
        <strong class="mt-3">Condition de mise à disposition des fonds</strong><br>
        Le Prêteur autorise l’Emprunteur à faire fonctionner le compte désigné ci-dessous en position débitrice dans la limite du
        montant précité et pour une durée indéterminée. Il est ici précisé, en tant que de besoin, que la présente autorisation de
        découvert se substitue à toute autre autorisation antérieure.<br><br>
        <strong class="mt-3">Désignation du compte : {{ $customer->wallets()->first()->number_account }}</strong><br>
        Le contrat de crédit ne pourra pas commencer à être exécuté et les fonds ne pourront être utilisés qu’à l’expiration du
        délai de rétractation de 14 jours, ou dès le 8ème jour sur demande expresse de l’Emprunteur.<br><br>
        <strong class="mt-3">Durée du contrat de crédit :</strong> le présent contrat est conclu pour une durée indéterminée.<br><br><br>
        <strong class="mt-3">Remboursement par l’Emprunteur :</strong><br>
        Le compte peut être débiteur à concurrence du montant précisé ci-dessus en dehors de toute prise d’effet d’une
        dénonciation de l’autorisation de découvert par l’Emprunteur ou par le Prêteur. Le compte devra redevenir en position
        créditrice lors de la prise d’effet de la dénonciation de l’autorisation, objet du présent contrat, par l’Emprunteur ou le
        Prêteur, notamment à l’expiration du délai de préavis éventuel.<br><br>
        <strong class="mt-3">Taux débiteur :</strong><br>
        Le taux débiteur est révisable. Toute position débitrice résultant de l’utilisation du découvert donne lieu
        à la perception d’intérêts débiteurs <strong>Taux variable : {{ config('tax.TBBDB') }}% + {{ config('tax.overdraft') }}%, SOIT A CE JOUR
            {{ config('tax.TBBDB') + config('tax.overdraft') }}% au {{ now()->format('d/m/Y') }}.</strong><br><br>
        e taux indiqué est ainsi constitué d’un taux de référence majoré d’un certain nombre de points. Ce taux de référence est
        contractuellement sujet à variation et entraîne la variation du taux débiteur. Le Prêteur informera préalablement l’Emprunteur
        de chaque variation du taux de référence par une mention portée sur son relevé de compte. Le relevé de compte
        mentionnera par ailleurs, le taux annuel effectif global des intérêts portés au débit du compte.<br><br>
        Le relevé de compte mentionnera par ailleurs, le taux annuel effectif global des intérêts portés au débit du compte.
        A réception de cette information, l’emprunteur pourra sur demande écrite adressée à la banque, refuser cette révision.
        Dans ce cas, l'autorisation de découvert prendra fin et le remboursement du crédit déjà utilisé devra intervenir dans les
        30 jours suivant le refus de la révision.<br><br>
        En cas de perturbations affectant les marchés, entraînant la disparition du taux de référence, le Prêteur procèdera
        immédiatement au remplacement de ce taux par un taux de marché équivalent qui sera porté à la connaissance de
        l’Emprunteur par tout moyen et notamment par une mention portée sur le relevé de compte. Le nouveau taux sera
        appliqué de façon rétroactive au jour de la modification, disparition ou cessation de publication du taux de référence
        d’origine.<br><br>
        Si le taux de référence s’avère négatif, il sera réputé égal à zéro.
        Les intérêts sont automatiquement prélevés sur le compte de l’Emprunteur et capitalisés chaque trimestre.<br><br>
        <strong class="mt-3">Taux Annuel Effectif Global (TAEG), hors assurance facultative : {{ number_format(config('tax.TAEG'), 2, ',', ' ') }} % l’an dont frais de dossier de 0 Euros. </strong><br>
        Le taux annuel effectif global mentionné ci-dessus est donné à titre indicatif. Il tient compte de l’utilisation totale du
        montant du découvert sur une durée de 3 mois consécutifs. Il tient également compte des frais de dossier et des frais
        applicables au découvert en compte.<br>
        Le TAEG réellement appliqué sera mentionné sur le relevé de compte.<br><br>
        <strong class="mt-3">Montant total du crédit dû par l’Emprunteur : {{ eur($customer->wallets()->first()->outstanding) }} </strong><br>
        Le compte peut être débiteur à concurrence du montant précisé ci-dessus en dehors de toute prise d’effet d’une
        dénonciation de l’autorisation de découvert par l’Emprunteur ou par le Prêteur.<br><br>
        L’autorisation de découvert est remboursable :<br>
        - en une seule fois suite à la renonciation à tout moment et sans préavis par l’Emprunteur à l’autorisation de découvert<br>
        - en une seule fois suite à dénonciation par le Prêteur, à l’issu du délai de préavis de deux mois au terme duquel le solde débiteur du compte deviendra exigible.<br>
        - de façon échelonnée si l’Emprunteur accepte un échéancier formalisé par écrit et signé par l’Emprunteur et le Prêteur, annexé au présent contrat.
        <br><br>
    </p>
    <div class="page-break"></div>
    <div class="p-10 fs-5 mb-10">
        <div class="fw-bold fs-4">ACCEPTATION DE L’OFFRE DE CONTRAT DE CREDIT PAR L’EMPRUNTEUR</div>
        <p>Après avoir reçu et pris connaissance de la Fiche d’Information Précontractuelle annexée aux présentes et l’ensemble
            des conditions de l’offre de contrat de crédit, je déclare accepter la présente offre de contrat de crédit</p>
        <p>Je reconnais avoir reçu toutes les explications de la part du Prêteur me permettant de déterminer si le présent crédit est
            adapté à mes besoins et ma situation financière et me permettant d’appréhender clairement l’étendue de mon
            engagement. Mon attention a été attirée sur les caractéristiques essentielles du crédit et sur les conséquences que ce
            crédit peut avoir sur ma situation financière.<br>
            Je reconnais rester en possession d’un exemplaire de cette offre, dotée d’un formulaire détachable de « bordereau de
            rétractation »</p>
    </div>
    <table class="table table-rounded border gy-7 gs-7 m-10">
        <thead>
            <tr class="fw-bolder fs-5 text-gray-800 border-bottom border-gray-200 text-center">
                <th>Signature de l'emprunteur</th>
                <th>Signature du co-emprunteur</th>
                <th>Signature de la banque</th>
            </tr>
        </thead>
        <tbody>
            <tr class="h-50px">
                <td class="text-center fs-8">Signé éléctroniquement le {{ now()->format('d/m/Y') }}.<br>M. MOCKELYN</td>
                <td class="text-center fs-8"></td>
                <td class="text-center fs-8">Signé éléctroniquement le {{ now()->format('d/m/Y') }} par la banque</td>
            </tr>
        </tbody>
    </table>



</body>
<!--end::Body-->
</html>

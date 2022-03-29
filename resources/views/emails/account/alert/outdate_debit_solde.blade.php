@extends("emails.layouts.app")

@section("content")
    <div class="d-flex flex-column bg-gray-300 ms-20 me-20 mt-20 mb-5 w-600px">
        <!--begin::Alert-->
        <div class="alert bg-danger d-flex flex-column flex-sm-row p-5 mb-10 mt-10">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                <!--begin::Content-->
                <span class="fs-2tx fw-bolder text-start">VOTRE COMPTE PRESENTE TOUJOURS UN SOLDE DEBITEUR DEPUIS LE {{ $wallet->date_alert_debit->format('d/m/Y') }}</span>
                <!--end::Content-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Alert-->
        <div class="ms-10 me-10 mb-5">
            <span class="fw-bolder fs-3 mb-5">Bonjour {{ \App\Helpers\Customer\Customer::getFirstname($customer) }}</span>
            <p>Nous souhaitons attirer votre attention sur le fais que votre compte N°{{ $wallet->number_account }} présente toujours un solde débiteur de <strong class="text-danger">{{ eur($solde) }}.</strong> et ceux malgré notre relance du <strong>{{ $wallet->date_alert_debit->format('d/m/Y') }}</strong></p>
            <p>Conformément à nos conditions, <strong>des frais supplémentaire vont être appliquer à chaque transactions effectuer sur votre compte (1,5% du montant de la transaction) facturé à la fin du mois.</strong></p>
            <p>Nous vous rappelons que au delà de 30 jours consécutif de compte débiteur sans autorisation, une lettre de dénonciation d'utilisation inabithuel de votre compte vous sera envoyé et votre compte sera suspendu.</p>
            <p>Vous pouvez évité cela de la manière suivant:</p>
            <ul>
                <li>Alimenter votre compte par carte bancaire</li>
                <li>Effectuer un virement vers le compte débiteur</li>
            </ul>
            <p>Nous espérons que cette situation est passagère, et nous vous souhaitons une bonne journée.</p>
        </div>
        @include("emails.layouts.salutation")
    </div>
@endsection

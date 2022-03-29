@extends("emails.layouts.app")

@section("content")
    <div class="d-flex flex-column bg-gray-300 ms-20 me-20 mt-20 mb-5 w-600px">
        <!--begin::Alert-->
        <div class="alert bg-danger d-flex flex-column flex-sm-row p-5 mb-10 mt-10">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                <!--begin::Content-->
                <span class="fs-2tx fw-bolder text-start">VOTRE COMPTE PRESENTE UN SOLDE DEBITEUR</span>
                <!--end::Content-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Alert-->
        <div class="ms-10 me-10 mb-5">
            <span class="fw-bolder fs-3 mb-5">Bonjour {{ \App\Helpers\Customer\Customer::getFirstname($customer) }}</span>
            <p>Nous souhaitons attirer votre attention sur le fais que votre compte N°{{ $wallet->number_account }} présente actuellement un solde débiteur de <strong class="text-danger">{{ eur($solde) }}.</strong></p>
            <p>Pour le moment, rien de bien alarment, mais si votre compte est toujours débiteur au delà des 15 jours à compte de ce jours, des frais supplémentaires vont s'appliquer à votre compte pour chaque transaction effectuer sur ce compte.</p>
            <p>Au delà de 30 jours consécutif, une lettre de dénonciation d'utilisation inabithuel de votre compte vous sera envoyé et votre compte sera suspendu.</p>
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

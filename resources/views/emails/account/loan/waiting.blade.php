@extends("emails.layouts.app")

@section("content")
    <div class="d-flex flex-column bg-gray-300 ms-20 me-20 mt-20 mb-5 w-600px">
        <!--begin::Alert-->
        <div class="alert bg-warning d-flex flex-column flex-sm-row p-5 mb-10 mt-10">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                <!--begin::Content-->
                <span class="fs-2tx fw-bolder text-start">Votre demande de pret N° {{ $loan->reference }}</span>
                <!--end::Content-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Alert-->
        <div class="ms-10 me-10 mb-5">
            <span class="fw-bolder fs-3 mb-5">Bonjour {{ \App\Helpers\Customer\Customer::getFirstname($loan->customer) }}</span>
            <p>
                Votre dossier de pret N° {{ $loan->reference }} est actuellement à l'étude par notre équipe financière.<br>
                Nous vous notifierons de l'avancer de votre dossier par mail dans les 24H.
            </p>
        </div>
        @include("emails.layouts.salutation")
    </div>
@endsection

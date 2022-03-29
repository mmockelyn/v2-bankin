@extends("emails.layouts.app")

@section("content")
    <div class="d-flex flex-column bg-gray-300 ms-20 me-20 mt-20 mb-5 w-600px">
        <!--begin::Alert-->
        <div class="alert bg-bank d-flex flex-column flex-sm-row p-5 mb-10 mt-10">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                <!--begin::Content-->
                <span class="fs-2tx fw-bolder text-start">Un nouveau chequier à été commander</span>
                <!--end::Content-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Alert-->
        <div class="ms-10 me-10 mb-5">
            <span class="fw-bolder fs-3 mb-5">Bonjour {{ \App\Helpers\Customer\Customer::getFirstname($customer) }}</span>
            <p>Un nouveau chéquier portant le numéro <strong>4580002</strong> à été commander le <strong>{{ now()->format('d/m/Y à H:i') }}</strong>.</p>
            <p>La commande à été prise en compte et vous serez informer de sont suivi par mail et via votre espace client.</p>
        </div>
        @include("emails.layouts.salutation")
    </div>
@endsection

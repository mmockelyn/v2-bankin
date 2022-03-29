@extends("emails.layouts.app")

@section("content")
    <div class="d-flex flex-column bg-gray-300 ms-20 me-20 mt-20 mb-5 w-600px">
        <!--begin::Alert-->
        <div class="alert bg-danger d-flex flex-column flex-sm-row p-5 mb-10 mt-10">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                <!--begin::Content-->
                <span class="fs-2tx fw-bolder text-start">VOTRE COMPTE A ETE REACTIVE</span>
                <!--end::Content-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Alert-->
        <div class="ms-10 me-10 mb-5">
            <span class="fw-bolder fs-3 mb-5">Bonjour {{ \App\Helpers\Customer\Customer::getFirstname($customer) }}</span>
            <p>Nous avons constaté que votre compte est de nouveau créditeur.</p>
            <p>Il a donc été par conséquent <strong class="text-success">réactivé</strong>.</p>
            <p>Vous pouvez utilisé de nouveau votre compte N°{{ $wallet->number_account }} dans des conditions normal de fonctionnement.</p>
        </div>
        @include("emails.layouts.salutation")
    </div>
@endsection

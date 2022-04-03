@extends("emails.layouts.app")

@section("content")
    <div class="d-flex flex-column bg-gray-300 ms-20 me-20 mt-20 mb-5 w-600px">
        <!--begin::Alert-->
        <div class="alert bg-danger d-flex flex-column flex-sm-row p-5 mb-10 mt-10">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                <!--begin::Content-->
                <span class="fs-2tx fw-bolder text-start">MOT DE PASSE</span>
                <!--end::Content-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Alert-->
        <div class="ms-10 me-10 mb-5">
            <span class="fw-bolder fs-3 mb-5">Bonjour {{ \App\Helpers\Customer\Customer::getFirstname($user->customer) }}</span>
            <p>Votre compte à été créer avec succès.</p>
            <p>Vos identifiant de connexion sont les suivants:</p>
            <ul class="list-unstyled">
                <li><strong>Adresse Mail:</strong> {{ $user->email }}</li>
                <li><strong>Mot de passe provisoire:</strong> {{ $password }}</li>
            </ul>
            <p>Ce mot de passe est provisoire, veuillez le modifier sur votre espace client dès que possible.</p>
        </div>
        @include("emails.layouts.salutation")
    </div>
@endsection

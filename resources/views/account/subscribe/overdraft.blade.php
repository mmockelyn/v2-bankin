@extends("account.layouts.layout")

@section("css")

@endsection

@section('toolbar')
    <!--begin::Toolbar-->
    <div class="toolbar py-5 py-lg-15" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-xxl d-flex flex-center justify-content-between">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column me-3">
                <!--begin::Title-->
                <h1 class="d-flex text-white fw-bolder my-1 fs-1">Demande de découvert autorisé</h1>
                <!--end::Title-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
@endsection

@section("content")
    <div class="card shadow-lg mb-10">
        <div class="card-body">
            <div>Votre demande porte sur une demande de découvert autorisé.</div>
            <p>Suivant nos conditions, cette demande comportent certaine condition:</p>
            <ul>
                <li>Ne pas être demandeur d'emploi</li>
                <li>Un revenue supérieur à {{ eur(1000) }}</li>
                <li>Avoir un compte créditeur au moment de la demande.</li>
                <li>Ne pas avoir déja un découvert.</li>
            </ul>
            <div class="d-flex flex-row flex-center mt-10">
                <button class="btn btn-bank" id="simulate" data-action="overdraft" data-incoming="{{ $customer->situation->pro_incoming }}" data-customer="{{ $customer }}">Simuler ma demande</button>
            </div>
        </div>
    </div>
    <div class="card shadow-lg mb-10">
        <div class="card-body" id="simulateResult"></div>
    </div>
@endsection

@section("script")
    @include("scripts.account.subscription.overdraft")
@endsection

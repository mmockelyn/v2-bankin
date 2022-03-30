@extends("account.layouts.layout")

@section("css")

@endsection

@section('toolbar')
    <!--begin::Toolbar-->
    <div class="toolbar py-5 py-lg-15" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column me-3">
                <!--begin::Title-->
                <h1 class="d-flex text-white fw-bolder my-1 fs-3">Mes Documents</h1>
                <!--end::Title-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
@endsection

@section("content")
    <div class="card shadow-lg">
        <div class="card-body">
            <a href="{{ route('account.document.gdd') }}" class="card bg-gray-200 bg-hover-lighten h-100px mb-5">
                <!--begin::Body-->
                <div class="card-body d-flex align-items-center mb-7">
                    <div class="symbol symbol-50px me-5">
                        <div class="symbol-label fs-2 fw-bold text-success"><i class="fa-regular fa-file-lines"></i></div>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="fw-bolder text-dark">Consulter mes documents</div>
                        <span class="text-muted">Accéder à mes documents bancaires (relevés de compte, courriers, etc...)</span>
                    </div>
                </div>
                <!--end::Body-->
            </a>
            <a href="#showRib" data-bs-toggle="modal" class="card bg-gray-200 bg-hover-lighten h-100px mb-5">
                <!--begin::Body-->
                <div class="card-body d-flex align-items-center mb-7">
                    <div class="symbol symbol-50px me-5">
                        <div class="symbol-label fs-2 fw-bold text-success"><i class="fa-solid fa-print"></i></div>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="fw-bolder text-dark">Imprimer mon RIB/IBAN</div>
                        <span class="text-muted">Consulter et imprimer le RIB/IBAN de mes comptes bancaires</span>
                    </div>
                </div>
                <!--end::Body-->
            </a>
            <a href="{{ route('account.document.transmiss') }}" class="card bg-gray-200 bg-hover-lighten h-100px mb-5">
                <!--begin::Body-->
                <div class="card-body d-flex align-items-center mb-7">
                    <div class="symbol symbol-50px me-5">
                        <div class="symbol-label fs-2 fw-bold text-success"><i class="fa-solid fa-file-arrow-up"></i></div>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="fw-bolder text-dark">Mes documents à transmettre</div>
                        <span class="text-muted">Acceder à la liste des documents à transmettre à la demande de votre banque.</span>
                    </div>
                </div>
                <!--end::Body-->
            </a>
        </div>
    </div>
@endsection

@section("script")
    @include("scripts.account.document.index")
@endsection

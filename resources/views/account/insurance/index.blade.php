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
                <h1 class="d-flex text-white fw-bolder my-1 fs-3">Assurance</h1>
                <!--end::Title-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
@endsection

@section("content")
    <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-3x mb-5 fs-2 fw-bold  w-100 p-5 bg-light rounded justify-content-center">
        <li class="nav-item">
            <a class="nav-link text-gray-800 active" data-bs-toggle="tab" href="#contracts">Contrats</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-gray-800" data-bs-toggle="tab" href="#claims">Sinistres</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-gray-800" data-bs-toggle="tab" href="#simulate">Simulation</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="contracts" role="tabpanel">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="mb-5">
                        <div class="fs-3 fw-bold mb-2">Véhicules</div>

                        <div class="alert alert-dismissible align-items-center bg-light border border-bank border-3 border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                            <!--begin::Icon-->
                            <!--begin::Svg Icon | path: icons/duotune/general/gen007.svg-->
                            <i class="fa-solid fa-car-burst fa-2xl text-bank me-4 mb-5 mb-sm-0"></i>
                            <!--end::Svg Icon-->
                            <!--end::Icon-->
                            <!--begin::Content-->
                            <div class="d-flex flex-column pe-0 pe-sm-10">
                                <h5 class="mb-1">Le contrat d'assurance automobile modulable</h5>
                                <span>Assurée votre véhicule au plus près de vos besoins et de votre budget</span>
                            </div>
                            <!--end::Content-->
                            <!--begin::Close-->

                            <a href="" class="btn btn-flush position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 ms-sm-auto">Découvrir</a>
                            <!--end::Close-->
                        </div>

                    </div>

                    <div class="mb-5">
                        <div class="fs-3 fw-bold mb-2">Logement</div>
                        @if(request()->user()->customer->insuranceHomes()->count() == 0)
                        <div class="alert alert-dismissible align-items-center bg-light border border-bank border-3 border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                            <!--begin::Icon-->
                            <!--begin::Svg Icon | path: icons/duotune/general/gen007.svg-->
                            <i class="fa-solid fa-house fa-2xl text-bank me-4 mb-5 mb-sm-0"></i>
                            <!--end::Svg Icon-->
                            <!--end::Icon-->
                            <!--begin::Content-->
                            <div class="d-flex flex-column pe-0 pe-sm-10">
                                <h5 class="mb-1">Le contrat d'assurance habitation</h5>
                                <span>Assuré votre habitation et ses habitant facilement</span>
                            </div>
                            <!--end::Content-->
                            <!--begin::Close-->

                            <a href="" class="btn btn-flush position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 ms-sm-auto">Découvrir</a>
                            <!--end::Close-->
                        </div>
                        @else
                        @foreach(request()->user()->customer->insuranceHomes as $insurance)
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
                        @endforeach
                        @endif
                    </div>

                    <div class="mb-5">
                        <div class="fs-3 fw-bold mb-2">Santé</div>
                        <a href="" class="alert alert-dismissible align-items-center bg-light border border-bank border-3 border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                            <!--begin::Icon-->
                            <!--begin::Svg Icon | path: icons/duotune/general/gen007.svg-->
                            <i class="fa-solid fa-staff-aesculapius fa-2xl text-bank me-4 mb-5 mb-sm-0"></i>
                            <!--end::Svg Icon-->
                            <!--end::Icon-->
                            <!--begin::Content-->
                            <div class="d-flex flex-column pe-0 pe-sm-10">
                                <h5 class="mb-1">Consulter vos contrats et vos remboursements sur votre espace santé</h5>
                            </div>
                            <!--end::Content-->
                        </a>
                    </div>

                    <div class="mb-5">
                        <div class="fs-3 fw-bold mb-2">Quotidien</div>
                        <div class="alert alert-dismissible align-items-center bg-light border border-bank border-3 border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                            <!--begin::Icon-->
                            <!--begin::Svg Icon | path: icons/duotune/general/gen007.svg-->
                            <i class="fa-solid fa-shield-heart fa-2xl text-bank me-4 mb-5 mb-sm-0"></i>
                            <!--end::Svg Icon-->
                            <!--end::Icon-->
                            <!--begin::Content-->
                            <div class="d-flex flex-column pe-0 pe-sm-10">
                                <h5 class="mb-1">Un quotidien serein</h5>
                                <span>Assuré vos objets des aléas de la vie courante</span>
                            </div>
                            <!--end::Content-->
                            <!--begin::Close-->

                            <a href="" class="btn btn-flush position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 ms-sm-auto">Découvrir</a>
                            <!--end::Close-->
                        </div>
                    </div>

                    <div class="mb-5">
                        <div class="fs-3 fw-bold mb-2">Famille</div>
                        <div class="alert alert-dismissible align-items-center bg-light border border-bank border-3 border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                            <!--begin::Icon-->
                            <!--begin::Svg Icon | path: icons/duotune/general/gen007.svg-->
                            <i class="fa-solid fa-heart-pulse fa-2xl text-bank me-4 mb-5 mb-sm-0"></i>
                            <!--end::Svg Icon-->
                            <!--end::Icon-->
                            <!--begin::Content-->
                            <div class="d-flex flex-column pe-0 pe-sm-10">
                                <h5 class="mb-1">Une assurance pour votre famille</h5>
                                <span>Protégez-vous et vos proches ?</span>
                            </div>
                            <!--end::Content-->
                            <!--begin::Close-->

                            <a href="" class="btn btn-flush position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 ms-sm-auto">Découvrir</a>
                            <!--end::Close-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="claims" role="tabpanel">
            <div class="card shadow-sm mb-5">
                <div class="card-body">
                    <div class="d-flex flex-row justify-content-center">
                        <button class="btn btn-outline btn-outline-bank btn-hover-primary w-500px me-3">Déclarer un sinistre</button>
                        <button class="btn btn-outline btn-outline-bank btn-hover-primary w-500px me-3">Déclarer un sinistre par téléphone</button>
                    </div>
                </div>
            </div>
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Liste de mes déclarations de sinistre</h3>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="simulate" role="tabpanel">

        </div>
    </div>
@endsection

@section("script")
    @include("scripts.account.insurance.index")
@endsection

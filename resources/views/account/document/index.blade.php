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
            @if(request()->user()->safebox_id != null)
                <a href="//safebox.finbank.tk" class="card bg-gray-200 bg-hover-lighten h-100px mb-5">
                    <!--begin::Body-->
                    <div class="card-body d-flex align-items-center mb-7">
                        <div class="symbol symbol-50px me-5">
                            <div class="symbol-label fs-2 fw-bold text-success"><i class="fa-regular fa-file-lines"></i></div>
                        </div>
                        <div class="d-flex flex-column">
                            <div class="fw-bolder text-dark">Consulter mon Coffre-Fort Numérique</div>
                            <span class="text-muted">Regrouper dans un espace sécurisé mes documents numériques personnels et professionnels</span>
                        </div>
                    </div>
                    <!--end::Body-->
                </a>
            @else
                <div class="card bg-gray-200 bg-hover-lighten opacity-15 h-100px mb-5" data-bs-toggle="tooltip" title="Vous devez souscrire à une offre SafeBox pour acceder à cette espace.">
                    <!--begin::Body-->
                    <div class="card-body d-flex align-items-center mb-7">
                        <div class="symbol symbol-50px me-5">
                            <div class="symbol-label fs-2 fw-bold text-success"><i class="fa-regular fa-file-lines"></i></div>
                        </div>
                        <div class="d-flex flex-column">
                            <div class="fw-bolder text-dark">Consulter mon Coffre-Fort Numérique</div>
                            <span class="text-muted">Regrouper dans un espace sécurisé mes documents numériques personnels et professionnels</span>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
            @endif
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
    <div class="modal bg-white fade" tabindex="-1" id="showRib">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content shadow-none">
                <div class="modal-header">
                    <h5 class="modal-title">Consultation et impression RIB/IBAN</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <div class="d-flex flex-row justify-content-between">
                        @foreach(request()->user()->customer->wallets as $wallet)
                            <div class="card shadow-lg w-600px">
                                <div class="card-header bg-bank">
                                    <h3 class="card-title text-white">Compte N°{{ $wallet->number_account }}</h3>
                                    <div class="card-toolbar">
                                        @switch($wallet->status)
                                            @case("PENDING")
                                            <span class="badge badge-lg badge-warning">Ouverture en cours</span>
                                            @break

                                            @case("FAILED")
                                            <span class="badge badge-lg badge-danger">ERREUR</span>
                                            @break

                                            @case("SUSPENDED")
                                            <span class="badge badge-lg badge-warning">Compte suspendu</span>
                                            @break

                                            @case("CLOSED")
                                            <span class="badge badge-lg badge-warning">Compte clôturer</span>
                                            @break

                                            @case("ACTIVE")
                                            <span class="badge badge-lg badge-success">Compte Actif</span>
                                            @break
                                        @endswitch
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="text-center mb-10">
                                        <div class="fs-1 fw-light">{{ \App\Helpers\Customer\Customer::getType($wallet->customer) }}</div>
                                        <div class="fs-4">{{ $wallet->number_account }} {{ $wallet->agency->name }} - {{ \App\Helpers\Customer\Customer::getName($wallet->customer) }}</div>
                                    </div>
                                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                                        <div class="d-flex flex-column">
                                            <div class="fs-2">IBAN</div>
                                            <div class="">{{ $wallet->iban }}</div>
                                        </div>
                                        <i class="fa-solid fa-file fa-xl"></i>
                                    </div>
                                    <div class="separator border-2 my-5"></div>
                                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                                        <div class="d-flex flex-column">
                                            <div class="fs-2">BIC</div>
                                            <div class="">{{ $wallet->agency->bic }}</div>
                                        </div>
                                        <i class="fa-solid fa-file fa-xl"></i>
                                    </div>
                                    <div class="separator border-2 my-5"></div>
                                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-10">
                                        <div class="d-flex flex-column">
                                            <div class="fs-2">Code banque</div>
                                            <div class="">{{ $wallet->agency->code_banque }}</div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <div class="fs-2">Code guichet</div>
                                            <div class="">{{ $wallet->agency->code_guichet }}</div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <div class="fs-2">N° Compte</div>
                                            <div class="">{{ $wallet->number_account }}</div>
                                        </div>
                                    </div>
                                    <div class="fs-1">{{ config('app.name') }}</div>
                                    <div class="fs-2">Agence: {{ $wallet->agency->name }}</div>
                                </div>
                                <div class="card-footer d-flex flex-center">
                                    <a href="" class="btn btn-bank w-500px">Télécharger</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    @include("scripts.account.document.index")
@endsection

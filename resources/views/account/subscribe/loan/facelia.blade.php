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
                <h1 class="d-flex text-white fw-bolder my-1 fs-3">Crédit Renouvelable Facelia</h1>
                <!--end::Title-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
@endsection

@section("content")
    <form action="{{ route('account.subscribe.store') }}" method="post" id="faceliaForm">
        @csrf
        <input type="hidden" name="action" value="facelia">
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-lg">

                    <div class="card-body">
                        <div class="w-lg-500 mb-10">
                            <!--begin::Label-->
                            <label class="fs-3 fw-bold mb-2">
                                Montant à emprunter
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                   title="Choose the budget allocated for each day. Higher budget will generate better results"></i>
                            </label>
                            <!--end::Label-->

                            <!--begin::Slider-->
                            <div class="d-flex flex-column text-center">
                                <div class="d-flex align-items-start justify-content-center mb-7">
                                    <span class="fw-bolder fs-4 mt-1 me-2">€</span>
                                    <span class="fw-bolder fs-3x" id="label_amount"></span>
                                    <span class="fw-bolder fs-3x">.00</span>
                                </div>
                                <div id="slider_amount" class="noUi-sm"></div>
                                <input type="hidden" name="amount">
                            </div>
                            <!--end::Slider-->
                        </div>
                        <div class="w-lg-500 mb-10">
                            <!--begin::Label-->
                            <label class="fs-3 fw-bold mb-2">
                                Mensualité
                            </label>
                            <!--end::Label-->

                            <!--begin::Dialer-->
                            <div class="input-group w-md-300px"
                                 data-kt-dialer="true"
                                 data-kt-dialer-min="3"
                                 data-kt-dialer-max="36"
                                 data-kt-dialer-step="1">

                                <!--begin::Decrease control-->
                                <button class="btn btn-icon btn-outline btn-outline-secondary" type="button"
                                        data-kt-dialer-control="decrease" onclick="updateMensuality()">
                                    <i class="bi bi-dash fs-1"></i>
                                </button>
                                <!--end::Decrease control-->

                                <!--begin::Input control-->
                                <input type="text" class="form-control" id="mensuality" placeholder="" value="3"
                                       data-kt-dialer-control="input" name="duration"/>
                                <!--end::Input control-->

                                <!--begin::Increase control-->
                                <button class="btn btn-icon btn-outline btn-outline-secondary" type="button"
                                        data-kt-dialer-control="increase" onclick="updateMensuality()">
                                    <i class="bi bi-plus fs-1"></i>
                                </button>
                                <!--end::Increase control-->
                            </div>
                            <!--end::Dialer-->
                        </div>
                        <div class="w-lg-500 mb-10">
                            <label class="fs-3 fw-bold mb-2 me-5">
                                Assurance Facultative
                            </label>
                            <div class="btn-group w-100 w-lg-50" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                                <!--begin::Radio-->
                                <label class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success active" data-kt-button="true">
                                    <!--begin::Input-->
                                    <input class="btn-check" type="radio" name="insurance" checked="checked" value=""/>
                                    <!--end::Input-->
                                    Aucune
                                </label>
                                <!--end::Radio-->
                                <!--begin::Radio-->
                                <label class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success" data-kt-button="true">
                                    <!--begin::Input-->
                                    <input class="btn-check" type="radio" name="insurance" value="D"/>
                                    <!--end::Input-->
                                    D
                                </label>
                                <!--end::Radio-->

                                <!--begin::Radio-->
                                <label class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success" data-kt-button="true">
                                    <!--begin::Input-->
                                    <input class="btn-check" type="radio" name="insurance" value="DIM"/>
                                    <!--end::Input-->
                                    DIM
                                </label>
                                <!--end::Radio-->

                                <!--begin::Radio-->
                                <label class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success" data-kt-button="true">
                                    <!--begin::Input-->
                                    <input class="btn-check" type="radio" name="insurance" value="DIMC" />
                                    <!--end::Input-->
                                    DIMC
                                </label>
                                <!--end::Radio-->
                            </div>
                            <!--end::Radio group-->
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-lg" id="recap">
                    <div class="card-header">
                        <h3 class="card-title">Récapitulatif de votre demande</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-row justify-content-between w-auto">
                            <div class="">Montant emprunter</div>
                            <div class="label_amount">0,00 €</div>
                        </div>
                        <div class="d-flex flex-row justify-content-between w-auto">
                            <div class="">Intérêt</div>
                            <div class="label_interest">0,00 €</div>
                        </div>
                        <div class="d-flex flex-row justify-content-between w-auto mb-10">
                            <div class="">Total Dù</div>
                            <div class="fw-bolder label_du">0,00 €</div>
                        </div>
                        <div class="d-flex flex-row justify-content-between w-auto">
                            <div class="">Mensualité</div>
                            <div class=""><span class="label_mensuality">30</span> Mensualités de <span
                                    class="label_amount_mensuality">0,00 €</span></div>
                        </div>
                        <div class="d-flex flex-row justify-content-between w-auto">
                            <div class="">TAEG</div>
                            <div class="label_taux">21,00 %</div>
                        </div>
                        <div class="d-flex flex-row justify-content-between w-auto mb-10">
                            <div class="">Durée de remboursement</div>
                            <div class="label_duration">30 Mois</div>
                        </div>
                        <div class="d-flex flex-row justify-content-between w-auto">
                            <div class="">Type d'assurance</div>
                            <div class="label_insurance">30 Mois</div>
                        </div>
                        <div class="d-flex flex-row justify-content-between w-auto">
                            <div class="">Montant de l'assurance </div>
                            <div class="label_amount_insurance">30 Mois</div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-bank">
                        <span class="indicator-label">
                            Souscrire
                        </span>
                            <span class="indicator-progress">
                            Veuillez patientez... <span
                                    class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section("script")
    @include("scripts.account.subscription.loan.facelia")
@endsection

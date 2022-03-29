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
                <h1 class="d-flex text-white fw-bolder my-1 fs-3">Moyen de paiement</h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->
            @if(request()->user()->customer->cards()->get()->count() <= request()->user()->customer->setting->nb_carte_physique)
            <div class="d-flex">
                <button class="btn btn-bank" data-bs-toggle="modal" data-bs-target="#add-credit-card">Demander un nouvelle carte</button>
            </div>
            @endif
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
@endsection

@section("content")
    <div class="card shadow-lg mb-10">
        <div class="card-body">
            <h2 class="fw-bold fs-4 mb-5">Mes cartes</h2>
            @foreach(request()->user()->customer->wallets as $wallet)

                    <div class="d-flex flex-row justify-content-around flex-center">
                        @foreach($wallet->cards as $card)
                        <div class="cursor-pointer card h-200px w-350px bgi-no-repeat bgi-size-cover me-5 showCard" data-card="{{ $card->id }}" style="background-image:url('/storage/{{ $card->support }}.png')">
                            <!--begin::Body-->
                            <div class="card-body p-6 ribbon ribbon-end">
                                {!! \App\Helpers\Customer\CreditCard::getStatusCard($card->status, true) !!}
                                <!--begin::Title-->
                                <span class="position-absolute top-75 start-25 text-white fw-bold fs-5">{{ \App\Helpers\Customer\CreditCard::getCreditCard($card->number) }}</span>
                                <span class="position-absolute top-75 start-75 text-white fw-bold fs-6">{{ $card->exp_month }}/{{ Str::substr($card->exp_year, 2,4) }}</span>
                                <span class="position-absolute top-50 start-25 text-white fw-bolder fs-3">{{ \App\Helpers\Customer\Customer::getName(request()->user()->customer) }}</span>
                                <span class="position-absolute top-25 start-75 text-white fw-bolder fs-7">{{ $card->support }}</span>
                                <!--end::Title-->
                            </div>
                            <!--end::Body-->
                        </div>
                        @endforeach
                    </div>

            @endforeach
        </div>
    </div>

    <div class="card shadow-lg">
        <div class="card-body">
            <a href="" class="d-flex rounded-2 flex-row justify-content-between align-content-center text-black bg-gray-200 p-5 mb-5 bg-hover-primary text-hover-white">
                <div class="d-flex flex-column">
                    <span class="fs-4">Carte Virtuel</span>
                    <span class="fs-8">Payer en ligne avec des numéro de carte virtuel</span>
                </div>
                <i class="fas fa-chevron-right fs-1 align-content-center"></i>
            </a>
            @if(request()->user()->customer->setting->cheque == 1)
            <a href="" class="d-flex rounded-2 flex-row justify-content-between align-content-center text-black bg-gray-200 p-5 mb-5 bg-hover-primary text-hover-white">
                <div class="d-flex flex-column">
                    <span class="fs-4">Chèque</span>
                    <span class="fs-8">Commande et suivi</span>
                </div>
                <i class="fas fa-chevron-right fs-1 align-content-center"></i>
            </a>
            @endif
            <a href="" class="d-flex rounded-2 flex-row justify-content-between text-black bg-gray-200 p-5 mb-5 bg-hover-primary text-hover-white">
                <div class="d-flex flex-column">
                    <span class="fs-4">Prélèvement</span>
                    <span class="fs-8">Suivi des prélèvement reçu</span>
                </div>
                <i class="fas fa-chevron-right fs-1 align-content-center"></i>
            </a>
        </div>
    </div>
    <div class="modal bg-white fade" tabindex="-1" id="add-credit-card">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content shadow-none">
                <div class="modal-header">
                    <h5 class="modal-title">Nouvelle carte bancaire</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times fa-2x"></i>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="{{ route('account.payment.addCart') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <h1 class="fw-bolder mb-5">Type de carte bancaire</h1>
                        <div class="d-flex flex-row justify-content-between mb-10">
                            <div>
                                <input type="radio" class="btn-check" name="support" value="ELECTRON" id="kt_radio_buttons_2_option_1"/>
                                <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex flex-column justify-contents-center mb-5 text-center" for="kt_radio_buttons_2_option_1">
                                    <img src="/storage/ELECTRON.png" alt="">
                                    <span class="d-block fw-bold text-start">
                                    <span class="text-dark fw-bolder d-block fs-3 text-center mt-2">VISA ELECTRON</span>
                                </span>
                                </label>
                            </div>
                            <div>
                                <input type="radio" class="btn-check" name="support" value="CLASSIC" id="kt_radio_buttons_2_option_2"/>
                                <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex flex-column justify-contents-center mb-5 text-center" for="kt_radio_buttons_2_option_2">
                                    <img src="/storage/CLASSIC.png" alt="">
                                    <span class="d-block fw-bold text-start">
                                    <span class="text-dark fw-bolder d-block fs-3 text-center mt-2">VISA CLASSIC</span>
                                </span>
                                </label>
                            </div>
                            <div>
                                <input type="radio" class="btn-check" name="support" value="PREMIUM" id="kt_radio_buttons_2_option_3"/>
                                <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex flex-column justify-contents-center mb-5 text-center" for="kt_radio_buttons_2_option_3">
                                    <img src="/storage/PREMIUM.png" alt="">
                                    <span class="d-block fw-bold text-start">
                                    <span class="text-dark fw-bolder d-block fs-3 text-center mt-2">VISA PREMIUM</span>
                                </span>
                                </label>
                            </div>
                            <div>
                                <input type="radio" class="btn-check" name="support" value="INFINITE" id="kt_radio_buttons_2_option_4"/>
                                <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex flex-column justify-contents-center mb-5 text-center" for="kt_radio_buttons_2_option_4">
                                    <img src="/storage/INFINITE.png" alt="">
                                    <span class="d-block fw-bold text-start">
                                    <span class="text-dark fw-bolder d-block fs-3 text-center mt-2">VISA INFINITE</span>
                                </span>
                                </label>
                            </div>
                        </div>

                        <div class="mb-10">
                            <label for="" class="form-label required">Type de débit</label>
                            <select class="form-control" name="debit">
                                <option value="IMMEDIATE">Débit immédiat (Authorisation Systématique)</option>
                                <option value="DIFFERED">Débit différé (Paiement M+1)</option>
                            </select>
                        </div>

                        <div class="mb-10">
                            <label for="" class="form-label required">Compte affilier</label>
                            <select class="form-control" name="customer_wallet_id">
                                <option value=""></option>
                                @foreach(request()->user()->customer->wallets()->where('status', 'ACTIVE')->where('type', 'account')->get() as $wallet)
                                    <option value="{{ $wallet->id }}">Compte N° {{ $wallet->number_account }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-bank">Demander ma nouvelle carte bancaire</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal bg-white fade" tabindex="-1" id="showCard">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content shadow-none">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3 col-sm-12 d-flex flex-column">
                            <div class="card h-250px w-auto bgi-no-repeat bgi-size-cover me-5 backCard">
                                <!--begin::Body-->
                                <div class="card-body p-6 ribbon ribbon-end">
                                {!! \App\Helpers\Customer\CreditCard::getStatusCard($card->status, true) !!}
                                <!--begin::Title-->
                                    <span class="position-absolute top-25 start-75 text-white fw-bolder fs-7">{{ $card->support }}</span>
                                    <!--end::Title-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <span class="fw-bolder text-center nameCard"></span>
                            <span class="text-center infoCard"></span>
                            <div class="separator border-2 my-10"></div>
                            <div class="menu d-flex flex-column align-items-center">

                            </div>
                        </div>
                        <div class="col-md-9 col-sm-12" id="cardInfoShow"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal bg-white fade" tabindex="-1" id="modalOpposition">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content shadow-none">
                <div class="modal-header">
                    <h5 class="modal-title">Faire Opposition</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body d-flex flex-center">
                    <div class="fs-3tx mb-20">Êtes-vous sûr de vouloir faire opposition ?</div>
                    <div class="alert alert-dismissible bg-light-primary d-flex flex-center flex-column py-10 px-10 px-lg-20 mb-10">

                        <!--begin::Icon-->
                        <i class="fas fa-info fa-5x text-info"></i>
                        <!--end::Icon-->

                        <!--begin::Wrapper-->
                        <div class="text-center">
                            <!--begin::Title-->
                            <h1 class="fw-bolder mb-5">Le saviez-vous ?</h1>
                            <!--end::Title-->

                            <!--begin::Separator-->
                            <div class="separator separator-dashed border-danger opacity-25 mb-5"></div>
                            <!--end::Separator-->

                            <!--begin::Content-->
                            <div class="mb-9 text-dark">
                                En cas de doute, vous pouvez verrouiller temporairement votre carte plutôt qu'en commander une nouvelle. Vous pourrez la déverrouiller à tout moment. Attention, verrouiller la carte ne conduit pas à faire opposition à la carte.
                            </div>
                            <!--end::Content-->

                            <!--begin::Buttons-->
                            <div class="d-flex flex-center flex-column">
                                <button class="btn btn-bank btn-lg mb-2">Faire opposition en ligne</button>
                                <button class="btn btn-outline btn-outline-bank btn-lg mb-2">Contacter un conseiller</button>
                                <button class="btn btn-outline btn-outline-bank btn-lg" onclick="lockedCard(this)">Verrouiller ma carte</button>
                            </div>
                            <!--end::Buttons-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Alert-->
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="modalLimitDraw">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Gérez mes plafonds</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body text-center">
                    <div class="fw-bolder fs-1">Paiements et retraits disponibles aujourd'hui</div>
                    <div class="fs-5">Sous réserve des opérations en cours.</div>
                    <div class="d-flex flex-column justify-content-between mt-5 mb-5">
                        <div class="d-flex flex-row justify-content-between fs-4 mb-2">
                            <div class="">Paiement Disponible: <span id="paymentLimit" class="fw-bolder"></span></div>
                            <i class="fas fa-info-circle text-bank-payment" data-bs-toogle="tooltip" data-bs-custom-class="tooltip-dark" title=""></i>
                        </div>
                        <div class="progress h-25px">
                            <div class="progress-bar progressPayment text-black" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                        </div>
                    </div>
                    <div class="d-flex flex-column justify-content-between mt-5 mb-5">
                        <div class="d-flex flex-row justify-content-between fs-4 mb-2">
                            <div class="">Retrait Disponible: <span id="withdrawLimit" class="fw-bolder"></span></div>
                            <i class="fas fa-info-circle text-bank-withdraw" data-bs-toogle="tooltip" data-bs-custom-class="tooltip-dark" title=""></i>
                        </div>
                        <div class="progress h-25px">
                            <div class="progress-bar progressWithdraw" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    @include("scripts.account.payment.index")
@endsection

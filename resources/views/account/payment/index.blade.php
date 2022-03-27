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
                @foreach($wallet->cards as $card)
                    <div class="d-flex flex-row flex-center">
                        <div class="cursor-pointer card h-200px w-350px bgi-no-repeat bgi-size-cover" style="background-image:url('/storage/{{ $card->support }}.png')">
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
                    </div>
                @endforeach
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
            <a href="" class="d-flex rounded-2 flex-row justify-content-between align-content-center text-black bg-gray-200 p-5 mb-5 bg-hover-primary text-hover-white">
                <div class="d-flex flex-column">
                    <span class="fs-4">Chèque</span>
                    <span class="fs-8">Commande et suivi</span>
                </div>
                <i class="fas fa-chevron-right fs-1 align-content-center"></i>
            </a>
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
@endsection

@section("script")
@endsection

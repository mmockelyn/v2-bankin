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
            @if(request()->user()->customer->cards()->where('type', 'PHYSICAL')->get()->count() <= request()->user()->customer->setting->nb_carte_physique)
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
                        @foreach($wallet->cards()->where('type', 'PHYSICAL')->get() as $card)
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
            <a href="{{ route('account.payments.virtual.index') }}" class="d-flex rounded-2 flex-row justify-content-between align-content-center text-black bg-gray-200 p-5 mb-5 bg-hover-primary text-hover-white">
                <div class="d-flex flex-column">
                    <span class="fs-4">Carte Virtuel</span>
                    <span class="fs-8">Payer en ligne avec des numéro de carte virtuel</span>
                </div>
                <i class="fas fa-chevron-right fs-1 align-content-center"></i>
            </a>
            @if(request()->user()->customer->setting->cheque == 1)
            <a data-bs-toggle="modal" href="#modalShowCheck" class="d-flex rounded-2 flex-row justify-content-between align-content-center text-black bg-gray-200 p-5 mb-5 bg-hover-primary text-hover-white">
                <div class="d-flex flex-column">
                    <span class="fs-4">Chèque</span>
                    <span class="fs-8">Commande et suivi</span>
                </div>
                <i class="fas fa-chevron-right fs-1 align-content-center"></i>
            </a>
            @endif
            <a href="#modalShowLevies" data-bs-toggle="modal" class="d-flex rounded-2 flex-row justify-content-between text-black bg-gray-200 p-5 mb-5 bg-hover-primary text-hover-white">
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
                    @if(ismobile() == true)
                    <button class="btn btn-bank" data-bs-toggle="modal" data-bs-target="#editPlafond">Augmenter temporairement</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="modalShowCode">
        <div class="modal-dialog">
            <div class="modal-content" data-card-number="">
                <div class="modal-header">
                    <h5 class="modal-title">Voir mon code secret</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </div>
                    <!--end::Close-->
                </div>

                <form id="formAuthVerify" action="{{ route('auth.code.verify') }}" method="post">
                    @csrf
                    <input type="hidden" name="user" value="{{ request()->user()->id }}">
                    <div class="modal-body">
                        <x-form.input
                            name="auth_code"
                            type="password"
                            maxlength="4"
                            label="Code SECURPASS"
                            required="true" />
                        <div id="errorCode" class="text-danger"></div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-bank btnAuthVerify">
                            <span class="indicator-label">
                                Authentifier
                            </span>
                            <span class="indicator-progress">
                                Veuillez Patienter... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal bg-white fade" tabindex="-1" id="modalShowCheck">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content shadow-none">
                <div class="modal-header">
                    <h5 class="modal-title">Chèque</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <div class="d-flex flex-row justify-content-between align-items-center mb-5">
                        <h3 class="">Liste des chèquiers</h3>
                        <button data-bs-toggle="modal" data-bs-target="#modalAddCheck" class="btn btn-bank">Nouveau chéquier</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-rounded table-striped border gy-7 gs-7">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                                    <th>Numéro de chéquier</th>
                                    <th>Etat</th>
                                </tr>
                            </thead>
                            <tbody id="tableListCheck">
                                @foreach(request()->user()->customer->checks as $check)
                                <tr>
                                    <td>Chéquier N°{{ $check->reference }}</td>
                                    <td>{!! $check->getStatus($check->status) !!}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="modalAddCheck">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-bank">
                    <h5 class="modal-title text-white">Commande d'un nouveau chéquier</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </div>
                    <!--end::Close-->
                </div>

                <form id="formAddCheck" action="" method="post">
                    <div class="modal-body">
                        <div class="mb-10">
                            <label for="" class="form-label required">Compte</label>
                            <select class="form-control form-select-solid" data-dropdown-parent="#modalAddCheck" data-control="select2" name="uuid" data-placeholder="Selectionner un compte affilier au chéquier">
                                <option value=""></option>
                                @foreach(request()->user()->customer->wallets()->where('type', 'account')->get() as $wallet)
                                    <option value="{{ $wallet->uuid }}">{{ \App\Helpers\Customer\Wallet::formatNameAccountForSelect($wallet) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <x-form.button text="Commander un chéquier" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal bg-white fade" tabindex="-1" id="modalShowLevies">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content shadow-none">
                <div class="modal-header">
                    <h5 class="modal-title">Prélèvements reçus</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <div class="d-flex flex-row justify-content-between align-items-center mb-5">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
									<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
								</svg>
							</span>
                            <!--end::Svg Icon-->
                            <input type="text" data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Rechercher un prélèvement..." />
                        </div>
                        <!--end::Search-->
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                            <!--begin::Filter-->
                            <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                                <span class="svg-icon svg-icon-2">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="black" />
									</svg>
								</span>
                                <!--end::Svg Icon-->Filtrer</button>
                            <!--begin::Menu 1-->
                            <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true" id="kt-toolbar-filter">
                                <!--begin::Header-->
                                <div class="px-7 py-5">
                                    <div class="fs-4 text-dark fw-bolder">Options</div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Separator-->
                                <div class="separator border-gray-200"></div>
                                <!--end::Separator-->
                                <!--begin::Content-->
                                <div class="px-7 py-5">
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <!--begin::Label-->
                                        <label class="form-label fs-5 fw-bold mb-3">Compte bancaire:</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-customer-table-filter="account" data-dropdown-parent="#kt-toolbar-filter">
                                            <option></option>
                                            @foreach(request()->user()->customer->wallets as $wallet)
                                                <option value="{{ \App\Helpers\Customer\Wallet::formatNameAccountForSelect($wallet) }}">{{ \App\Helpers\Customer\Wallet::formatNameAccountForSelect($wallet) }}</option>
                                            @endforeach
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <!--begin::Label-->
                                        <label class="form-label fs-5 fw-bold mb-3">Créancier:</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-customer-table-filter="creditor" data-dropdown-parent="#kt-toolbar-filter">
                                            <option></option>
                                            @foreach(request()->user()->customer->levies as $creditor)
                                                <option value="{{ $creditor->creditor }}">{{ $creditor->creditor }}</option>
                                            @endforeach
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <div class="mb-10">
                                        <!--begin::Label-->
                                        <label class="form-label fs-5 fw-bold mb-3">Status:</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-customer-table-filter="status" data-dropdown-parent="#kt-toolbar-filter">
                                            <option></option>
                                            <option value="En attente">En attente</option>
                                            <option value="Traité">Traité</option>
                                            <option value="Rejeté interbancaire">Rejeté interbancaire</option>
                                            <option value="Retourné">Retourné</option>
                                            <option value="Remboursé">Remboursé</option>
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="d-flex justify-content-end">
                                        <button type="reset" class="btn btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true" data-kt-customer-table-filter="reset">Reset</button>
                                        <button type="submit" class="btn btn-primary" data-kt-menu-dismiss="true" data-kt-customer-table-filter="filter">Apply</button>
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Menu 1-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Group actions-->
                        <div class="d-flex justify-content-end align-items-center d-none" data-kt-customer-table-toolbar="selected">
                            <div class="fw-bolder me-5">
                                <span class="me-2" data-kt-customer-table-select="selected_count"></span>Selectionner</div>
                            <button type="button" class="btn btn-bank" data-kt-customer-table-select="opposite_selected">Créer une opposition</button>
                        </div>
                        <!--end::Group actions-->
                    </div>
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                        <!--begin::Table head-->
                        <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="w-10px pe-2">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_customers_table .form-check-input" value="1" />
                                </div>
                            </th>
                            <th class="min-w-125px">Comptes</th>
                            <th class="min-w-125px">Date Echéance</th>
                            <th class="min-w-125px">Créancier</th>
                            <th class="min-w-125px">Mandat</th>
                            <th class="min-w-125px">Montant</th>
                            <th class="min-w-125px">Status</th>
                            <th class="text-end w-50px"></th>
                        </tr>
                        <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="fw-bold text-gray-600">
                        @foreach(request()->user()->customer->levies as $levy)
                        <tr>
                            <!--begin::Checkbox-->
                            <td>
                                @if($levy->status == 'waiting')
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" name="id" value="{{ $levy->uuid }}" />
                                </div>
                                @endif
                            </td>
                            <!--end::Checkbox-->
                            <!--begin::Name=-->
                            <td>
                                <span>{{ \App\Helpers\Customer\Wallet::formatNameAccountForSelect($levy->wallet) }}</span>
                            </td>
                            <!--end::Name=-->
                            <!--begin::Email=-->
                            <td>
                                {{ $levy->created_at->format('d/m/Y') }}
                            </td>
                            <td>{{ $levy->creditor }}</td>
                            <td>{{ $levy->mandat }}</td>
                            <td>{{ eur($levy->amount) }}</td>
                            <td>{!! \App\Helpers\Customer\Levy::getStatus($levy->status, true) !!}</td>
                            <td>
                                @if($levy->status == 'waiting')
                                <a href="" class="btn btn-bank btn-icon" data-row="{{ $levy->uuid }}" data-bs-toggle="tooltip" title="Créer une oposition" data-kt-customer-table-filter="create_opposite"><i class="fas fa-times-circle text-white fa-lg"></i> </a>
                                @endif
                            </td>
                            <!--end::Email=-->
                        </tr>
                        @endforeach
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    @include("scripts.account.payment.index")
@endsection

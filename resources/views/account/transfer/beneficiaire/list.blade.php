@extends("account.layouts.layout")

@section("css")

@endsection

@section('toolbar')
    <!--begin::Toolbar-->
    <div class="toolbar py-5 py-lg-15" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-xxl d-flex flex-center justify-content-between">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-row me-3">
                <!--begin::Title-->
                <h1 class="d-flex flex-column text-white fw-bolder my-1 fs-1">
                    <span>Mes Bénéficiaires</span>
                </h1>
                <!--end::Title-->

            </div>

            <div class="d-flex">
                <button class="btn btn-bank" data-bs-toggle="modal" data-bs-target="#add">Ajouter un bénéficiaire</button>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
@endsection

@section("content")
    <div class="card shadow-lg">
        <div class="card-body">
            @foreach($beneficiaires as $beneficiaire)
            <a class="card bg-gray-200 bg-hover-lighten h-100px mb-5 showModal" data-bene="{{ $beneficiaire->uuid }}">
                <!--begin::Body-->
                <div class="card-body d-flex justify-content-between align-items-center mb-7 text-black">
                    <div class="d-flex flex-column">
                        <div class="fs-8 text-muted"><i class="fas fa-circle me-3" style="color: #{{ $beneficiaire->bank->bank->primary_color }}"></i> {{ $beneficiaire->bank->bankname }}</div>
                        <div class="fw-bolder fs-2">
                            @if($beneficiaire->type == 'corporate')
                                {{ $beneficiaire->company }}
                            @else
                                {{ $beneficiaire->civility }}. {{ $beneficiaire->firstname }} {{ $beneficiaire->lastname }}
                            @endif
                        </div>
                    </div>
                    <div class="d-flex text-center">
                        {{ $beneficiaire->bank->iban }}
                    </div>
                    <div class="text-end">
                        <i class="fas fa-chevron-right fa-2x"></i>
                    </div>
                </div>
                <!--end::Body-->
            </a>
            @endforeach
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="show">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Information sur un bénéficiaire</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <h2 class="fw-bold mb-2">Banque</h2>
                    <div class="d-flex align-items-sm-center mb-7">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-50px me-5">
							<span class="symbol-label">
								<img id="logo_bank" src="/metronic8/demo1/assets/media/svg/brand-logos/plurk.svg" class="h-50 align-self-center" alt="">
							</span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Section-->
                        <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                            <div class="flex-grow-1 me-2">
                                <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bolder" id="nameBank"></a>
                                <span class="text-muted fw-bold d-block fs-7" id="bicBank"></span>
                            </div>
                        </div>
                        <!--end::Section-->
                    </div>

                    <div class="d-flex flex-column mb-10">
                        <div class="text-muted fs-6">IBAN</div>
                        <div class="fw-bolder fs-3" id="iban"></div>
                    </div>

                    <div class="d-flex flex-column mb-10">
                        <div class="text-muted fs-6">Nom du bénéficiaire</div>
                        <div class="fw-bolder fs-3" id="nameBene"></div>
                    </div>

                    <div class="d-flex flex-column mb-10">
                        <div class="text-muted fs-6">Je suis titulaire de ce compte</div>
                        <div class="fw-bolder fs-3" id="titulaire"></div>
                    </div>
                </div>

                <div class="modal-footer d-flex flex-column">
                    <button class="btn btn-bank">Modifier</button>
                    <button class="btn btn-outline btn-outline-danger" data-bene="">Supprimer</button>
                    <button class="btn btn-outline btn-outline-primary">Faire un virement</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="add">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nouveau Bénéficiaire</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="{{ route('account.transfer.beneficiaire.store') }}" method="post">
                    @csrf
                    <div class="modal-body">

                        <div class="d-flex flex-row justify-content-center">
                            <input type="radio" class="btn-check" name="type" value="retail" id="kt_radio_buttons_2_option_1" onclick="checkTypeAccount(this)"/>
                            <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center mb-5 me-5" for="kt_radio_buttons_2_option_1">
                                <!--begin::Svg Icon | path: icons/duotune/coding/cod001.svg-->
                                <span class="svg-icon svg-icon-4x me-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="black" />
														<path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="black" />
													</svg>
                                                </span>
                                <!--end::Svg Icon-->

                                <span class="d-block fw-bold text-start">
                                                    <span class="text-dark fw-bolder d-block fs-3">Compte Particulier</span>
                                                </span>
                            </label>
                            <!--end::Option-->
                            <input type="radio" class="btn-check" name="type" value="corporate" id="kt_radio_buttons_2_option_2" onclick="checkTypeAccount(this)"/>
                            <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center mb-5" for="kt_radio_buttons_2_option_2">
                                <!--begin::Svg Icon | path: icons/duotune/coding/cod001.svg-->
                                <span class="svg-icon svg-icon-4x me-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<path opacity="0.3" d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z" fill="black" />
														<path d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z" fill="black" />
													</svg>
                                                </span>
                                <!--end::Svg Icon-->

                                <span class="d-block fw-bold text-start">
                                                    <span class="text-dark fw-bolder d-block fs-3">Compte Professionnel</span>
                                                </span>
                            </label>
                            <!--end::Option-->
                        </div>

                        <div id="corporate" class="d-none">
                            <x-form.input
                                name="company"
                                type="text"
                                label="Nom de l'entreprise" />
                        </div>
                        <div id="retail" class="d-none">
                            <div class="mb-10 d-flex flex-row">
                                <div class="form-check form-check-custom form-check-solid me-10">
                                    <input class="form-check-input h-30px w-30px" type="checkbox" name="civility" value="M" id="flexCheckbox30"/>
                                    <label class="form-check-label" for="flexCheckbox30">
                                        Monsieur
                                    </label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid me-10">
                                    <input class="form-check-input h-30px w-30px" type="checkbox" name="civility" value="MME" id="flexCheckbox30"/>
                                    <label class="form-check-label" for="flexCheckbox30">
                                        Madame
                                    </label>
                                </div>
                            </div>
                            <x-form.input
                                name="firstname"
                                type="text"
                                label="Nom" />
                            <x-form.input
                                name="lastname"
                                type="text"
                                label="Prénom" />

                            <div class="separator mb-5"></div>
                        </div>

                        <x-form.input
                            name="iban"
                            type="text"
                            label="IBAN" />

                        <x-form.input
                            name="bic"
                            type="text"
                            label="BIC/SWIFT" onblur="changeBankInfo()"/>

                        <div id="bank_info" class="d-none">
                            <div class="d-flex align-items-sm-center mb-7">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-50px me-5">
							<span class="symbol-label">
								<img id="logo_bank" src="/metronic8/demo1/assets/media/svg/brand-logos/plurk.svg" class="h-50 align-self-center" alt="">
							</span>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Section-->
                                <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                    <div class="flex-grow-1 me-2">
                                        <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bolder" id="nameBank"></a>
                                        <span class="text-muted fw-bold d-block fs-7" id="bicBank"></span>
                                    </div>
                                </div>
                                <!--end::Section-->
                            </div>
                        </div>

                        <div class="form-check form-check-custom form-check-solid me-10 mb-5">
                            <input class="form-check-input h-30px w-30px" type="checkbox" name="titulaire" id="flexCheckbox30"/>
                            <label class="form-check-label" for="flexCheckbox30">
                                Je suis titulaire de ce compte
                            </label>
                        </div>
                    </div>

                    <div class="modal-footer text-center">
                        <button type="submit" class="btn btn-bank w-100%">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("script")
@include("scripts.account.beneficiaire.list")
@include("scripts.account.beneficiaire.create")
@endsection

<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic - Bootstrap 5 HTML, VueJS, React, Angular & Laravel Admin Dashboard Theme
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->
<head><base href="../../">
    <title>Création de compte - {{ config('app.name') }}</title>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="favicon.ico" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="bg-body">
<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Aside-->
        <div class="d-flex flex-column flex-lg-row-auto w-xl-500px positon-xl-relative" style="background-color: #F2C98A">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-500px scroll-y">
                <!--begin::Content-->
                <div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
                    <!--begin::Logo-->
                    <a href="{{ route('home') }}" class="py-9 mb-5">
                        <img alt="Logo" src="/storage/logo_long.png" class="h-60px" />
                    </a>
                    <!--end::Logo-->
                    <!--begin::Title-->
                    <h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #986923;">FINBANK</h1>
                    <!--end::Title-->
                    <!--begin::Description-->
                    <p class="fw-bold fs-2" style="color: #986923;">Services Financiers Numériques</p>
                    <!--end::Description-->
                    <div class="alert alert-primary d-flex align-items-center p-5 mb-10">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                        <span class="svg-icon svg-icon-2hx svg-icon-primary me-4">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="black"></path>
								<path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="black"></path>
							</svg>
						</span>
                        <!--end::Svg Icon-->
                        <div class="d-flex flex-column text-start">
                            <h4 class="mb-1 text-primary">Information Sécurité</h4>
                            <p>
                                Soyez vigilant si vous êtes contacté par téléphone / e-mail / sms / chat.<br>
                                Ne communiquez jamais vos codes confidentiels, codes sécurité reçus par sms ou mots de passe, même pour annuler un paiement.
                            </p>
                        </div>
                    </div>
                </div>
                <!--end::Content-->
                <!--begin::Illustration-->
                <div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px" style="background-image: url(assets/media/illustrations/sketchy-1/13.png"></div>
                <!--end::Illustration-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Aside-->
        <!--begin::Body-->
        <div class="d-flex flex-column flex-lg-row-fluid py-10">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid">
                <!--begin::Wrapper-->
                <div class="w-lg-900px p-10 p-lg-15 mx-auto">
                    <!--begin::Form-->
                    <form class="form w-300" id="kt_sign_in_form" action="{{ route('register') }}" method="post" novalidate>
                    @csrf
                    <!--begin::Heading-->
                        <div class="text-center mb-10">
                            <!--begin::Title-->
                            <h1 class="text-dark mb-3">Créez votre compte</h1>
                            <!--end::Title-->
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                                <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="black"></path>
										<path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="black"></path>
									</svg>
								</span>
                                <!--end::Svg Icon-->
                                <div class="d-flex flex-column">
                                    <h4 class="mb-1 text-danger">Erreur de validation</h4>
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        <!--begin::Heading-->
                        <!--begin::Accordion-->
                        <div class="accordion mb-10" id="kt_accordion_1">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="kt_accordion_1_header_1">
                                    <button class="accordion-button fs-4 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_1" aria-expanded="true" aria-controls="kt_accordion_1_body_1">
                                        Type de compte
                                    </button>
                                </h2>
                                <div id="kt_accordion_1_body_1" class="accordion-collapse collapse show" aria-labelledby="kt_accordion_1_header_1" data-bs-parent="#kt_accordion_1">
                                    <div class="accordion-body">
                                        <div class="d-flex flex-row justify-content-center">
                                            <input type="radio" class="btn-check" name="type_account" value="INDIVIDUAL" id="kt_radio_buttons_2_option_1" onclick="checkTypeAccount(this)"/>
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
                                            <input type="radio" class="btn-check" name="type_account" value="BUSINESS" id="kt_radio_buttons_2_option_2" onclick="checkTypeAccount(this)"/>
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
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="kt_accordion_1_header_2">
                                    <button class="accordion-button fs-4 fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_2" aria-expanded="false" aria-controls="kt_accordion_1_body_2">
                                        Votre Identité
                                    </button>
                                </h2>
                                <div id="kt_accordion_1_body_2" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_2" data-bs-parent="#kt_accordion_1">
                                    <div class="accordion-body">
                                        <div class="d-none" id="individual">
                                            <h1 class="fw-bold">1. Identité</h1>
                                            <!--begin::Radio group-->
                                            <div class="btn-group w-100 w-lg-50 mb-10" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                                                <!--begin::Radio-->
                                                <label class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success" data-kt-button="true">
                                                    <!--begin::Input-->
                                                    <input class="btn-check" type="radio" name="civility" value="M"/>
                                                    <!--end::Input-->
                                                    Monsieur
                                                </label>
                                                <!--end::Radio-->

                                                <!--begin::Radio-->
                                                <label class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success active" data-kt-button="true">
                                                    <!--begin::Input-->
                                                    <input class="btn-check" type="radio" name="civility" checked="checked" value="MME"/>
                                                    <!--end::Input-->
                                                    Madame
                                                </label>
                                                <!--end::Radio-->
                                            </div>
                                            <!--end::Radio group-->
                                            <div class="d-flex flex-row justify-content-center">
                                                <div class="me-5">
                                                    <x-form.input
                                                        name="firstname"
                                                        type="text"
                                                        label="Votre Nom" class="me-5" required="true"/>
                                                </div>

                                                <div class="me-5">
                                                    <x-form.input
                                                        name="lastname"
                                                        type="text"
                                                        label="Votre Prénom" required="true"/>
                                                </div>

                                                <x-form.input
                                                    name="middlename"
                                                    type="text"
                                                    label="Votre nom marital" required="true" text="Si existant"/>

                                            </div>

                                            <x-form.input
                                                name="datebirth"
                                                type="text"
                                                label="Date de Naissance"
                                                required="true" />

                                            <div class="separator border-3 my-10"></div>

                                            <h1 class="fw-bold">2. Adresse Postal</h1>
                                            <x-form.input
                                                name="address_part"
                                                type="text"
                                                label="Adresse"
                                                required="true" />

                                            <x-form.input
                                                name="addressbis_part"
                                                type="text"
                                                label="Complément d'adresse" />

                                            <div class="row">
                                                <div class="col-md-4 col-sm-12">
                                                    <x-form.input
                                                        name="postal_part"
                                                        type="text"
                                                        label="Code Postal"
                                                        required="true" />
                                                </div>
                                                <div class="col-md-8 col-sm-12">
                                                    <x-form.input
                                                        name="city_part"
                                                        type="text"
                                                        label="Ville"
                                                        required="true" />
                                                </div>
                                            </div>
                                            <x-form.input
                                                name="phone_part"
                                                type="tel"
                                                label="Numéro de téléphone"
                                                text="format: +33999999999"
                                                help="true"
                                                helpText="Nécessaire pour authentifier les fonction forte (virement, payment, authorité, etc...)" />

                                            <x-form.input
                                                name="email_part"
                                                type="email"
                                                label="Adresse Mail" />

                                            <div class="mb-10">
                                                <label for="" class="form-label required">Pays de résidence</label>
                                                <select class="form-select" data-control="select2" data-placeholder="Pays de résidence" name="country_part">
                                                    <option value=""></option>
                                                    <option value="FR">France</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="d-none" id="business">
                                            <h1 class="fw-bold">1. Identité</h1>
                                            <x-form.input
                                                name="name"
                                                type="text"
                                                label="Nom de votre entreprise"
                                                required="true" />

                                            <x-form.input
                                                name="contactName"
                                                type="text"
                                                label="Nom/Prénom du contact" />

                                            <x-form.input
                                                name="type"
                                                type="text"
                                                label="Forme Juridique"
                                                required="true" />

                                            <x-form.input
                                                name="siret"
                                                type="text"
                                                label="Siret"
                                                required="true" />

                                            <h1 class="fw-bold">2. Adresse Postal</h1>
                                            <x-form.input
                                                name="address_pro"
                                                type="text"
                                                label="Adresse"
                                                required="true" />

                                            <x-form.input
                                                name="addressbis_pro"
                                                type="text"
                                                label="Complément d'adresse" />

                                            <div class="row">
                                                <div class="col-md-4 col-sm-12">
                                                    <x-form.input
                                                        name="postal_pro"
                                                        type="text"
                                                        label="Code Postal"
                                                        required="true" />
                                                </div>
                                                <div class="col-md-8 col-sm-12">
                                                    <x-form.input
                                                        name="city_pro"
                                                        type="text"
                                                        label="Ville"
                                                        required="true" />
                                                </div>
                                            </div>
                                            <x-form.input
                                                name="phone_pro"
                                                type="tel"
                                                label="Numéro de téléphone"
                                                text="format: +33999999999"
                                                help="true"
                                                helpText="Nécessaire pour authentifier les fonction forte (virement, payment, authorité, etc...)" />

                                            <x-form.input
                                                name="email_pro"
                                                type="email"
                                                label="Adresse Mail" />
                                            <div class="mb-10">
                                                <label for="" class="form-label required">Pays de résidence</label>
                                                <select class="form-select" data-control="select2" data-placeholder="Pays de résidence" name="country_pro">
                                                    <option value=""></option>
                                                    <option value="FR">France</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="kt_accordion_1_header_3">
                                    <button class="accordion-button fs-4 fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_3" aria-expanded="false" aria-controls="kt_accordion_1_body_3">
                                        Choix de votre compte
                                    </button>
                                </h2>
                                <div id="kt_accordion_1_body_3" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_3" data-bs-parent="#kt_accordion_1">
                                    <div class="accordion-body">
                                        <div class="row mt-10">
                                            <!--begin::Col-->
                                            <div class="col-lg-6 mb-10 mb-lg-0">
                                                <!--begin::Tabs-->
                                                <div class="nav flex-column">
                                                    @foreach(\App\Models\Core\Package::all() as $package)
                                                    <!--begin::Tab link-->
                                                    <div class="nav-link btn btn-outline btn-outline-dashed btn-color-dark @if($package->id == 1) btn-active @endif btn-active-primary d-flex flex-stack text-start p-6 @if($package->id == 1) active @endif mb-6" data-bs-toggle="tab" data-bs-target="#kt_upgrade_plan_{{ Str::slug($package->name) }}">
                                                        <!--end::Description-->
                                                        <div class="d-flex align-items-center me-2">
                                                            <!--begin::Radio-->
                                                            <div class="form-check form-check-custom form-check-solid form-check-success me-6">
                                                                <input class="form-check-input" type="radio" name="package_id" @if($package->id == 1) checked="checked" @endif value="{{ $package->id }}">
                                                            </div>
                                                            <!--end::Radio-->
                                                            <!--begin::Info-->
                                                            <div class="flex-grow-1">
                                                                <h2 class="d-flex align-items-center fs-2 fw-bolder flex-wrap">
                                                                    {{ $package->name }}</h2>
                                                            </div>
                                                            <!--end::Info-->
                                                        </div>
                                                        <!--end::Description-->
                                                        <!--begin::Price-->
                                                        <div class="ms-5">
                                                            <span class="mb-2">€</span>
                                                            <span class="fs-3x fw-bolder" data-kt-plan-price-month="{{ $package->price }}" data-kt-plan-price-annual="399">{{ eur($package->price) }}</span>
                                                            <span class="fs-7 opacity-50">/
												<span data-kt-element="period">par mois</span></span>
                                                        </div>
                                                        <!--end::Price-->
                                                    </div>
                                                    <!--end::Tab link-->
                                                    @endforeach
                                                    <!--end::Tab link-->
                                                </div>
                                                <!--end::Tabs-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <!--begin::Tab content-->
                                                <div class="tab-content rounded h-100 bg-light p-10">
                                                    <!--begin::Tab Pane-->
                                                    @foreach(\App\Models\Core\Package::all() as $package)
                                                    <div class="tab-pane fade @if($package->id == 1) show active @endif" id="kt_upgrade_plan_{{ Str::slug($package->name) }}">
                                                        <!--begin::Heading-->
                                                        <div class="pb-5">
                                                            <h2 class="fw-bolder text-dark">Contenue du plan {{ $package->name }}?</h2>
                                                        </div>
                                                        <!--end::Heading-->
                                                        <!--begin::Body-->
                                                        <div class="pt-1">
                                                            <!--begin::Item-->
                                                            <div class="d-flex align-items-center mb-7">
                                                                <span class="fw-bold fs-5 @if($package->visa_classic == 1) text-gray-700 @else text-muted @endif flex-grow-1">Une carte Visa Classic Incluse</span>
                                                                <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                                <span class="svg-icon svg-icon-1 @if($package->visa_classic == 1) svg-icon-success @endif">
                                                                    @if($package->visa_classic == 1)
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"></rect>
                                                                        <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black"></path>
                                                                    </svg>
                                                                    @else
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"></rect>
                                                                            <rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="black"></rect>
                                                                            <rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="black"></rect>
                                                                        </svg>
                                                                    @endif
                                                                </span>
                                                                <!--end::Svg Icon-->
                                                            </div>
                                                            <!--end::Item-->
                                                            <!--begin::Item-->
                                                            <div class="d-flex align-items-center mb-7">
                                                                <span class="fw-bold fs-5 @if($package->check_deposit == 1) text-gray-700 @else text-muted @endif flex-grow-1">Dépôts de chèques (par la poste ou via notre application)</span>
                                                                <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                                <span class="svg-icon svg-icon-1 @if($package->check_deposit == 1) svg-icon-success @endif">
                                                                    @if($package->check_deposit == 1)
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"></rect>
                                                                        <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black"></path>
                                                                    </svg>
                                                                    @else
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"></rect>
                                                                            <rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="black"></rect>
                                                                            <rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="black"></rect>
                                                                        </svg>
                                                                    @endif
                                                                </span>
                                                                <!--end::Svg Icon-->
                                                            </div>
                                                            <div class="d-flex align-items-center mb-7">
                                                                <span class="fw-bold fs-5 @if($package->payment_withdraw == 1) text-gray-700 @else text-muted @endif flex-grow-1">Retraits et paiements illimités en zone euro</span>
                                                                <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                                <span class="svg-icon svg-icon-1 @if($package->payment_withdraw == 1) svg-icon-success @endif">
                                                                    @if($package->payment_withdraw == 1)
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"></rect>
                                                                        <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black"></path>
                                                                    </svg>
                                                                    @else
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"></rect>
                                                                            <rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="black"></rect>
                                                                            <rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="black"></rect>
                                                                        </svg>
                                                                    @endif
                                                                </span>
                                                                <!--end::Svg Icon-->
                                                            </div>
                                                            <div class="d-flex align-items-center mb-7">
                                                                <span class="fw-bold fs-5 @if($package->overdraft == 1) text-gray-700 @else text-muted @endif flex-grow-1">Mise en place du découvert autorisé</span>
                                                                <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                                <span class="svg-icon svg-icon-1 @if($package->overdraft == 1) svg-icon-success @endif">
                                                                    @if($package->overdraft == 1)
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"></rect>
                                                                        <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black"></path>
                                                                    </svg>
                                                                    @else
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"></rect>
                                                                            <rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="black"></rect>
                                                                            <rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="black"></rect>
                                                                        </svg>
                                                                    @endif
                                                                </span>
                                                                <!--end::Svg Icon-->
                                                            </div>
                                                            <div class="d-flex align-items-center mb-7">
                                                                <span class="fw-bold fs-5 @if($package->cash_deposit == 1) text-gray-700 @else text-muted @endif flex-grow-1">Déposer de l'argent</span>
                                                                <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                                <span class="svg-icon svg-icon-1 @if($package->cash_deposit == 1) svg-icon-success @endif">
                                                                    @if($package->cash_deposit == 1)
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"></rect>
                                                                        <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black"></path>
                                                                    </svg>
                                                                    @else
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"></rect>
                                                                            <rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="black"></rect>
                                                                            <rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="black"></rect>
                                                                        </svg>
                                                                    @endif
                                                                </span>
                                                                <!--end::Svg Icon-->
                                                            </div>
                                                            <div class="d-flex align-items-center mb-7">
                                                                <span class="fw-bold fs-5 @if($package->withdraw_international == 1) text-gray-700 @else text-muted @endif flex-grow-1">Retrait d'argent vers l'internationnal</span>
                                                                <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                                <span class="svg-icon svg-icon-1 @if($package->withdraw_international == 1) svg-icon-success @endif">
                                                                    @if($package->withdraw_international == 1)
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"></rect>
                                                                        <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black"></path>
                                                                    </svg>
                                                                    @else
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"></rect>
                                                                            <rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="black"></rect>
                                                                            <rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="black"></rect>
                                                                        </svg>
                                                                    @endif
                                                                </span>
                                                                <!--end::Svg Icon-->
                                                            </div>
                                                            <div class="d-flex align-items-center mb-7">
                                                                <span class="fw-bold fs-5 @if($package->payment_international == 1) text-gray-700 @else text-muted @endif flex-grow-1">Payment vers l'internationnal</span>
                                                                <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                                <span class="svg-icon svg-icon-1 @if($package->payment_international == 1) svg-icon-success @endif">
                                                                    @if($package->payment_international == 1)
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"></rect>
                                                                        <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black"></path>
                                                                    </svg>
                                                                    @else
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"></rect>
                                                                            <rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="black"></rect>
                                                                            <rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="black"></rect>
                                                                        </svg>
                                                                    @endif
                                                                </span>
                                                                <!--end::Svg Icon-->
                                                            </div>
                                                            <div class="d-flex align-items-center mb-7">
                                                                <span class="fw-bold fs-5 @if($package->payment_insurance == 1) text-gray-700 @else text-muted @endif flex-grow-1">Assurance incluse (moyens de paiement, téléphone…)</span>
                                                                <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                                <span class="svg-icon svg-icon-1 @if($package->payment_insurance == 1) svg-icon-success @endif">
                                                                    @if($package->payment_insurance == 1)
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"></rect>
                                                                        <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black"></path>
                                                                    </svg>
                                                                    @else
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"></rect>
                                                                            <rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="black"></rect>
                                                                            <rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="black"></rect>
                                                                        </svg>
                                                                    @endif
                                                                </span>
                                                                <!--end::Svg Icon-->
                                                            </div>
                                                            <div class="d-flex align-items-center mb-7">
                                                                <span class="fw-bold fs-5 @if($package->check == 1) text-gray-700 @else text-muted @endif flex-grow-1">Chequier</span>
                                                                <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                                <span class="svg-icon svg-icon-1 @if($package->check == 1) svg-icon-success @endif">
                                                                    @if($package->check == 1)
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"></rect>
                                                                        <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black"></path>
                                                                    </svg>
                                                                    @else
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"></rect>
                                                                            <rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="black"></rect>
                                                                            <rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="black"></rect>
                                                                        </svg>
                                                                    @endif
                                                                </span>
                                                                <!--end::Svg Icon-->
                                                            </div>
                                                            <!--end::Item-->
                                                        </div>
                                                        <!--end::Body-->
                                                    </div>
                                                    <!--end::Tab Pane-->
                                                    @endforeach
                                                </div>
                                                <!--end::Tab content-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Accordion-->
                        <!--begin::Actions-->
                        <div class="text-center">
                            <!--begin::Submit button-->
                            <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                                <span class="indicator-label">Valider</span>
                                <span class="indicator-progress"><span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Submit button-->
                            <!--end::Google link-->
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->
            <!--begin::Footer-->
            <div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
                <!--begin::Links-->
                <div class="d-flex flex-center fw-bold fs-6">
                    <a href="https://keenthemes.com" class="text-muted text-hover-primary px-2" target="_blank"><i class="fas fa-question me-2"></i> Assistance</a>
                </div>
                <!--end::Links-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>
<!--end::Root-->
<!--end::Main-->
<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="/assets/plugins/global/plugins.bundle.js"></script>
<script src="/assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script>
@include("scripts.auth.register")
<!--end::Page Custom Javascript-->
<!--end::Javascript-->
</body>
<!--end::Body-->
</html>

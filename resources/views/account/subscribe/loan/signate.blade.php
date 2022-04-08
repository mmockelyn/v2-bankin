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
                <h1 class="d-flex text-white fw-bolder my-1 fs-1">Signature de votre contrat de pret N°{{ $loan->reference }}</h1>
                <!--end::Title-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
@endsection

@section("content")
    <div class="alert alert-dismissible bg-light-primary d-flex flex-center flex-column py-10 px-10 px-lg-20 mb-10">
        <!--begin::Icon-->
        <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
        <span class="svg-icon svg-icon-5tx svg-icon-primary mb-5">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
				<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
				<rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect>
				<rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect>
			</svg>
		</span>
        <!--end::Svg Icon-->
        <!--end::Icon-->
        <!--begin::Content-->
        <div class="text-center text-dark">
            <h1 class="fw-bolder mb-5">Signature de votre contrat</h1>
            <div class="separator separator-dashed border-danger opacity-25 mb-5"></div>
            <div class="mb-9">Vous allez signer vos documents.<br>Vous avez reçu un sms de vérification, veuillez cliquer sur le bouton suivant et saisisser le code reçu</div>
            <!--begin::Buttons-->
            <div class="d-flex flex-center flex-wrap">
                <a href="#signed-auth-code" data-bs-toggle="modal" class="btn btn-bank m-2">Signer mon contrat</a>
            </div>
            <!--end::Buttons-->
        </div>
        <!--end::Content-->
    </div>
    <div class="modal fade" tabindex="-1" id="signed-auth-code">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Signature de votre document</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="{{ $verif }}" method="post">
                    <div class="modal-body">
                        <x-form.input
                            name="code_auth"
                            type="password"
                            label="Code Reçu sur votre téléphone: {{ \App\Helpers\Customer\Customer::getPhone($loan->customer) }}"
                            required="true" />
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-bank">Signer mes documents</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"></script>
    @include("scripts.account.subscription.signate")
@endsection

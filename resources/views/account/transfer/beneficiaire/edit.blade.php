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
                    <span>Edition d'un beneficiaire</span>
                </h1>
                <!--end::Title-->

            </div>

        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
@endsection

@section("content")
    <div class="card">
        <div class="card-header bg-bank">
            <h3 class="card-title text-white">Edition du bénéficiaire: {{ $beneficiaire->type == 'corporate' ? $beneficiaire->company : $beneficiaire->civility.'. '.$beneficiaire->firstname.' '.$beneficiaire->lastname }}</h3>
        </div>
        <form action="{{ route('account.transfer.beneficiaire.update', $beneficiaire->uuid) }}" method="post">
            @csrf
            @method("PUT")
            <div class="card-body">
                @if($beneficiaire->type == 'corporate')
                    <x-form.input
                        name="company"
                        type="text"
                        label="Entreprise"
                        value="{{ $beneficiaire->company }}" />
                @else
                    <div class="mb-10 d-flex flex-row">
                        <div class="form-check form-check-custom form-check-solid me-10">
                            <input class="form-check-input h-30px w-30px" type="checkbox" name="civility" value="M" @if($beneficiaire->civility == "M") checked="checked" @endif id="flexCheckbox30"/>
                            <label class="form-check-label" for="flexCheckbox30">
                                Monsieur
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid me-10">
                            <input class="form-check-input h-30px w-30px" type="checkbox" name="civility" value="MME" @if($beneficiaire->civility == "MME") checked="checked" @endif id="flexCheckbox30"/>
                            <label class="form-check-label" for="flexCheckbox30">
                                Madame
                            </label>
                        </div>
                    </div>
                    <x-form.input
                    name="firstname"
                    type="text"
                    label="Nom"
                    value="{{ $beneficiaire->firstname }}" />
                    <x-form.input
                        name="lastname"
                        type="text"
                        label="Prénom"
                        value="{{ $beneficiaire->lastname }}" />
                @endif
                    <div class="form-check form-check-custom form-check-solid me-10">
                        <input class="form-check-input h-30px w-30px" type="checkbox" name="titulaire" @if($beneficiaire->bank->titulaire == 1) checked="checked" @endif id="flexCheckbox30"/>
                        <label class="form-check-label" for="flexCheckbox30">
                            Je suis titulaire de ce compte
                        </label>
                    </div>

            </div>
            <div class="card-footer text-end">
                <button class="btn btn-bank" type="submit">Valider</button>
            </div>
        </form>
    </div>
@endsection

@section("script")

@endsection

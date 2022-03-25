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
                <h1 class="d-flex text-white fw-bolder my-1 fs-1">Votre demande de découvert autorisé </h1>
                <!--end::Title-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
@endsection

@section("content")
    <div class="card" id="zone">
        <div class="card-body">
            <div class="d-flex flex-row justify-content-between">
                <div class="">
                    <img src="{{ public_path('/storage/logo_long_color_540.png') }}" width="150">
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")

@endsection

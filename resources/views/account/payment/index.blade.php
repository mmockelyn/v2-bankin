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
                <button class="btn btn-bank" data-bs-toggle="modal" data-bs-target="#add">Demander un nouvelle carte</button>
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
                            <div class="card-body p-6">
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

        </div>
    </div>
@endsection

@section("script")
@endsection

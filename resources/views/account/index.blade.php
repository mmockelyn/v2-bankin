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
                <h1 class="d-flex text-white fw-bolder my-1 fs-3">Tous mes comptes</h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
@endsection

@section("content")
    <div class="card shadow-lg">
        <div class="card-body row">
            <div class="col-md-9 col-sm-12">
                <h2 class="fw-bold mb-15">Compte Courant</h2>
                @foreach(\App\Models\Customer\CustomerWallet::where('customer_id', request()->user()->customer->id)->where('type', 'account')->get() as $wallet)
                <a href="@if($wallet->status == "ACTIVE"){{ route('account.detail', $wallet->uuid) }}@endif" class="cursor-pointer fs-5 d-flex flex-row justify-content-between align-items-center card shadow-lg opacity-75 opacity-state-100 p-10 mt-5" data-action="show" data-wallet="{{ $wallet->uuid }}">
                    <div class="d-flex fw-bolder">
                        Compte N°{{ $wallet->number_account }}
                    </div>
                    <div class="d-flex flex-column">
                        <span>{{ $wallet->customer->friendlyName }}</span>
                        <span>Prochaine Opérations: {{ eur($wallet->balance_coming) }}</span>
                    </div>
                    <div class="d-flex">
                        @if($wallet->status != "ACTIVE")
                            @switch($wallet->status)
                                @case("PENDING")
                                <span class="badge badge-lg badge-warning">Ouverture en cours</span>
                                @break

                                @case("FAILED")
                                <span class="badge badge-lg badge-danger">ERREUR</span>
                                @break

                                @case("SUSPENDED")
                                <span class="badge badge-lg badge-warning">Compte suspendu</span>
                                @break

                                @case("CLOSED")
                                <span class="badge badge-lg badge-warning">Compte clôturer</span>
                                @break
                            @endswitch
                        @else
                            @if($wallet->balance < 0)
                                <span class="text-end text-danger">{{ eur($wallet->balance) }}</span>
                            @else
                                <span class="text-end text-success">{{ eur($wallet->balance) }}</span>
                            @endif
                        @endif
                    </div>
                    <div class="d-flex text-end w-20px">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </a>
                @endforeach
            </div>
            <div class="col-md-3 col-sm-12"></div>
        </div>
    </div>
@endsection

@section("script")
@endsection

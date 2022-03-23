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
                    <span>Mes Virement</span>
                </h1>
                <!--end::Title-->

            </div>

            <div class="d-flex">
                <a href="{{ route('account.transfer.create') }}" class="btn btn-bank">Nouveau virement</a>
            </div>

        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
@endsection

@section("content")
    <div class="card shadow-lg">
        <div class="card-header bg-bank">
            <div class="card-toolbar">
                <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0">
                    <li class="nav-item">
                        <a class="nav-link text-white active" data-bs-toggle="tab" href="#history">Historique</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" data-bs-toggle="tab" href="#permanent">Permanent</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="history" role="tabpanel">
                    @foreach(auth()->user()->customer->wallets as $wallet)
                        @foreach($wallet->transfers()->where('type', '!=', 'permanent')->get() as $transfer)
                            <a class="card bg-gray-200 bg-hover-lighten h-50px mb-5 showModal fs-4" data-vir="{{ $transfer->reference }}">
                                <!--begin::Body-->
                                <div class="card-body d-flex justify-content-between align-items-center mb-7 p-5 text-black">
                                    <div class="d-flex">{{ $transfer->reason }}</div>
                                    <div class="d-flex">{{ $transfer->transfer_date }}</div>
                                    <div class="d-flex">
                                        {!! \App\Helpers\Customer\Transfers::getStatusLabel($transfer->status) !!}
                                    </div>
                                </div>
                                <!--end::Body-->
                            </a>
                        @endforeach
                    @endforeach
                </div>

                <div class="tab-pane fade" id="permanent" role="tabpanel">
                    @foreach(auth()->user()->customer->wallets as $wallet)
                        @foreach($wallet->transfers()->where('type', 'permanent')->where("transfer_date", null)->get() as $transfer)
                            <a class="card bg-gray-200 bg-hover-lighten h-50px mb-5 showModal fs-4" data-vir="{{ $transfer->reference }}">
                                <!--begin::Body-->
                                <div class="card-body d-flex justify-content-between align-items-center mb-7 p-5 text-black">
                                    <div class="d-flex">{{ $transfer->reason }}</div>
                                    <div class="d-flex">{{ $transfer->recurring_start->format("d/m/Y") }} au {{ $transfer->recurring_end->format("d/m/Y") }}</div>
                                    <div class="d-flex">
                                        {{ eur($transfer->amount) }}
                                    </div>
                                </div>
                                <!--end::Body-->
                            </a>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")

@endsection

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
                <h1 class="d-flex text-white fw-bolder my-1 fs-1">Demande de découvert autorisé</h1>
                <!--end::Title-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
@endsection

@section("content")
    @if($contract->signable == true)
        <div class="card shadow-lg">
            <div class="card-header bg-bank">
                <h3 class="card-title text-white">Signature de document</h3>
            </div>
            <div class="card-body">
                <table class="table gy-5">
                    <tbody>
                        <tr>
                            <td><a href="/storage/gdd/{{ $customer->id }}/contract/{{ Str::slug($contract->name) }}.pdf">{{ $contract->name }}</a></td>
                            <td>
                                @if(isset($contract->signed_at))
                                    <div class="d-flex flex-row">
                                        <i class="fas fa-check-circle text-success fs-1"></i>
                                        <div class="d-flex flex-column ms-2 align-items-center">
                                            <span class="fw-bold fs-3">Document signé</span>
                                        </div>
                                    </div>
                                @else
                                    <a data-bs-toggle="modal" href="#signed-auth-code" class="btn btn-bank">Signer le document</a>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="card shadow-lg">
            <div class="card-header bg-bank">
                <h3 class="card-title text-white">Votre document</h3>
            </div>
            <div class="card-body">
                <table class="table gy-5">
                    <tbody>
                    <tr>
                        <td><a href="/storage/gdd/{{ $customer->id }}/contract/{{ Str::slug($contract->name) }}.pdf">{{ $contract->name }}</a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection

@section("script")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"></script>
    @include("scripts.account.subscription.signate")
@endsection

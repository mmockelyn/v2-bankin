@extends("account.layouts.layout")

@section("css")

@endsection

@section('toolbar')
    <!--begin::Toolbar-->
    <div class="toolbar py-5 py-lg-15" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-xxl d-flex flex-center justify-content-between">
            <!--begin::Page title-->
            <div class="d-flex flex-column w-200px">
                <div class="fs-2x fw-light text-gray-100">Je fais un virement de</div>
                <div class="input-group input-group-transparent input-group-lg mb-5">
                    <input type="text" class="form-control form-control-transparent text-white fs-2x" name="amount">
                    <span class="input-group-text bg-transparent border border-transparent fs-3x text-white">€</span>
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
@endsection

@section("content")
    <div class="card shadow-lg">
        <div class="card-body">
            <a href="{{ route('account.transfer.history') }}" class="card bg-gray-200 bg-hover-lighten h-100px mb-5">
                <!--begin::Body-->
                <div class="card-body d-flex align-items-center mb-7">
                    <div class="symbol symbol-50px me-5">
                        <div class="symbol-label fs-2 fw-bold text-success"><i class="fas fa-stream"></i></div>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="fw-bolder text-dark">Historique des virements</div>
                        <span class="text-muted">Immédiats, différés et permanents</span>
                    </div>
                </div>
                <!--end::Body-->
            </a>
            <a href="{{ route('account.transfer.wise.create') }}" class="card bg-gray-200 bg-hover-lighten h-100px mb-5">
                <!--begin::Body-->
                <div class="card-body d-flex align-items-center mb-7">
                    <div class="symbol symbol-50px me-5">
                        <div class="symbol-label fs-2 fw-bold text-success"><i class="fas fa-stream"></i></div>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="fw-bolder text-dark">Virement international en devise</div>
                        <span class="text-muted">Envoyer de l'argent vers l'étranger</span>
                    </div>
                </div>
                <!--end::Body-->
            </a>
            <a href="{{ route('account.transfer.beneficiaire.list') }}" class="card bg-gray-200 bg-hover-lighten h-100px mb-5">
                <!--begin::Body-->
                <div class="card-body d-flex align-items-center mb-7">
                    <div class="symbol symbol-50px me-5">
                        <div class="symbol-label fs-2 fw-bold text-success"><i class="fas fa-users"></i></div>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="fw-bolder text-dark">Mes Bénéficiaires</div>
                        <span class="text-muted">Ajout et gestion</span>
                    </div>
                </div>
                <!--end::Body-->
            </a>
        </div>
    </div>
@endsection

@section("script")
    <script type="text/javascript">
        $("[name=amount]").on('blur', e => {
            window.location.href='/compte/transfer/create?amount='+$("[name=amount]").val()
        }).on('keyup', e => {
            if(e.key === 'Enter') {
                window.location.href='/compte/transfer/create?amount='+$("[name=amount]").val()
            }
        });
    </script>
@endsection

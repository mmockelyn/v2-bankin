@extends("account.layouts.layout")

@section("css")

@endsection

@section('toolbar')
    <form action="{{ route('account.transfer.store') }}" method="post">
        @csrf
    <!--begin::Toolbar-->
    <div class="toolbar py-5 py-lg-15" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-xxl d-flex flex-center justify-content-between">
            <!--begin::Page title-->
            <div class="d-flex flex-column w-200px">
                <div class="fs-2x fw-light text-gray-100">Je fais un virement de</div>
                <div class="input-group input-group-transparent input-group-lg mb-5">
                    <input type="text" class="form-control form-control-transparent text-white fs-2x" name="amount" @if(request()->has('amount')) value="{{ request()->get('amount') }}" @endif>
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
            <div class="mb-10">
                <label for="" class="form-label">Depuis le compte</label>
                <select class="form-select form-control" name="from" data-control="select2" data-placeholder="Selectionner le compte à débiter">
                    <option value=""></option>
                    <optgroup label="Mes Comptes">
                        @foreach($wallets as $wallet)
                        <option value="{{ $wallet->uuid }}" @if($wallet->status != 'ACTIVE') disabled="disabled" @endif>
                            {{ $wallet->customer->friendlyName }} - {{ \App\Helpers\Customer\Wallet::formatNameAccountForSelect($wallet) }}
                            {{ $wallet->number_account }} - ({{ $wallet->balance >= 0 ? '+ '.eur($wallet->balance) : eur($wallet->balance) }})</option>
                        @endforeach
                    </optgroup>
                </select>
            </div>

            <div class="mb-10">
                <label for="" class="form-label">Vers le compte</label>
                <select class="form-select form-control" name="to" data-control="select2" data-placeholder="Selectionner le compte à créditer">
                    <option value=""></option>
                    <optgroup label="Mes Comptes">
                        @foreach($wallets as $wallet)
                            <option value="{{ $wallet->uuid }}" @if($wallet->status != 'ACTIVE') disabled="disabled" @endif>
                                {{ $wallet->customer->friendlyName }} - {{ \App\Helpers\Customer\Wallet::formatNameAccountForSelect($wallet) }}
                                {{ $wallet->number_account }} - ({{ $wallet->balance >= 0 ? '+ '.eur($wallet->balance) : eur($wallet->balance) }})</option>
                        @endforeach
                    </optgroup>
                    <optgroup label="Comptes Tiers">
                        @foreach($beneficiaires as $beneficiaire)
                            <option value="{{ $beneficiaire->uuid }}" @if(isset($beneficiaire_s) && $beneficiaire_s->id == $beneficiaire->id) selected @endif>
                                {{ \App\Helpers\Customer\Beneficiaire::getNameForSelected($beneficiaire) }} - {{ $beneficiaire->bank->iban }}
                            </option>
                        @endforeach
                    </optgroup>
                </select>
            </div>

            <x-form.input
                name="reason"
                type="text"
                label="Motif du virement" />

            <div class="mb-10">
                <label for="" class="form-label">Type de virement</label>
                <select name="type" class="form-control" data-placeholder="Type de virement" onchange="change(this)">
                    <option value=""></option>
                    <option value="immediat">Immédiat</option>
                    <option value="differed">Différé</option>
                    <option value="permanent">Permanent</option>
                </select>
            </div>
            <div id="differ" class="d-none">
                <x-form.input
                    name="transfer_date"
                    type="text"
                    label="Date du virement" class="date"/>
            </div>
            <div id="perm" class="d-none">
                <x-form.input
                    name="recurring_start"
                    type="text"
                    label="Date de début" class="date"/>

                <x-form.input
                    name="recurring_end"
                    type="text"
                    label="Date de fin" class="date"/>
            </div>
        </div>
        <div class="card-footer text-center">
            <button type="submit" class="btn btn-block btn-bank btn-lg">Valider</button>
        </div>
    </div>
</form>
@endsection

@section("script")
    <script type="text/javascript">
        let selectType = document.querySelector('[name="type"]')

        document.querySelector('#differ').classList.add('d-none')
        document.querySelector('#perm').classList.add('d-none')

        let change = () => {
            console.log(selectType.value)
            if(selectType.value === 'immediat') {
                document.querySelector('#differ').classList.add('d-none')
                document.querySelector('#perm').classList.add('d-none')
            } else if(selectType.value === 'differed') {
                document.querySelector('#differ').classList.remove('d-none')
                document.querySelector('#perm').classList.add('d-none')
            } else {
                document.querySelector('#differ').classList.add('d-none')
                document.querySelector('#perm').classList.remove('d-none')
            }
        }
        $(".date").flatpickr()
    </script>
@endsection

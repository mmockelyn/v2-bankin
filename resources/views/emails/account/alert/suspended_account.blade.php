@extends("emails.layouts.app")

@section("content")
    <div class="d-flex flex-column bg-gray-300 ms-20 me-20 mt-20 mb-5 w-600px">
        <!--begin::Alert-->
        <div class="alert bg-danger d-flex flex-column flex-sm-row p-5 mb-10 mt-10">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                <!--begin::Content-->
                <span class="fs-2tx fw-bolder text-start">VOTRE COMPTE A ETE SUSPENDUE</span>
                <!--end::Content-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Alert-->
        <div class="ms-10 me-10 mb-5">
            <span class="fw-bolder fs-3 mb-5">Bonjour {{ \App\Helpers\Customer\Customer::getFirstname($customer) }}</span>
            <p>A ce jours, et ceux malgré plusieurs relance, votre compte N°{{ $wallet->number_account }} présente un solde débiteur de <strong class="text-danger">{{ eur($solde) }}</strong> depuis le <strong>{{ $wallet->date_alert_debit->subDays(15)->format('d/m/Y') }}</strong>.</p>
            <p>
                Par conséquent votre compte à été <strong class="text-danger">SUSPENDU</strong> pour utilisation irrégulière de ce compte.<br>
                Si vous avez bénéficier d'un découvert bancaire, il vous à été retirer suivant les conditions d'irrégularité de paiement de découvert bancaire de plus de 30 jours.
            </p>
            <p>Votre compte est suspendu mais pas supprimé, vous pouvez toujours remédié à cette situation:</p>
            <ul>
                <li>Alimenter votre compte par carte bancaire</li>
                <li>Effectuer un virement vers le compte débiteur</li>
                <li>Contacter un conseiller {{ config('app.name') }} afin de trouver une solution pour régularisé votre compte.</li>
            </ul>
            <p>Nous sommes désolé d'en arrivé à de tel , et espérons toujours que cette situation n'est que passagère.</p>
            <p>N'oublier pas que nous sommes à votre disposition pour toutes questions.</p>
        </div>
        @include("emails.layouts.salutation")
    </div>
@endsection

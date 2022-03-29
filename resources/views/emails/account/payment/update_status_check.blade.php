@extends("emails.layouts.app")

@section("content")
    <div class="d-flex flex-column bg-gray-300 ms-20 me-20 mt-20 mb-5 w-600px">
        <!--begin::Alert-->
        <div class="alert bg-bank d-flex flex-column flex-sm-row p-5 mb-10 mt-10">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                <!--begin::Content-->
                <span class="fs-2tx fw-bolder text-start">
                    @switch($check->status)
                        @case('manufacture')
                            Votre chéquier est actuellement en fabrication
                        @break
                        @case('ship')
                        Votre chéquier vous à été envoyer
                        @break
                        @case('outstanding')
                        Votre chéquier est maintenant actif
                        @break
                        @case('finish')
                        Votre chéquier est terminer ?
                        @break
                        @case('destroy')
                        Votre chéquier à bien été détruit
                        @break
                    @endswitch
                </span>
                <!--end::Content-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Alert-->
        <div class="ms-10 me-10 mb-5">
            <span class="fw-bolder fs-3 mb-5">Bonjour {{ \App\Helpers\Customer\Customer::getFirstname($customer) }}</span>
            @switch($check->status)
                @case('manufacture')
                <p>Nous vous informons que votre chéquier N° {{ $check->reference }} est actuellement en fabrication en date du <strong>{{ $check->updated_at->format("d/m/Y à H:i") }}</strong>.</p>
                <p>Nous vous tiendrons informer de l'avancement de votre commande.</p>
                @break
                @case('ship')
                <p>Nous vous informons que votre chéquier N° {{ $check->reference }} vous à été envoyer en date du <strong>{{ $check->updated_at->format("d/m/Y à H:i") }}</strong>.</p>
                <p>Nous vous tiendrons informer de l'avancement de votre commande.</p>
                @break
                @case('outstanding')
                <p>Un chèque de votre chéquier N° {{ $check->reference }} à été émis et accepter, son état est donc actif en date du <strong>{{ $check->updated_at->format("d/m/Y à H:i") }}</strong>.</p>
                @break
                @case('finish')
                <p>Nos système nous indique que votre chéquier N° {{ $check->reference }} est <strong>Terminer</strong>.</p>
                <p>N'hésitez pas à en commander un autre par l'intermédiaire de votre espace client.</p>
                @break
                @case('destroy')
                <p>Conformément à votre demande ou à celle de votre conseiller {{ config('app.name') }}, le chéquier N°{{ $check->reference }} à été détruit en date du <strong>{{ $check->updated_at->format("d/m/Y à H:i") }}</strong>.</p>
                @break
            @endswitch
        </div>
        @include("emails.layouts.salutation")
    </div>
@endsection

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
                <h1 class="d-flex text-white fw-bolder my-1 fs-3">Souscrire</h1>
                <!--end::Title-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
@endsection

@section("content")
    <div class="card mb-15">
        <div class="row g-0">
            <div class="col-3">
                <img src="/storage/{{ request()->user()->customer->package->name }}_pack.png" class="img-fluid rounded-star" alt="">
            </div>
            <div class="col-6 d-flex flex-column flex-start p-10">
                <h5 class="card-title mb-3">Votre compte actuel</h5>
                <p>
                    <strong>Type: </strong>{{ request()->user()->customer->package->name }}<br>
                    <strong>Tarification: </strong> {{ eur(request()->user()->customer->package->price) }} / par mois
                </p>
            </div>
            <div class="col-3 flex-end align-items-center p-15">
                <a href="{{ route('account.edit') }}" class="btn btn-sm btn-outline btn-outline-bank">Mise à niveau</a>
            </div>
        </div>
    </div>
    <h3 class="fs-1">S'assurer</h3>
    <div class="row mb-10">
        <div class="col-4">
            <a href="#assur_auto" data-bs-toggle="modal" class="card mb-3">
                <img src="https://www.banquepopulaire.fr/resources/offers/subscription/images/bp/subscribe-card/insuring/car-rate.png" alt="" class="card-img-top" />
                <div class="card-body">
                    <h3 class="card-title">Assurance Auto</h3>
                    <p class="card-text text-gray-500">Un contrat qui prend soin de votre véhicule mais aussi de vous, vos passagers et des tiers.</p>
                </div>
            </a>
        </div>
        <div class="col-4">
            <a href="" class="card mb-3">
                <img src="https://www.banquepopulaire.fr/resources/offers/subscription/images/bp/subscribe-card/insuring/house-rate.png" alt="" class="card-img-top" />
                <div class="card-body">
                    <h3 class="card-title">Assurance Habitation</h3>
                    <p class="card-text text-gray-500">Assurez votre habitation au plus près de vos besoins et de votre budget.</p>
                </div>
            </a>
        </div>
        <div class="col-4">
            <a href="" class="card mb-3">
                <img src="https://www.banquepopulaire.fr/resources/offers/subscription/images/bp/subscribe-card/insuring/family.png" alt="" class="card-img-top" />
                <div class="card-body">
                    <h3 class="card-title">Assurance Famille</h3>
                    <p class="card-text text-gray-500">Protégez-vous quelle que soit votre situation familiale, professionnelle et financière contre les aléas de la vie.</p>
                </div>
            </a>
        </div>
        <div class="d-flex flex-center">
            <a class="btn btn-lg btn-outline btn-outline-bank w-500px">Tous nos produits d'assurances</a>
        </div>
    </div>
    <h3 class="fs-1">Emprunter</h3>
    <div class="row mb-10">
        <div class="col-4">
            <a href="" class="card mb-3">
                <img src="https://www.banquepopulaire.fr/resources/offers/subscription/images/bp/subscribe-card/loan/housing-simulator.png" alt="" class="card-img-top" />
                <div class="card-body">
                    <h3 class="card-title">Pret Immobilier</h3>
                    <p class="card-text text-gray-500">Protégez-vous quelle que soit votre situation familiale, professionnelle et financière contre les aléas de la vie.</p>
                </div>
            </a>
        </div>
        <div class="col-4">
            <a href="" class="card mb-3">
                <img src="https://www.banquepopulaire.fr/resources/offers/subscription/images/bp/subscribe-card/loan/personal-simulator.png" alt="" class="card-img-top" />
                <div class="card-body">
                    <h3 class="card-title">Pret Personnel</h3>
                    <p class="card-text text-gray-500">Protégez-vous quelle que soit votre situation familiale, professionnelle et financière contre les aléas de la vie.</p>
                </div>
            </a>
        </div>
        <div class="col-4">
            <a href="" class="card mb-3">
                <img src="https://www.banquepopulaire.fr/resources/offers/subscription/images/bp/subscribe-card/loan/rent-simulator.png" alt="" class="card-img-top" />
                <div class="card-body">
                    <h3 class="card-title">Location avec options d'achat</h3>
                    <p class="card-text text-gray-500">Protégez-vous quelle que soit votre situation familiale, professionnelle et financière contre les aléas de la vie.</p>
                </div>
            </a>
        </div>
        <p>Un crédit vous engage et doit être remboursé. Vérifiez vos capacités de remboursement avant de vous engager.</p>
        <div class="d-flex flex-center">
            <a class="btn btn-lg btn-outline btn-outline-bank w-500px">Tous nos prets</a>
        </div>
    </div>
    <h3 class="fs-1">Comptes et moyens de paiements</h3>
    <div class="row mb-10">
        <div class="col-4">
            <a href="" class="card mb-3">
                <img src="https://www.banquepopulaire.fr/resources/offers/subscription/images/bp/subscribe-card/payment/essential-family-pack.png" alt="" class="card-img-top" />
                <div class="card-body">
                    <h3 class="card-title">Comptes courant</h3>
                    <p class="card-text text-gray-500">Protégez-vous quelle que soit votre situation familiale, professionnelle et financière contre les aléas de la vie.</p>
                </div>
            </a>
        </div>
        <div class="col-4">
            <a href="" class="card mb-3">
                <img src="https://www.banquepopulaire.fr/resources/offers/subscription/images/bp/subscribe-card/payment/credit-card.png" alt="" class="card-img-top" />
                <div class="card-body">
                    <h3 class="card-title">Cartes Bancaire</h3>
                    <p class="card-text text-gray-500">Protégez-vous quelle que soit votre situation familiale, professionnelle et financière contre les aléas de la vie.</p>
                </div>
            </a>
        </div>
        <div class="col-4">
            <div class="card mb-3 opacity-25 ribbon">
                <img src="https://www.banquepopulaire.fr/resources/offers/subscription/images/bp/subscribe-card/loan/rent-simulator.png" alt="" class="card-img-top" />
                <div class="card-body">
                    <div class="ribbon-label bg-primary">Bientôt disponible</div>
                    <h3 class="card-title">Retrait One-to-GO</h3>
                    <p class="card-text text-gray-500">Protégez-vous quelle que soit votre situation familiale, professionnelle et financière contre les aléas de la vie.</p>
                </div>
            </div>
        </div>
        <div class="d-flex flex-center">
            <a class="btn btn-lg btn-outline btn-outline-bank w-500px">Tous nos comptes et moyens de paiements</a>
        </div>
    </div>
    @include("account.subscribe.modal.insurance")
@endsection

@section("script")
    @include("scripts.account.insurance.index")
@endsection

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
                <h1 class="d-flex text-white fw-bolder my-1 fs-1">Votre Profil</h1>
                <!--end::Title-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
@endsection

@section("content")
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-header bg-bank">
                    <h3 class="card-title text-white fw-bold">PROFIL</h3>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs nav-pills border-0 flex-row flex-md-column me-5 mb-3 mb-md-0 fs-6">
                        <li class="nav-item  me-0">
                            <a class="nav-link active" data-bs-toggle="tab" href="#infos">Informations Personnelles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#contact">Contactez ma banque</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#security">Sécurité d'accès</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active card" id="infos" role="tabpanel">
                    <div class="card-header">
                        <h3 class="card-title">Informations Personnelles</h3>
                        <div class="card-toolbar">
                            <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#my_info">Mes Informations</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#phone_mail">Téléphone & Email</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#situation">Ma situation</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent2">
                            <div class="tab-pane fade show active" id="my_info" role="tabpanel">
                                <div class="row mb-10">
                                    <div class="col-md-6">
                                        <div class="card shadow-md bg-gray-200">
                                            <div class="card-header bg-bank">
                                                <h3 class="card-title text-white">Vous & votre agence</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex flex-row justify-content-between">
                                                    <span>Votre conseiller</span>
                                                    <span>Néant</span>
                                                </div>
                                                <div class="d-flex flex-row justify-content-between">
                                                    <span>Votre agence</span>
                                                    <span>{{ $user->agence->name }}</span>
                                                </div>
                                                <p class="mt-5">Votre dernière connexion à eu lieu le: {{ $login->created_at->format('d/m/Y à H:i') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card shadow-md bg-gray-200">
                                            <div class="card-header bg-bank">
                                                <h3 class="card-title text-white">Vos coordonnées</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex flex-row justify-content-between">
                                                    <span>Identifiant</span>
                                                    <span>{{ $user->identifiant }}</span>
                                                </div>
                                                <div class="d-flex flex-row justify-content-between">
                                                    <span>Téléphone de référence</span>
                                                    <span>+33X XX XX {{ Str::substr(\App\Helpers\Customer\Customer::getPhone($user->customer), 8, 4) }}</span>
                                                </div>
                                                <div class="d-flex flex-row justify-content-between">
                                                    <span>Email</span>
                                                    <span>{{ \App\Helpers\Customer\Customer::getEmail($user->email) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card bg-gray-200 shadow-md">
                                    <div class="card-header bg-bank">
                                        <h3 class="card-title text-white">Les Nouveaux messages reçu</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-rounded table-striped border gy-7 gs-7">
                                                <thead>
                                                <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                                                    <th>Sujet</th>
                                                    <th class="text-center">Date</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if($user->unreadNotifications()->count() != 0)
                                                    @foreach($user->unreadNotifications as $notification)
                                                        <tr>
                                                            <td>{{ $notification->data['sub'] }}</td>
                                                            <td class="text-center">{{ $notification->created_at->format('d/m/Y') }}</td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="2" class="text-center fw-bold fs-6">Aucun nouveau message disponible actuellement !</td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="phone_mail" role="tabpanel">
                                <div class="card shadow-md bg-gray-200">
                                    <form id="formUpdatePhoneMail" action="{{ route('account.settings.updateProfil') }}" method="post">
                                        <div class="card-body">
                                            @csrf
                                            <input type="hidden" name="action" value="updatePhoneMail">

                                            <h2 class="fw-bold mb-3">Information de contact</h2>
                                            <x-form.input
                                                name="phone"
                                                type="text"
                                                label="Téléphone de contact"
                                                value="{{ \App\Helpers\Customer\Customer::getPhone($user->customer) }}" />

                                            <x-form.input
                                                name="email"
                                                type="text"
                                                label="Adresse Mail"
                                                value="{{ \App\Helpers\Customer\Customer::getEmail($user->email, false) }}" />

                                            <h2 class="fw-bold mb-3">Communication commercial</h2>

                                            <div class="d-flex flex-stack w-lg-50 mb-5">
                                                <!--begin::Label-->
                                                <div class="me-5">
                                                    <label class="fs-6 fw-bold form-label">Par SMS</label>
                                                    <div class="fs-7 fw-bold text-muted">{{ \App\Helpers\Customer\Customer::getPhone($user->customer) }}</div>
                                                </div>
                                                <!--end::Label-->

                                                <!--begin::Switch-->
                                                <label class="form-check form-switch form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" name="notif_com_sms" value="1" @if($user->customer->setting->notif_com_sms == 1) checked="checked" @endif/>
                                                </label>
                                                <!--end::Switch-->
                                            </div>
                                            <div class="d-flex flex-stack w-lg-50 mb-5">
                                                <!--begin::Label-->
                                                <div class="me-5">
                                                    <label class="fs-6 fw-bold form-label">Par notification push</label>
                                                </div>
                                                <!--end::Label-->

                                                <!--begin::Switch-->
                                                <label class="form-check form-switch form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" name="notif_com_apps" value="1" @if($user->customer->setting->notif_com_apps == 1) checked="checked" @endif/>
                                                </label>
                                                <!--end::Switch-->
                                            </div>
                                            <div class="d-flex flex-stack w-lg-50 mb-5">
                                                <!--begin::Label-->
                                                <div class="me-5">
                                                    <label class="fs-6 fw-bold form-label">Par email</label>
                                                    <div class="fs-7 fw-bold text-muted">{{ \App\Helpers\Customer\Customer::getEmail($user->email) }}</div>
                                                </div>
                                                <!--end::Label-->

                                                <!--begin::Switch-->
                                                <label class="form-check form-switch form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" name="notif_com_mail" value="1" @if($user->customer->setting->notif_com_mail == 1) checked="checked" @endif/>
                                                </label>
                                                <!--end::Switch-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <div class="card-footer text-end">
                                            <button class="btn btn-bank btn-lg" type="submit">
                                                <span class="indicator-label">
                                                    Mettre à jours
                                                </span>
                                                <span class="indicator-progress">
                                                    Patientez... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                </span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="situation" role="tabpanel">
                                <div class="card shadow-md bg-gray-200">
                                    <form id="formUpdateSituation" action="{{ route('account.settings.updateProfil') }}" method="post">
                                        <div class="card-body">
                                            @csrf
                                            <input type="hidden" name="action" value="updateSituation">

                                            <h2 class="fw-bold mb-3">Situation Personnelle</h2>
                                            <div class="row mb-15">
                                                <div class="col-md-6">
                                                    <div class="mb-10">
                                                        <label for="" class="form-label">Capacité Juridique</label>
                                                        <select name="legal_capacity" class="form-select" data-control="select2" disabled>
                                                            <option value="Majeur Capable" @if($user->customer->situation->legal_capacity == 'Majeur Capable') selected @endif>Majeur Capable</option>
                                                            <option value="Mineur" @if($user->customer->situation->legal_capacity == 'Mineur') selected @endif>Mineur</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-10">
                                                        <label for="" class="form-label">Situation Familliale</label>
                                                        <select name="family_situation" class="form-select" data-control="select2">
                                                            <option value="Célibataire" @if($user->customer->situation->family_situation == 'Célibataire') selected @endif>Célibataire</option>
                                                            <option value="Divorcé" @if($user->customer->situation->family_situation == 'Divorcé') selected @endif>Divorcé</option>
                                                            <option value="Marié" @if($user->customer->situation->family_situation == 'Marié') selected @endif>Marié</option>
                                                            <option value="Pacsé" @if($user->customer->situation->family_situation == 'Pacsé') selected @endif>Pacsé</option>
                                                            <option value="Séparé de corps" @if($user->customer->situation->family_situation == 'Séparé de corps') selected @endif>Séparé de corps</option>
                                                            <option value="Union Libre" @if($user->customer->situation->family_situation == 'Union Libre') selected @endif>Union Libre</option>
                                                            <option value="Veuf (ve)" @if($user->customer->situation->family_situation == 'Veuf (ve)') selected @endif>Veuf (ve)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-10">
                                                        <label for="" class="form-label">Logement</label>
                                                        <select name="logement" class="form-select" data-control="select2" >
                                                            <option value="Propriétaire" @if($user->customer->situation->logement == 'Propriétaire') selected @endif>Propriétaire</option>
                                                            <option value="Locataire" @if($user->customer->situation->logement == 'Locataire') selected @endif>Locataire</option>
                                                            <option value="Logé par employeur" @if($user->customer->situation->logement == 'Logé par employeur') selected @endif>Logé par employeur</option>
                                                            <option value="Logé à titre gratuit" @if($user->customer->situation->logement == 'Logé à titre gratuit') selected @endif>Logé à titre gratuit</option>
                                                            <option value="Logé par les parents" @if($user->customer->situation->logement == 'Logé par les parents') selected @endif>Logé par les parents</option>
                                                            <option value="Sans Domicile Fixe" @if($user->customer->situation->logement == 'Sans Domicile Fixe') selected @endif>Sans Domicile Fixe</option>
                                                            <option value="Hôtel" @if($user->customer->situation->logement == 'Hôtel') selected @endif>Hôtel</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-10">
                                                        <label for="" class="form-label">Depuis le</label>
                                                        <input type="text" name="logement_at" class="form-control date" value="{{ $user->customer->situation->logement_at->format('Y-m-d') }}">
                                                    </div>
                                                    <div class="mb-10">
                                                        <label for="" class="form-label">Nombre d'enfant</label>
                                                        <input type="text" name="child" class="form-control" value="{{ $user->customer->situation->child }}">
                                                    </div>
                                                    <div class="mb-10">
                                                        <label for="" class="form-label">Nombre de personne à charge</label>
                                                        <input type="text" name="person_charged" class="form-control" value="{{ $user->customer->situation->person_charged }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <h2 class="fw-bold mb-3">Situation Professionnel</h2>
                                            <div class="mb-10">
                                                <label for="" class="form-label">Catégorie Sociaux Professionnel</label>
                                                <select name="pro_category" class="form-select" data-control="select2">
                                                    <option value="Agriculteurs" @if($user->customer->situation->pro_category == 'Agriculteurs') selected @endif>Agriculteurs</option>
                                                    <option value="Artisan,Commerçant,Chef Ent" @if($user->customer->situation->pro_category == 'Artisan,Commerçant,Chef Ent') selected @endif>Artisan,Commerçant,Chef Ent</option>
                                                    <option value="Cadre" @if($user->customer->situation->pro_category == 'Cadre') selected @endif>Cadre</option>
                                                    <option value="Employé" @if($user->customer->situation->pro_category == 'Employé') selected @endif>Employé</option>
                                                    <option value="Ouvriers" @if($user->customer->situation->pro_category == 'Ouvriers') selected @endif>Ouvriers</option>
                                                    <option value="Retraite" @if($user->customer->situation->pro_category == 'Retraite') selected @endif>Retraite</option>
                                                    <option value="Sans Emploie" @if($user->customer->situation->pro_category == 'Sans Emploie') selected @endif>Sans Emploie</option>
                                                </select>
                                            </div>
                                            <div class="mb-10">
                                                <label for="" class="form-label">Profession</label>
                                                <input type="text" name="pro_profession" class="form-control" value="{{ $user->customer->situation->pro_profession }}">
                                            </div>
                                            <div class="mb-10">
                                                <label for="" class="form-label">Revenue net avant impot</label>
                                                <input type="text" name="pro_incoming" class="form-control" value="{{ $user->customer->situation->pro_incoming }}">
                                            </div>
                                            <h2 class="fw-bold mb-3">Mon Patrimoine</h2>
                                            <x-form.input
                                                name="patrimoine"
                                                type="text"
                                                label="Montant de votre patrimoine"
                                                help="true"
                                                helpText="Revenue accessible grace à votre patrimoine mobilier et immobilier" />

                                            <h2 class="fw-bold mb-3">Mes Charges</h2>
                                            <x-form.input
                                                name="rent"
                                                type="text"
                                                label="Loyer"
                                                help="true"
                                                helpText="Loyer ou crédit immobilier" />

                                            <x-form.input
                                                name="credit"
                                                type="text"
                                                label="Crédit"
                                                help="true"
                                                helpText="Ensemble de vos crédits actuel" />

                                            <x-form.input
                                                name="divers"
                                                type="text"
                                                label="Divers"
                                                help="true"
                                                helpText="Autres charges..." />
                                            <!--end::Input group-->
                                        </div>
                                        <div class="card-footer text-end">
                                            <button class="btn btn-bank btn-lg" type="submit">
                                                <span class="indicator-label">
                                                    Mettre à jours
                                                </span>
                                                <span class="indicator-progress">
                                                    Patientez... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                </span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade card" id="contact" role="tabpanel">
                    <div class="card-header">
                        <h3 class="card-title">Contacter ma banque</h3>
                    </div>
                    <form id="formContact" action="/api/account/contact" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <div class="card-body">
                            <div class="d-flex flex-row justify-content-around align-items-start">
                                <div class="d-flex flex-column">
                                    <div class="mb-10">
                                        <label class="form-label required">Objet</label>
                                        <select class="form-control" data-control="select2" name="object" data-placeholder="Selectionner un sujet">
                                            <option value=""></option>
                                            <option value="Information Espace Client">Information Espace Client</option>
                                            <option value="Information comptes & Moyens de Paiements">Information comptes & Moyens de Paiements</option>
                                            <option value="Informations sur les crédits">Informations sur les crédits</option>
                                            <option value="Informations sur les assurances">Informations sur les assurances</option>
                                            <option value="Informations sur les épargnes">Informations sur les épargnes</option>
                                            <option value="Autres Demandes">Autres Demandes</option>
                                        </select>
                                    </div>
                                    <div class="mb-10">
                                        <label class="form-label required">Mon message</label>
                                        <textarea class="form-control" name="message" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="mb-10">
                                        <label for="" class="form-label">Pour me répondre</label>
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" name="response" value="phone" id="flexRadioDefault"/>
                                            <label class="form-check-label" for="flexRadioDefault">
                                                Par téléphone
                                            </label>
                                        </div>
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" name="response" value="email" id="flexRadioDefault"/>
                                            <label class="form-check-label" for="flexRadioDefault">
                                                Par Email
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button class="btn btn-bank btn-lg" type="submit">
                                <span class="indicator-label">
                                    Valider
                                </span>
                                <span class="indicator-progress">
                                    Patientez... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade card" id="security" role="tabpanel">
                    <div class="card-header">
                        <h3 class="card-title">Sécurité d'accès</h3>
                        <div class="card-toolbar">
                            <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#password">Mot de passe</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#auth2fa">Authentification 2FA</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#code_transpac">Code Transaction</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="password" role="tabpanel">
                                <div class="card bg-gray-200 shadow-md">
                                    <div class="card-header">
                                        <h3 class="card-title">Modification du mot de passe</h3>
                                    </div>
                                    <form id="formUpdatePassword" action="{{ route('account.settings.updatePassword') }}" method="post">
                                        @csrf
                                        @method("put")
                                        <div class="card-body">
                                            <!--begin::Main wrapper-->
                                            <div class="fv-row" data-kt-password-meter="true">
                                                <!--begin::Wrapper-->
                                                <div class="mb-1">
                                                    <!--begin::Label-->
                                                    <label class="form-label fw-bold fs-6 mb-2">
                                                        Nouveau mot de passe
                                                    </label>
                                                    <!--end::Label-->

                                                    <!--begin::Input wrapper-->
                                                    <div class="position-relative mb-3">
                                                        <input class="form-control form-control-lg form-control-solid"
                                                               type="password" placeholder="" name="password" autocomplete="off" />

                                                        <!--begin::Visibility toggle-->
                                                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                                              data-kt-password-meter-control="visibility">
                                                    <i class="bi bi-eye-slash fs-2"></i>

                                                    <i class="bi bi-eye fs-2 d-none"></i>
                                                </span>
                                                        <!--end::Visibility toggle-->
                                                    </div>
                                                    <!--end::Input wrapper-->

                                                    <!--begin::Highlight meter-->
                                                    <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                                    </div>
                                                    <!--end::Highlight meter-->
                                                </div>
                                                <!--end::Wrapper-->

                                                <!--begin::Hint-->
                                                <div class="text-muted">
                                                    Utilisez 8 caractères ou plus avec un mélange de lettres, de chiffres et de symboles.
                                                </div>
                                                <!--end::Hint-->
                                            </div>
                                            <!--end::Main wrapper-->
                                        </div>
                                        <div class="card-footer text-end">
                                            <button class="btn btn-bank btn-lg" type="submit">
                                        <span class="indicator-label">
                                            Valider
                                        </span>
                                                <span class="indicator-progress">
                                            Patientez... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="auth2fa" role="tabpanel">
                                <div class="card bg-gray-200 shadow-md">
                                    <div class="card-header">
                                        <h3 class="card-title">Authentification 2FA</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center">
                                            <img src="/storage/2fa.png" alt width="150"/>
                                            <div class="mt-6 mb-5">
                                                <p>L'autentification 2FA ajoute une couche de sécurité lors de votre authentification sur votre espace client.</p>
                                            </div>
                                            @if (session('status') == 'two-factor-authentication-enabled')
                                                <button class="btn btn-lg btn-bank"><i class="fas fa-unlock text-white me-2"></i> Désactiver l'autentification 2FA</button>
                                            @else
                                                <form id="formActiveAuth" action="{{ route('two-factor.enable') }}" method="post">
                                                    @csrf
                                                    <button class="btn btn-lg btn-bank"><i class="fas fa-lock text-white me-2"></i> Activer l'autentification 2FA</button>
                                                </form>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="show_qr_code">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Authentification 2FA</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    Veuillez scanner ce QR code avec votre authentificateur
                    <div id="divQrShow"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    @include("scripts.account.settings.profil")
@endsection

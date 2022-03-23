@extends("front.layouts.layout")

@section("css")

@endsection

@section("content")
    <div class="container">
        @if(session()->has('error'))
            <div class="alert alert-danger">
                <strong>Erreur !</strong> {{ session()->get('error') }}
            </div>
        @endif
            <div class="container">
                <div class="mb-10 w-700px">
                    <h1 class="fw-bolder">Bonjour {{ auth()->user()->customer->friendlyName }} !</h1>
                    <p class="fs-3">Nous sommes ravi de vous revoir, nous vous invitons à consulter l'avancement de votre demande d'ouverture de compte:</p>
                </div>
                <div class="d-flex flex-row justify-content-center align-items-center">
                    @if(auth()->user()->customer->status_open_account == 'open')
                        <div class="mb-20">
                            <div class="d-flex flex-column flex-center">
                                <div class="symbol symbol-150px symbol-circle me-20 mb-5" data-bs-toggle="tooltip" title="Votre offre et votre contrat">
                                    <div class="symbol-label bg-light-primary">
                                        <i class="fas fa-laptop fa-4x text-primary"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column flex-center">
                                <div class="symbol symbol-100px symbol-circle me-20 mb-5" data-bs-toggle="tooltip" title="Envoie de vos pièces justificative">
                                    <div class="symbol-label bg-light-gray">
                                        <i class="fas fa-file fa-3x text-gray"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column flex-center">
                                <div class="symbol symbol-100px symbol-circle me-20 mb-5" data-bs-toggle="tooltip" title="Versement initial et activation du compte">
                                    <div class="symbol-label bg-light-gray">
                                        <i class="fas fa-money-bill fa-3x text-gray"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-lg mb-10">
                            <div class="card-header">
                                <h3 class="card-title">Votre offre et votre contrat</h3>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-dismissible bg-warning d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                                    <!--begin::Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/files/fil024.svg-->
                                    <span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path opacity="0.3" d="M14 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L14 2Z" fill="black"></path>
									<path d="M20 8L14 2V6C14 7.10457 14.8954 8 16 8H20Z" fill="black"></path>
									<rect x="13.6993" y="13.6656" width="4.42828" height="1.73089" rx="0.865447" transform="rotate(45 13.6993 13.6656)" fill="black"></rect>
									<path d="M15 12C15 14.2 13.2 16 11 16C8.8 16 7 14.2 7 12C7 9.8 8.8 8 11 8C13.2 8 15 9.8 15 12ZM11 9.6C9.68 9.6 8.6 10.68 8.6 12C8.6 13.32 9.68 14.4 11 14.4C12.32 14.4 13.4 13.32 13.4 12C13.4 10.68 12.32 9.6 11 9.6Z" fill="black"></path>
								</svg>
							</span>
                                    <!--end::Svg Icon-->
                                    <!--end::Icon-->
                                    <!--begin::Content-->
                                    <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                                        <h4 class="mb-2 text-light">Votre dossier est incomplet</h4>
                                        <span>Nous avons remarqué que votre inscription n'est pas tout à fais terminer, veuillez la reprendre.</span>
                                    </div>
                                    <!--end::Content-->
                                </div>
                            </div>
                        </div>

                    @elseif(auth()->user()->customer->status_open_account == 'completed')

                        <div class="mb-20">
                            <div class="d-flex flex-column flex-center">
                                <div class="symbol symbol-100px symbol-circle me-20 mb-5" data-bs-toggle="tooltip" title="Votre offre et votre contrat">
                                    <div class="symbol-label bg-light-success">
                                        <i class="fas fa-laptop fa-3x text-success"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column flex-center">
                                <div class="symbol symbol-150px symbol-circle me-20 mb-5" data-bs-toggle="tooltip" title="Envoie de vos pièces justificative">
                                    <div class="symbol-label bg-light-primary">
                                        <i class="fas fa-file fa-4x text-primary"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column flex-center">
                                <div class="symbol symbol-100px symbol-circle me-20 mb-5" data-bs-toggle="tooltip" title="Versement initial et activation du compte">
                                    <div class="symbol-label bg-light-gray">
                                        <i class="fas fa-money-bill fa-3x text-gray"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-lg mb-10">
                            <div class="card-header">
                                <h3 class="card-title">Envoie de vos pièces justificatives</h3>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-dismissible bg-primary d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                                    <!--begin::Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/files/fil024.svg-->
                                    <span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path opacity="0.3" d="M14 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L14 2Z" fill="black"></path>
									<path d="M20 8L14 2V6C14 7.10457 14.8954 8 16 8H20Z" fill="black"></path>
									<rect x="13.6993" y="13.6656" width="4.42828" height="1.73089" rx="0.865447" transform="rotate(45 13.6993 13.6656)" fill="black"></rect>
									<path d="M15 12C15 14.2 13.2 16 11 16C8.8 16 7 14.2 7 12C7 9.8 8.8 8 11 8C13.2 8 15 9.8 15 12ZM11 9.6C9.68 9.6 8.6 10.68 8.6 12C8.6 13.32 9.68 14.4 11 14.4C12.32 14.4 13.4 13.32 13.4 12C13.4 10.68 12.32 9.6 11 9.6Z" fill="black"></path>
								</svg>
							</span>
                                    <!--end::Svg Icon-->
                                    <!--end::Icon-->
                                    <!--begin::Content-->
                                    <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                                        <h4 class="mb-2 text-light">Votre dossier est complet et en cours de traitement par la
                                            {{ config("app.name") }} Team</h4>
                                        <span>Nous vous invitons à vous reconnecter dans les prochains jours pour suivre votre demande.</span>
                                    </div>
                                    <!--end::Content-->
                                </div>
                            </div>
                        </div>

                    @elseif(auth()->user()->customer->status_open_account == 'accepted')

                        <div class="mb-20">
                            <div class="d-flex flex-column flex-center">
                                <div class="symbol symbol-100px symbol-circle me-20 mb-5" data-bs-toggle="tooltip" title="Votre offre et votre contrat">
                                    <div class="symbol-label bg-light-success">
                                        <i class="fas fa-laptop fa-3x text-success"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column flex-center">
                                <div class="symbol symbol-100px symbol-circle me-20 mb-5" data-bs-toggle="tooltip" title="Envoie de vos pièces justificative">
                                    <div class="symbol-label bg-light-success">
                                        <i class="fas fa-file fa-3x text-success"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column flex-center">
                                <div class="symbol symbol-150px symbol-circle me-20 mb-5" data-bs-toggle="tooltip" title="Versement initial et activation du compte">
                                    <div class="symbol-label bg-light-primary">
                                        <i class="fas fa-money-bill fa-4x text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-lg mb-10">
                            <div class="card-header">
                                <h3 class="card-title">Versement initial et activation du compte</h3>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-dismissible bg-success d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                                    <!--begin::Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/files/fil024.svg-->
                                    <span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path opacity="0.3" d="M14 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L14 2Z" fill="black"></path>
									<path d="M20 8L14 2V6C14 7.10457 14.8954 8 16 8H20Z" fill="black"></path>
									<rect x="13.6993" y="13.6656" width="4.42828" height="1.73089" rx="0.865447" transform="rotate(45 13.6993 13.6656)" fill="black"></rect>
									<path d="M15 12C15 14.2 13.2 16 11 16C8.8 16 7 14.2 7 12C7 9.8 8.8 8 11 8C13.2 8 15 9.8 15 12ZM11 9.6C9.68 9.6 8.6 10.68 8.6 12C8.6 13.32 9.68 14.4 11 14.4C12.32 14.4 13.4 13.32 13.4 12C13.4 10.68 12.32 9.6 11 9.6Z" fill="black"></path>
								</svg>
							</span>
                                    <!--end::Svg Icon-->
                                    <!--end::Icon-->
                                    <!--begin::Content-->
                                    <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                                        <h4 class="mb-2 text-light">Votre dossier à été accepter, Bienvenue {{ auth()->user()->name }} !</h4>
                                        <span>Un email vous à été envoyer avec votre RIB ou vous devrez effectuer un versement initial entre 10 et 500 €.</span>
                                    </div>
                                    <button class="btn btn-primary rounded-3" data-bs-toggle="modal" data-bs-target="#deposit_modal"><i class="fas fa-credit-card me-3"></i> Alimentez votre compte bancaire</button>
                                    <!--end::Content-->
                                </div>
                            </div>
                        </div>

                    @elseif(auth()->user()->customer->status_open_account == 'declined')
                        <div class="mb-20">
                            <div class="d-flex flex-column flex-center">
                                <div class="symbol symbol-100px symbol-circle me-20 mb-5" data-bs-toggle="tooltip" title="Votre offre et votre contrat">
                                    <div class="symbol-label bg-light-success">
                                        <i class="fas fa-laptop fa-3x text-success"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column flex-center">
                                <div class="symbol symbol-150px symbol-circle me-20 mb-5" data-bs-toggle="tooltip" title="Envoie de vos pièces justificative">
                                    <div class="symbol-label bg-light-danger">
                                        <i class="fas fa-file fa-4x text-danger"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column flex-center">
                                <div class="symbol symbol-100px symbol-circle me-20 mb-5" data-bs-toggle="tooltip" title="Versement initial et activation du compte">
                                    <div class="symbol-label bg-light-gray">
                                        <i class="fas fa-money-bill fa-3x text-gray"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-lg mb-10">
                            <div class="card-header">
                                <h3 class="card-title">Ouverture de compte refuser</h3>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-dismissible bg-danger d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                                    <!--begin::Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/files/fil024.svg-->
                                    <span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path opacity="0.3" d="M14 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L14 2Z" fill="black"></path>
									<path d="M20 8L14 2V6C14 7.10457 14.8954 8 16 8H20Z" fill="black"></path>
									<rect x="13.6993" y="13.6656" width="4.42828" height="1.73089" rx="0.865447" transform="rotate(45 13.6993 13.6656)" fill="black"></rect>
									<path d="M15 12C15 14.2 13.2 16 11 16C8.8 16 7 14.2 7 12C7 9.8 8.8 8 11 8C13.2 8 15 9.8 15 12ZM11 9.6C9.68 9.6 8.6 10.68 8.6 12C8.6 13.32 9.68 14.4 11 14.4C12.32 14.4 13.4 13.32 13.4 12C13.4 10.68 12.32 9.6 11 9.6Z" fill="black"></path>
								</svg>
							</span>
                                    <!--end::Svg Icon-->
                                    <!--end::Icon-->
                                    <!--begin::Content-->
                                    <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                                        <h4 class="mb-2 text-light">Votre dossier à été refuser !</h4>
                                        <span>Malheuresement, votre inscription à été rejeté par la {{ config('app.name') }} Team. Veuillez réessayer dans quelque temps.</span>
                                    </div>
                                    <!--end::Content-->
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="mb-20">
                            <div class="d-flex flex-column flex-center">
                                <div class="symbol symbol-100px symbol-circle me-20 mb-5" data-bs-toggle="tooltip" title="Votre offre et votre contrat">
                                    <div class="symbol-label bg-light-success">
                                        <i class="fas fa-laptop fa-3x text-success"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column flex-center">
                                <div class="symbol symbol-100px symbol-circle me-20 mb-5" data-bs-toggle="tooltip" title="Envoie de vos pièces justificative">
                                    <div class="symbol-label bg-light-success">
                                        <i class="fas fa-file fa-3x text-success"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column flex-center">
                                <div class="symbol symbol-100px symbol-circle me-20 mb-5" data-bs-toggle="tooltip" title="Versement initial et activation du compte">
                                    <div class="symbol-label bg-light-success">
                                        <i class="fas fa-money-bill fa-3x text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-lg mb-10">
                            <div class="card-header">
                                <h3 class="card-title">Procédure d'ouverture de compte terminer</h3>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('login') }}" class="btn btn-primary btn-2xl btn-circle">Acceder à mon compte</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
    </div>
    <div class="modal fade" tabindex="-1" id="deposit_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Dépot sur votre compte bancaire</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="{{ route('checkout') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="" class="form-label">Compte à créditer</label>
                            <select class="form-select mb-3" name="number_account">
                                <option value=""></option>
                                @foreach(auth()->user()->customer->wallets as $wallet)
                                    <option value="{{ $wallet->uuid }}">{!! \App\Helpers\Customer\Wallet::formatNameAccountForSelect($wallet) !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <x-form.input
                            name="amount"
                            type="text"
                            label="Montant à crédité"
                            required="true"
                            text="Format: 0.00" />
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Alimentez mon compte</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("script")

@endsection

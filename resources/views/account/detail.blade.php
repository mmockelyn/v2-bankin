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
                <h1 class="d-flex text-white fw-bolder my-1 fs-1">Compte Courant</h1>
                <span class="fs-5 my-1 text-white">{{ $wallet->number_account }} {{ $wallet->agency->name }}</span>
                <!--end::Title-->
            </div>
            <div class="d-flex flex-column justify-content-center align-items-center">
                @if($wallet->balance >= 0)
                    <span
                        class="fs-2x text-success fw-bold bg-light-success rounded-3 p-1">+ {{ eur($wallet->balance) }}</span>
                @else
                    <span
                        class="fs-2x text-danger fw-bold bg-light-danger rounded-3 p-1">{{ eur($wallet->balance) }}</span>
                @endif
                <span class="text-white pt-2">Solde Actuel</span>
            </div>
            <!--end::Page title-->
            <div class="d-flex flex-column justify-content-end align-items-end text-white">
                <table class="table text-white fs-4">
                    <tbody>
                    <tr>
                        <td>Prochaine Opérations:</td>
                        <td class="text-end">{{ eur($wallet->balance_coming) }}</td>
                    </tr>
                    <tr>
                        <td>Titulaire:</td>
                        <td class="text-end">{{ $wallet->customer->friendlyName }}</td>
                    </tr>
                    <tr>
                        <td>Découvert Autorisée:</td>
                        <td class="text-end">{{ eur($wallet->outstanding) }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
@endsection

@section("content")
    <div class="row">
        <div class="col-md-9 col-sm-12">
            <!--begin::Main wrapper-->
            <div
                id="kt_docs_search_handler_basic"

                data-kt-search-keypress="false"
                data-kt-search-min-length="2"
                data-kt-search-enter="true"
                data-kt-search-layout="inline">

                <!--begin::Input Form-->
                <form data-kt-search-element="form" class="w-100 position-relative mb-5" autocomplete="off"
                      action="{{ route('account.detail', $wallet->uuid) }}">
                    <!--begin::Hidden input(Added to disable form autocomplete)-->
                    <input type="hidden"/>
                    <!--end::Hidden input-->

                    <!--begin::Icon-->
                    <span
                        class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-gray-500 position-absolute top-50 ms-5 translate-middle-y">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                  transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
							<path
                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                fill="black"></path>
						</svg>
					</span>
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <!--end::Icon-->

                    <!--begin::Input-->
                    <input type="text" class="form-control form-control-lg form-control-solid px-15"
                           name="q"
                           value=""
                           placeholder="Rechercher une opération..."
                           data-kt-search-element="input"/>
                    <!--end::Input-->

                    <!--begin::Spinner-->
                    <span class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-5"
                          data-kt-search-element="spinner">
                        <span class="spinner-border h-15px w-15px align-middle text-gray-400"></span>
                    </span>
                    <!--end::Spinner-->

                    <!--begin::Reset-->
                    <span
                        class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 me-5 d-none"
                        data-kt-search-element="clear">

                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    </span>
                    <!--end::Reset-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Main wrapper-->

            <div class="table-responsive mt-10">
                <!--begin::Table-->
                <table class="table align-middle gs-0 gy-5" id="listTransactions">
                    <!--begin::Table head-->
                    <thead>
                    <tr>
                        <th class="p-0 w-50px"></th>
                        <th class="p-0 min-w-150px"></th>
                        <th class="p-0 min-w-150px"></th>
                        <th class="p-0 min-w-125px"></th>
                        <th class="p-0 min-w-40px"></th>
                    </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>
                                <div class="symbol symbol-circle symbol-50px">
                                    <div class="symbol-label bg-{{ $transaction->category->color }}">
                                        <!--<img src="/metronic8/demo1/assets/media/svg/brand-logos/plurk.svg" class="h-50 align-self-center" alt="">-->
                                        <i class="fas {{ $transaction->category->icon }} fa-lg text-white align-self-center"></i>
                                    </div>
                                    @if($transaction->confirmed == 0)
                                        <span class="symbol-badge badge badge-circle bg-warning start-50 top-0"
                                              data-bs-toggle="tooltip" title="A Venir"><i
                                                class="fas fa-exclamation fs-10 text-white"></i></span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <a href="#"
                                   class="text-dark fw-bolder text-hover-primary mb-1 fs-6 show" data-transaction="{{ $transaction->uuid }}">{{ $transaction->name }}</a>
                                <span
                                    class="text-muted fw-bold d-block fs-7">{{ $transaction->created_at->format('j F Y') }}</span>
                            </td>
                            <td class="text-end">
                                <span
                                    class="badge badge-light-danger fw-bold me-1">{{ $transaction->category->name }}</span>
                                <span
                                    class="badge badge-light-info fw-bold me-1">{{ $transaction->subcategory->name }}</span>
                            </td>
                            <td class="text-end">
                                @if($transaction->amount >= 0)
                                    <span
                                        class="badge badge-lg badge-success text-light-success fw-bold">+ {{ eur($transaction->amount) }}</span>
                                @else
                                    <span
                                        class="badge badge-lg badge-danger text-light-danger fw-bold">{{ eur($transaction->amount) }}</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <button  class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary show" data-transaction="{{ $transaction->uuid }}">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                    <span class="svg-icon svg-icon-2">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none">
										<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1"
                                              transform="rotate(-180 18 13)" fill="black"></rect>
										<path
                                            d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                            fill="black"></path>
									</svg>
								</span>
                                    <!--end::Svg Icon-->
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
        </div>
        <div class="col-md-3 col-sm-12">
            <div class="card shadow-sm bg-gray-100">
                <div class="card-header">
                    <h3 class="card-title">Gérer</h3>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div class="me-auto">Afficher RIB/IBAN</div>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div class="me-auto">Faire un virement depuis ce compte</div>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div class="me-auto">Faire un virement vers ce compte</div>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div class="me-auto">Télécharger les opérations</div>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                        @if($wallet->customer->package->overdraft == 1)
                            <a href="{{ route('account.subscribe.overdraft') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div class="me-auto">Demander un découvert</div>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="view_transpac">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white">
                        Modal title
                    </h5>


                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x svg-icon-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
								<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
							</svg>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <div class="d-flex flex-center mb-15">
                        <div class="fs-2tx text-success badge badge-light-success rounded-3" id="amount">+ 20,00 €</div>
                    </div>
                    <div class="d-flex flex-row justify-content-between fs-4 mb-5">
                        <span class="fw-bold">Type</span>
                        <span id="type">Retrait du compte</span>
                    </div>
                    <div class="d-flex flex-row justify-content-between fs-4 mb-5">
                        <span class="fw-bold">Référence</span>
                        <span id="reference">uuid</span>
                    </div>
                    <div class="d-flex flex-row justify-content-between fs-4 mb-5">
                        <span class="fw-bold">Etat</span>
                        <span id="status">Exécuter</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="view_iban">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white">
                        Modal title
                    </h5>


                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x svg-icon-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
								<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
							</svg>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <div class="d-flex flex-center mb-15">
                        <div class="fs-2tx text-success badge badge-light-success rounded-3" id="amount">+ 20,00 €</div>
                    </div>
                    <div class="d-flex flex-row justify-content-between fs-4 mb-5">
                        <span class="fw-bold">Type</span>
                        <span id="type">Retrait du compte</span>
                    </div>
                    <div class="d-flex flex-row justify-content-between fs-4 mb-5">
                        <span class="fw-bold">Référence</span>
                        <span id="reference">uuid</span>
                    </div>
                    <div class="d-flex flex-row justify-content-between fs-4 mb-5">
                        <span class="fw-bold">Etat</span>
                        <span id="status">Exécuter</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    @include("scripts.account.detail")
@endsection

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
                <h1 class="d-flex text-white fw-bolder my-1 fs-3">Transmission de document</h1>
                <!--end::Title-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
@endsection

@section("content")
    <div class="alert alert-dismissible bg-light border border-bank border-3 border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10">
        <!--begin::Icon-->
        <!--begin::Svg Icon | path: icons/duotune/general/gen007.svg-->
        <span class="svg-icon svg-icon-2hx svg-icon-info me-4 mb-5 mb-sm-0">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
				<path opacity="0.3" d="M12 22C13.6569 22 15 20.6569 15 19C15 17.3431 13.6569 16 12 16C10.3431 16 9 17.3431 9 19C9 20.6569 10.3431 22 12 22Z" fill="currentColor"></path>
				<path d="M19 15V18C19 18.6 18.6 19 18 19H6C5.4 19 5 18.6 5 18V15C6.1 15 7 14.1 7 13V10C7 7.6 8.7 5.6 11 5.1V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V5.1C15.3 5.6 17 7.6 17 10V13C17 14.1 17.9 15 19 15ZM11 10C11 9.4 11.4 9 12 9C12.6 9 13 8.6 13 8C13 7.4 12.6 7 12 7C10.3 7 9 8.3 9 10C9 10.6 9.4 11 10 11C10.6 11 11 10.6 11 10Z" fill="currentColor"></path>
			</svg>
		</span>
        <!--end::Svg Icon-->
        <!--end::Icon-->
        <!--begin::Content-->
        <div class="d-flex flex-column pe-0 pe-sm-10">
            <h5 class="mb-1">Information</h5>
            <span>Vous trouverez ci-dessous la liste des documents à transmettre à la demande de votre banque.</span>
        </div>
        <!--end::Content-->
        <!--begin::Close-->
        <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
            <i class="bi bi-x fs-1"></i>
        </button>
        <!--end::Close-->
    </div>

    <div class="card shadow-lg">
        <div class="card-header bg-bank">
            <h3 class="card-title text-white">Liste des documents à transmettre</h3>
        </div>
        <div class="card-body">
            <table class="table border gy-7 gs-7">
                @if($documents->count() == 0)
                <tr>
                    <td class="text-center">Vous n'avez aucun document à transmettre.</td>
                </tr>
                @else
                    @foreach($documents as $document)
                        <tr>
                            <td>
                                <div class="">{{ $document->type_document }}</div>
                                @isset($document->commentaire)
                                <div class="">{{ $document->commentaire }}</div>
                                @endisset
                            </td>
                            <td>
                                <button class="btn btn-circle btn-icon btn-light btnShowModal" data-document-id="{{ $document->id }}"><i class="fa-solid fa-file-arrow-up" data-document-id="{{ $document->id }}"></i> </button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </table>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="modalTransfer">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Transfère d'un document demander par votre agence</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark fa-lg"></i>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="{{ route('account.document.postDocument') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="document_transmiss_id" value="">
                    <div class="modal-body">
                        <div class="">Votre agence vous demandes les documents suivants: </div>
                        <div class="mb-5" id="document_type"></div>
                        <x-form.input
                            name="file"
                            type="file"
                            required="true" />
                    </div>

                    <div class="modal-footer ">
                        <button type="submit" class="btn btn-bank w-100">Envoyer les documents</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("script")
    @include("scripts.account.document.transmiss")
@endsection

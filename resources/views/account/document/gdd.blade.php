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
                <h1 class="d-flex text-white fw-bolder my-1 fs-3">Documents Electroniques</h1>
                <!--end::Title-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
@endsection

@section("content")
    <div class="container-fluid">
        <div class="d-flex flex-column flex-lg-row">
            <div class="flex-column flex-lg-row-auto w-100 w-lg-275px mb-10 mb-lg-0">
                <div class="card card-flush mb-0">
                    <div class="card-header">
                        <div class="card-title">Document</div>
                    </div>
                    <div class="card-body">
                        <div class="menu menu-column menu-rounded menu-state-bg menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary mb-10">
                            @foreach($categories as $category)
                            <!--begin::Menu item-->
                            <div class="menu-item mb-3 text-dark">
                                <!--begin::Inbox-->
                                <a class="menu-link" data-category="{{ $category->id }}">
									<span class="menu-icon">
										<!--begin::Svg Icon | path: icons/duotune/communication/com010.svg-->
										<i class="fa-regular fa-folder-open fa-xl" data-category="{{ $category->id }}"></i>
                                        <!--end::Svg Icon-->
									</span>
									<span class="menu-title fw-bolder" data-category="{{ $category->id }}">{{ $category->name }}</span>
								</a>
                                <!--end::Inbox-->
                            </div>
                            <!--end::Menu item-->
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
                <div class="card card-flush mb-0">
                    <div class="card-body scroll h-500px" id="showDocument">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    @include("scripts.account.document.gdd")
@endsection

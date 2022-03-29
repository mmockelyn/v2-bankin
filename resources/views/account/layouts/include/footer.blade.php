<!--begin::Footer-->
<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
    <!--begin::Container-->
    <div class="container-xxl d-flex flex-column flex-md-row align-items-center justify-content-between">
        <!--begin::Copyright-->
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted fw-bold me-1">2022©</span>
            <a href="{{ config('app.url') }}" target="_blank" class="text-gray-800 text-hover-primary">{{ config('app.name') }}</a>
        </div>
        <!--end::Copyright-->
        <!--begin::Menu-->
        <ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
            <li class="menu-item">
                @if(config('app.env') == 'local' || config('app.env') == 'testing')
                    <span class="menu-link text-danger">Version: {{ \App\Services\Github::latestMasterVersion() }}</span>
                @else
                    <span class="menu-link text-success">Version: {{ config('app.version') }}</span>
                @endif
            </li>
        </ul>
        <!--end::Menu-->
    </div>
    <!--end::Container-->
</div>
<!--end::Footer-->

<div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: true, lg: true}" data-kt-sticky-name="app-header-minimize" data-kt-sticky-offset="{default: '200px', lg: '300px'}" data-kt-sticky-animation="false">
    <div class="app-container container-fluid d-flex align-items-stretch flex-stack" id="kt_app_header_container">
        <div class="d-flex align-items-center d-lg-none">
            <button id="kt_app_sidebar_mobile_toggle" class="btn btn-icon btn-color-gray-500 btn-active-color-primary ms-n4 me-1">
                <i class="ki-outline ki-burger-menu-6 fs-2x"></i>
            </button>
            <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0 me-lg-15">
                <a href="index.html">
                    <img alt="Logo" src="{{ asset('client/assets/img/pegawai.png') }}" class="h-30px" />
                </a>
            </div>
            <div class="d-flex align-items-center d-lg-none ms-2" title="Show sidebar menu">
                <div class="btn btn-icon btn-color-white bg-white bg-opacity-0 bg-hover-opacity-10 w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
                    <i class="ki-outline ki-abstract-14 fs-2"></i>
                </div>
            </div>
        </div>
        @yield('header')
    </div>
</div>

<div class="app-sidebar-primary">
    <div class="app-sidebar-logo d-none d-md-flex flex-center pt-10 pb-10" id="kt_app_sidebar_logo">
        <a href="{{ route('admin.simpeg') }}">
            <img alt="Logo" src="{{ asset('client/assets/img/pegawai.png') }}" class="h-30px" />
        </a>
    </div>
    <div class="app-sidebar-menu flex-grow-1 hover-scroll-y scroll-ms my-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px">
        <div id="kt_aside_menu" class="menu menu-column menu-title-gray-600 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-semibold fs-6" data-kt-menu="true">
            <div class="menu-item @yield('home') py-2">
                <a href="{{ route('admin.simpeg') }}" class="menu-link menu-center">
                    <span class="menu-icon me-0">
                        <i class="ki-outline ki-home-1 fs-2"></i>
                    </span>
                </a>
                <div class="menu-sub menu-sub-dropdown px-2 py-4 w-250px mh-75 overflow-auto">
                    <div class="menu-item">
                        <div class="menu-content">
                            <span class="menu-section fs-5 fw-bolder ps-1 py-1">Home</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="menu-item @yield('bidang') py-2">
                <a href="{{ route('bidang.index') }}" class="menu-link menu-center">
                    <span class="menu-icon me-0">
                        <i class="ki-outline ki-bank fs-2"></i>
                    </span>
                </a>
                <div class="menu-sub menu-sub-dropdown menu-sub-indention px-2 py-4 w-250px mh-75 overflow-auto">
                    <div class="menu-item">
                        <div class="menu-content">
                            <span class="menu-section fs-5 fw-bolder ps-1 py-1">Bidang</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="menu-item @yield('pegawai') py-2">
                <a href="{{ route('pegawai.index') }}" class="menu-link menu-center">
                    <span class="menu-icon me-0">
                        <i class="ki-outline ki-people fs-2"></i>
                    </span>
                </a>
                <div class="menu-sub menu-sub-dropdown menu-sub-indention px-2 py-4 w-250px mh-75 overflow-auto">
                    <div class="menu-item">
                        <div class="menu-content">
                            <span class="menu-section fs-5 fw-bolder ps-1 py-1">Pegawai</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column flex-center pb-4 pb-lg-8" id="kt_app_sidebar_footer">
        <div class="cursor-pointer symbol symbol-40px symbol-circle mb-9" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-attach="parent" data-kt-menu-placement="right-end">
            <img src="{{ asset('assets/media/avatars/blank.png') }}" alt="user" />
        </div>
        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
            <div class="menu-item px-3">
                <div class="menu-content d-flex align-items-center px-3">
                    <div class="symbol symbol-50px me-5">
                        <img alt="Logo" src="{{ asset('client/assets/img/pegawai.png') }}" />
                    </div>
                    <div class="d-flex flex-column">
                        <div class="fw-bold d-flex align-items-center fs-5">{{ Str::limit(Auth::user()->nama, 20, '...') }}
                        <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">{{ Auth::user()->role }}</span></div>
                        <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">{{ Str::limit(Auth::user()->email, 20, '...') }}</a>
                    </div>
                </div>
            </div>
            <div class="separator my-2"></div>
            <div class="menu-item px-5">
                <a href="#" class="menu-link px-5">My Profile</a>
            </div>
        </div>
        <div class="app-navbar-item">
            <a href="{{ route('logout') }}" class="">
                <i class="ki-outline ki-exit-right fs-2"></i>
            </a>
        </div>
    </div>
</div>

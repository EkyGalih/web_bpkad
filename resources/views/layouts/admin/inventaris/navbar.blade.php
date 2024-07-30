<!--begin::Menu wrapper-->
<div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
</div>
<div class="app-navbar flex-shrink-0">
    <div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
        <div class="cursor-pointer symbol symbol-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
            <img src="{{ asset(auth()->user()->avatar) }}" class="rounded-3" alt="user" />
        </div>
        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
            <div class="menu-item px-3">
                <div class="menu-content d-flex align-items-center px-3">
                    <div class="symbol symbol-50px me-5">
                        <img alt="Logo" src="{{ asset(auth()->user()->avatar) }}" />
                    </div>
                    <div class="d-flex flex-column">
                        <div class="fw-bold d-flex align-items-center fs-5">{{ Str::limit(auth()->user()->nama, 10), '...' }}
                        <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">{{ strtoupper(auth()->user()->role) }}</span></div>
                        <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">{{ Str::limit(auth()->user()->email, 20), '...' }}</a>
                    </div>
                </div>
            </div>
            <div class="separator my-2"></div>
            <div class="menu-item px-5">
                <a href="{{ route('profile', Auth::user()->id) }}" class="menu-link px-5">My Profile</a>
            </div>
            <div class="separator my-2"></div>
            <div class="menu-item px-5">
                <a href="{{ route('logout') }}" class="menu-link px-5">Sign Out</a>
            </div>
        </div>
    </div>
    <div class="app-navbar-item d-lg-none ms-2 me-n2" title="Show header menu">
        <div class="btn btn-flex btn-icon btn-active-color-primary w-30px h-30px" id="kt_app_header_menu_toggle">
            <i class="ki-duotone ki-element-4 fs-1">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
    </div>
</div>

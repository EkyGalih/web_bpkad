<nav class="layout-navbar shadow-none py-0">
    <div class="container">
        <div class="navbar navbar-expand-lg landing-navbar px-3 px-md-8">
            <div class="navbar-brand app-brand demo d-flex py-0 me-4 me-xl-8">
                <button class="navbar-toggler border-0 px-0 me-4" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <i class="icon-base ri ri-menu-fill icon-lg align-middle text-heading fw-medium"></i>
                </button>
                <a href="landing-page.html" class="app-brand-link">
                    <img src="{{ asset('uploads/profile/favicon.png') }}" class="img-thumbnail" style="height: 50px;"
                        alt="Logo">
                </a>
            </div>
            <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
                <button class="navbar-toggler border-0 text-heading position-absolute end-0 top-0 p-2" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="icon-base ri ri-close-fill"></i>
                </button>
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link fw-medium @yield('menu-beranda')" aria-current="page"
                            href="{{ route('sso.dashboard') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium @yield('menu-user')" href="{{ route('pengguna') }}">Manajemen
                            User</a>
                    </li>
                </ul>
            </div>
            <div class="landing-menu-overlay d-lg-none"></div>
            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Style Switcher -->
                <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                    <a class="nav-link dropdown-toggle hide-arrow me-sm-2" id="nav-theme" href="javascript:void(0);"
                        data-bs-toggle="dropdown">
                        <i class="icon-base ri ri-sun-line icon-24px theme-icon-active"></i>
                        <span class="d-none ms-2" id="nav-theme-text">Toggle theme</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="nav-theme-text">
                        <li>
                            <button type="button" class="dropdown-item align-items-center active"
                                data-bs-theme-value="light" aria-pressed="false">
                                <span><i class="icon-base ri ri-sun-line icon-24px me-3"
                                        data-icon="sun-line"></i>Light</span>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="dropdown-item align-items-center" data-bs-theme-value="dark"
                                aria-pressed="true">
                                <span><i class="icon-base ri ri-moon-clear-line icon-24px me-3"
                                        data-icon="moon-clear-line"></i>Dark</span>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="dropdown-item align-items-center" data-bs-theme-value="system"
                                aria-pressed="false">
                                <span><i class="icon-base ri ri-computer-line icon-24px me-3"
                                        data-icon="computer-line"></i>System</span>
                            </button>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            <img src="{{ asset(Auth::user()->avatar) }}" alt="avatar" class="rounded-circle" />
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end mt-3 py-2">
                        <li>
                            <a class="dropdown-item" href="pages-account-settings-account.html">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-2">
                                        <div class="avatar avatar-online">
                                            <img src="{{ asset(Auth::user()->avatar) }}" alt="alt"
                                                class="w-px-40 h-auto rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0 small">{{ Auth::user()->nama }}</h6>
                                        <small class="text-body-secondary">{{ Auth::user()->role }}</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                            <a class="dropdown-item" href="{{ route('profile', Auth::user()->id) }}">
                                <i class="icon-base ri ri-user-3-line icon-22px me-3"></i><span class="align-middle">My
                                    Profile</span>
                            </a>
                            @elseif (Auth::user()->role == 'operator')
                            <a class="dropdown-item" href="{{ route('profile-op', Auth::user()->id) }}">
                                <i class="icon-base ri ri-user-3-line icon-22px me-3"></i><span class="align-middle">My
                                    Profile</span>
                            </a>
                            @endif
                        </li>
                        {{-- <li>
                            <a class="dropdown-item" href="pages-account-settings-account.html">
                                <i class="icon-base ri ri-settings-4-line icon-22px me-3"></i><span
                                    class="align-middle">Settings</span>
                            </a>
                        </li> --}}
                        <li>
                            <div class="d-grid px-4 pt-2 pb-1">
                                <a class="btn btn-sm btn-danger d-flex" href="{{ route('logout') }}">
                                    <small class="align-middle">Logout</small>
                                    <i class="icon-base ri ri-logout-box-r-line ms-2 icon-16px"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
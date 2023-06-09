<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

        <h1 class="logo mr-auto"><a href="{{ '/' }}"><img src="{{ asset('uploads/profile/favicon.png') }}"
                    alt=""> {{ env('APP_NAME') }}<span> NTB</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt=""></a>-->

        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class="@yield('menu-beranda')"><a href="{{ route('sso.dashboard') }}">Beranda</a></li>
                <li class="@yield('menu-user')"><a href="{{ route('pengguna') }}">Manajemen User</a></li>
                <li class="drop-down">
                    <a href="#">Pengaturan</a>
                    <ul>
                        <div class="user-box">
                            <div>
                                <img class="img-avatar" src="{{ asset(Auth::user()->avatar) }}">
                            </div>
                            <div class="u-text">
                                <h4><i class="bx bx-user-pin"></i> {{ Auth::user()->nama }}</h4>
                                <p class="text-muted"><i class="bx bx-envelope"></i> {{ Auth::user()->email }}</p>

                            </div>
                        </div>
                        <li>
                            @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                            <a href="{{ route('profile', Auth::user()->id) }}"><i class="bx bx-user"></i> Profile</a>
                            @elseif (Auth::user()->role == 'operator')
                            <a href="{{ route('profile-op', Auth::user()->id) }}"><i class="bx bx-user"></i> Profile</a>
                            @endif
                        </li>
                        <li><a href="{{ route('logout') }}"><i class="bx bx-log-out"></i> keluar</a></li>
                    </ul>
                </li>
            </ul>
        </nav><!-- .nav-menu -->

    </div>
</header>

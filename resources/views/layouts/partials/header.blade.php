<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

        <h1 class="logo mr-auto"><a href="{{'/'}}"><img src="{{asset('uploads/profile/favicon.png')}}" alt=""> {{ env('APP_NAME') }}<span> NTB</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt=""></a>-->

        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class="@yield('menu-beranda')"><a href="{{route('sso.dashboard')}}">Beranda</a></li>
                <li class="@yield('menu-user')"><a href="{{ route('pengguna') }}">Manajemen User</a></li>
                <li class="drop-down">
                    <a href="#">Pengaturan</a>
                    <ul>
                        <div class="user-box">
                            <div class="avatar-lg">
                                <img src="data:image/png;base64,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" alt="image profile" class="avatar-img rounded">
                            </div>
                            <div class="u-text">
                                <h4>{{ Auth::user()->nama }}</h4>
                                <p class="text-muted">{{ Auth::user()->email }}</p>

                            </div>
                        </div>
                        <li><a href="{{ route('profile', Auth::user()->id) }}">Profile</a></li>
                        <li><a href="{{ env('WEB_BPKAD_LOGOUT') }}">keluar</a></li>
                    </ul>
                </li>
            </ul>
        </nav><!-- .nav-menu -->

    </div>
</header>

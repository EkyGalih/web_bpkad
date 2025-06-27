<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('title') {{ $settings->title }}</title>
    @include('layouts.client.css')
</head>

<body>
    <div class="content-wrapper">
        <header class="wrapper bg-soft-primary">
            <nav class="navbar navbar-expand-lg center-logo transparent position-absolute navbar-dark">
                <div class="container justify-content-between align-items-center">
                    <div class="container justify-content-between align-items-center">
                        <div class="d-flex flex-row w-100 justify-content-between align-items-center d-lg-none">
                            <div class="navbar-brand"><a href="{{ url('/') }}">
                                    <div style="background: rgba(255,255,255,0.8); border-radius: 6px; padding: 4px 8px; display: inline-block;">
                                        <img style="height: 40px; width: 100px;" class="logo-dark" src="{{ asset($settings->logo_image) }}"
                                            srcset="{{ asset($settings->logo_image) }}" alt="" />
                                        <img style="height: 40px; width: 100px;" class="logo-light" src="{{ asset($settings->logo_image) }}"
                                            srcset="{{ asset($settings->logo_image) }}" alt="" />
                                    </div>
                                </a></div>
                            <div class="navbar-other ms-auto">
                                <ul class="navbar-nav flex-row align-items-center">
                                    <li class="nav-item d-lg-none">
                                        <button class="hamburger offcanvas-nav-btn"><span></span></button>
                                    </li>
                                </ul>
                                <!-- /.navbar-nav -->
                            </div>
                            <!-- /.navbar-other -->
                        </div>
                        @include('layouts.client.header')
                    </div>
            </nav>
            @yield('content_home')
            {{-- <main id="main">
                @yield('content')
            </main> --}}
        </header>
    </div>
    @include('layouts.client.footer')
    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
    @include('layouts.client.js')
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title') | BPKAD (Badan Pengelolaan Keuangan dan Aset Daerah</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    @include('layouts.partials.css')
</head>
<body>
    <div id="topbar" class="d-none d-lg-flex align-items-center fixed-top">
        <div class="container d-flex">
            <div class="contact-info mr-auto">
                <i class="icofont-dashboard"></i> Landing Pages
            </div>
        </div>
    </div>
    @include('layouts.partials.header')
    @yield('content_home')
    <main id="main">
        @yield('content')
    </main>
    @include('layouts.partials.footer')
    <div id="preloader"></div>
    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
    @include('layouts.partials.js')
</body>
</html>

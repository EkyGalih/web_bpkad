<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title') BPKAD Prov. NTB</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    @include('layouts.client.css')
</head>

<body>
    <div id="topbar" class="d-none d-lg-flex align-items-center fixed-top">
        <div class="container d-flex">

        </div>
    </div>
    @include('layouts.client.header')
    @yield('content_home')
    <main id="main">
        @yield('content')
    </main>
    @include('layouts.client.footer')
    <div id="preloader"></div>
    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
    @include('layouts.client.js')
</body>

</html>

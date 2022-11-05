<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title') | BPKAD (Badan Pengelolaan Keuangan dan Aset Daerah</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    @include('layouts.client.css')
</head>
<body>
<div id="topbar" class="d-none d-lg-flex align-items-center fixed-top">
    <div class="container d-flex">
        <div class="contact-info mr-auto">
            <i class="icofont-envelope"></i> <a href="mailto:prog.bpkad.ntb@gmail.com">prog.bpkad.ntb@gmail.com</a>
            <i class="icofont-phone"></i> (0370) 627689
        </div>
        <div class="social-links">
            <a href="https://twitter.com/BpkadNtb" target="_blank" class="twitter"><i class="icofont-twitter"></i></a>
            <a href="https://www.facebook.com/bpkadntbprov" target="_blank" class="facebook"><i class="icofont-facebook"></i></a>
            <a href="https://www.instagram.com/ntbbpkad/" target="_blank" class="instagram"><i class="icofont-instagram"></i></a>
            <a href="https://www.youtube.com/channel/UCZ-UDCXEyRvOJfdWtD2jv5g" target="_blank" class="youtube"><i class="icofont-youtube"></i></a>
            <a href="https://wa.me/message/47I56AXXZMGWB1" target="_blank" class="whatsapp"><i class="icofont-whatsapp"></i></i></a>
        </div>
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

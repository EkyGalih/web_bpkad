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
    <script src="{{ asset('server/assets/vendor/js/dropdown-hover.js') }}"></script>
    <script src="{{ asset('server/assets/vendor/js/mega-dropdown.js') }}"></script>
    @include('layouts.partials.header')
    <div data-bs-spy="scroll" class="scrollspy-example">
        @yield('content_home')
    </div>
    @include('layouts.partials.footer')
    {{-- <div id="preloader"></div> --}}
    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
    @include('layouts.partials.js')
</body>

</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="layout-navbar-fixed layout-menu-fixed layout-compact">


<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title') - Admin Website BPKAD</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    @include('layouts.admin.css')
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('layouts.admin.sidebar')
            <div class="layout-page">
                @include('layouts.admin.header')
                <div class="content-wrapper">
                    @yield('content')
                </div>
                @include('layouts.admin.footer')
            </div>
        </div>
    </div>
    @include('layouts.admin.js')
</body>

</html>

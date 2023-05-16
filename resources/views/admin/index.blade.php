<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title') - Admin Website BPKAD</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    @include('layouts.admin.css')
</head>

<body>
    @include('layouts.admin.header')
    @include('layouts.admin.sidebar')
    @include('layouts.admin.content')
    @include('layouts.admin.footer')
    @include('layouts.admin.js')
</body>

</html>

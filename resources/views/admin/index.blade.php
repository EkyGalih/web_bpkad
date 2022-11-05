<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>@yield('title') | Admin BPKAD</title>
    @include('layouts.admin.css')
</head>
<body>
<section id="container">
    @include('layouts.admin.header')
    <aside>
        @include('layouts.admin.sidebar')
    </aside>
    <section id="main-content">
        @include('layouts.admin.content')
    </section>
</section>
@include('layouts.admin.footer')
@include('layouts.admin.js')
</body>
</html>

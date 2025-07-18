<link href="{{ asset('static/images/ntb.png') }}" type="image/png" rel="shortcut icon">
<link href="{{ asset('static/images/ntb.png') }}" type="image/png" rel="icon">
<link href="{{ asset('static/images/ntb.png') }}" type="image/png" rel="apple-touch-icon">
<link rel="stylesheet" href="{{ asset('client/assets/css/plugins.css') }}">
<link rel="stylesheet" href="{{ asset('client/assets/css/style.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('client/assets/css/colors/violet.css') }}"> --}}
<link rel="preload" href="{{ asset('client/assets/css/fonts/urbanist.css') }}" as="style"
    onload="this.rel='stylesheet'">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Meta and SEO -->
<meta name="description" content="Website resmi Badan Pengelolaan Keuangan dan Aset Daerah Provinsi NTB">
<meta name="keywords" content="bpkad, keuangan, aset, pemerintah, gov, pemda">
<meta name="author" content="ITeam BPKAD NTB">
<meta name="robots" content="">
<link rel="canonical" href="https://bpkad.ntbprov.go.id/">
<style>
    /* Blur Menu */
    .blur-ul {
        display: flex;
        gap: 2.5 rem;
    }

    .blur-ul {
        display: block;
        transition: .5s;
    }

    .blur-ul:hover .blur-li {
        filter: blur(5px);
    }

    .blur-ul .blur-li:hover {
        filter: blur(0px);
    }
</style>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-NV9MEZT0B3"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-NV9MEZT0B3');
</script>
@yield('additional-css')

<link href="{{ asset('client/assets/img/favicon.png') }}" rel="icon">
<link href="{{ asset('client/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
<link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">
<link href="{{ asset('client/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('client/assets/vendor/bootstrap/js/bootstrap.min.js') }}">
<link href="{{ asset('client/assets/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
<link href="{{ asset('client/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
<link href="{{ asset('client/assets/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
<link href="{{ asset('client/assets/vendor/venobox/venobox.css') }}" rel="stylesheet">
<link href="{{ asset('client/assets/vendor/aos/aos.css') }}" rel="stylesheet">
<link href="{{ asset('client/assets/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('client/assets/css/bpkad.css') }}" rel="stylesheet">
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
    .blur-ul .blur-li:hover{
        filter: blur(0px);
    }
</style>
@yield('additional-css')

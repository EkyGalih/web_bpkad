<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $settings->title }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('server/img/apps.png') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bpkad.css') }}">
</head>

<body>
    <!-- Video Background -->
    <video class="video-bg" autoplay muted loop playsinline>
        <source src="{{ asset('video/background.mp4') }}" type="video/mp4">
        Browser Anda tidak mendukung video.
    </video>

    <!-- Overlay (optional) -->
    <div class="overlay"></div>
    <h1 class="title">Selamat Datang di Dashboard Aplikasi BPKAD</h1>
    <div class="radial-menu">
        <button class="center-btn" id="menuToggle">
            <h1 class="btn-title">APPS</h1>
        </button>

        <!-- Menu Items -->
        <a href="{{ env('WEB_BPKAD_ADMIN') }}" class="item web" data-tooltip="Website BPKAD" data-placement="top"></a>
        <a href="{{ env('SIMPEG_ADMIN') }}" class="item simpeg" data-tooltip="SIMPEG"
            data-placement="right"></a>
        <a href="{{ env('APBD_ADMIN') }}" class="item lkpd" data-tooltip="APBD" data-placement="bottom"></a>
        <a href="#" class="item settings" data-tooltip="Settings" data-placement="left"></a>
    </div>
    <script>
        document.getElementById("menuToggle").addEventListener("click", function() {
            document.querySelector(".radial-menu").classList.toggle("active");
        });
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $settings->title }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('server/img/apps.png') }}" />
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: sans-serif;
            overflow: hidden;
        }

        .video-bg {
            position: fixed;
            top: 0;
            left: 0;
            min-width: 100%;
            min-height: 100%;
            z-index: -2;
            object-fit: cover;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: -1;
        }

        .radial-menu {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 240px;
            height: 240px;
        }

        .center-btn {
            width: 240px;
            height: 240px;
            border-radius: 50%;
            background-image: url('{{ asset('server/img/apps.png') }}');
            background-size: cover;
            background-position: center;
            color: white;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.35);
            position: absolute;
            top: 0;
            left: 0;
            z-index: 2;
        }

        .item {
            position: absolute;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transform: scale(0);
            transition: all 0.4s ease;
            background-size: cover;
            background-position: center;
            text-decoration: none;
            font-size: 32px;
            color: white;
        }

        .item.web {
            background-image: url('https://storage.ntbprov.go.id/bpkad/uploads/defaults/logo_bpkad.png');
        }

        .item.simpeg {
            background-image: url('{{ asset('server/img/simpeg.png') }}');
        }

        .item.lkpd {
            background-image: url('{{ asset('server/img/lkpd-logo.png') }}');
        }

        .radial-menu:hover .item {
            opacity: 1;
            transform: scale(1);
        }

        /* Penempatan melingkar */
        .item:nth-child(2) {
            top: -180px;
            left: 45px;
        }

        .item:nth-child(3) {
            top: 45px;
            left: 270px;
        }

        .item:nth-child(4) {
            top: 270px;
            left: 45px;
        }

        .item:nth-child(5) {
            top: 45px;
            left: -180px;
        }

        .item:hover {
            filter: brightness(1.2);
        }

        .center-btn img {
            width: 80px;
            height: 80px;
        }
    </style>
</head>

<body>
    <!-- Video Background -->
    <video class="video-bg" autoplay muted loop playsinline>
        <source src="{{ asset('video/background.mp4') }}" type="video/mp4">
        Browser Anda tidak mendukung video.
    </video>

    <!-- Overlay (optional) -->
    <div class="overlay"></div>
    <div class="radial-menu">
        <button class="center-btn" id="menuToggle"></button>

        <!-- Menu Items -->
        <a href="{{ env('WEB_BPKAD_ADMIN') }}" class="item web" title="BPKAD">
            <img src="https://storage.ntbprov.go.id/bpkad/uploads/defaults/logo_bpkad.png" alt="{{ $settings->title }}"
                width="50">
        </a>
        <a href="{{ env('SIMPEG_ADMIN') }}" class="item simpeg" title="SimPeg">
            <i class="ri-user-3-line"></i>
        </a>
        <a href="{{ env('APBD_ADMIN') }}" class="item lkpd" title="APBD">
            <i class="ri-folder-3-line"></i>
        </a>
        {{-- <a href="#" class="item web" title="Aset TIK">
            <i class="ri-computer-line"></i>
        </a> --}}
    </div>
    <script>
        document.getElementById("menuToggle").addEventListener("click", function() {
            document.querySelector(".radial-menu").classList.toggle("active");
        });
    </script>
</body>

</html>

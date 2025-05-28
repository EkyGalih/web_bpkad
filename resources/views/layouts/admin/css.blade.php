<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('server/assets/vendor/fonts/iconify-icons.css') }}" />
<link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/node-waves/node-waves.css') }}" />
<link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/pickr/pickr-themes.css') }}" />
<link rel="stylesheet" href="{{ asset('server/assets/vendor/css/core.css') }}" />
<link rel="stylesheet" href="{{ asset('server/assets/css/demo.css') }}" />
<link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
{{-- PAGE --}}
@yield('styles')
<script src="{{ asset('server/assets/vendor/js/helpers.js') }}"></script>
<script src="{{ asset('server/assets/vendor/js/template-customizer.js') }}"></script>
<script src="{{ asset('server/assets/js/config.js') }}"></script>
{{-- Livewire css --}}
@livewireStyles
{{-- <style>
    @-webkit-keyframes blinker {
        from {
            opacity: 1.0;
        }

        to {
            opacity: 0.0;
        }
    }

    .blink {
        text-decoration: blink;
        color: lightcoral;
        background-color: lightyellow;
        font-weight: bold;
        -webkit-animation-name: blinker;
        -webkit-animation-duration: 0.6s;
        -webkit-animation-iteration-count: infinite;
        -webkit-animation-timing-function: ease-in-out;
        -webkit-animation-direction: alternate;
    }

    .badge-new {
        background-color: #ff0000;
        color: #fff;
        font-size: 0.50rem;
        font-weight: bold;
        padding: 0.2rem 0.5rem;
        border-radius: 0.5rem;
        margin-left: 0.5rem;
        animation: blink 2s infinite;
    }

    @keyframes blink {
        50% {
            opacity: 0;
        }
    }
</style> --}}

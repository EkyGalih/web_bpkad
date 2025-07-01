<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap" rel="stylesheet" />
<link rel="icon" type="image/png" href="{{ asset('static/images/favicon.png') }}">
<link rel="stylesheet" href="{{ asset('server/assets/vendor/fonts/iconify-icons.css') }}" />
<link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/node-waves/node-waves.css') }}" />
<link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/pickr/pickr-themes.css') }}" />
<link rel="stylesheet" href="{{ asset('server/assets/vendor/css/core.css') }}" />
<link rel="stylesheet" href="{{ asset('server/assets/css/demo.css') }}" />
<link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
<script src="{{ asset('server/assets/vendor/js/helpers.js') }}"></script>
<script src="{{ asset('server/assets/vendor/js/template-customizer.js') }}"></script>
{{-- PAGE --}}
@yield('styles')
<script src="{{ asset('server/assets/js/config.js') }}"></script>
<script src="{{ asset('css/toastr.min.css') }}"></script>
{{-- Livewire css --}}
@livewireStyles

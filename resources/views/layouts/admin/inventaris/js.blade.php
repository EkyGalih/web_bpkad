<script>
    var hostUrl = "assets/";
</script>
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('js/sweet-alert.min.js') }}"></script>
@include('layouts.sweet-alert-notification')
@yield('scripts')

<script>
    var hostUrl = "assets/";
</script>
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>>
<script src="{{ asset('client/assets/js/sweet-alert.min.js') }}"></script>
<script>
    $(function() {
        $("[data-bs-tooltip='tooltip']").tooltip();
    });
</script>
@include('layouts.sweet-alert-notification')
@yield('scripts')

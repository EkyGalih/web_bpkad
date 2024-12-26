<script src="{{ asset('assets/plugins/global/lkpd/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/lkpd/scripts.bundle.js') }}"></script>>
<script src="{{ asset('client/assets/js/sweet-alert.min.js') }}"></script>
@include('layouts.sweet-alert-notification')
<script>
    $(function() {
         $("[data-bs-tooltip='tooltip']").tooltip();
     });
</script>
@yield('scripts')

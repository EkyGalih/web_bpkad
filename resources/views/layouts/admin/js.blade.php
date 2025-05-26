<script src="{{ asset('server/assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('server/assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('server/assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('server/assets/vendor/libs/node-waves/node-waves.js') }}"></script>
<script src="{{ asset('server/assets/vendor/libs/@algolia/autocomplete-js.js') }}"></script>
<script src="{{ asset('server/assets/vendor/libs/pickr/pickr.js') }}"></script>
<script src="{{ asset('server/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('server/assets/vendor/libs/hammer/hammer.js') }}"></script>
<script src="{{ asset('server/assets/vendor/libs/i18n/i18n.js') }}"></script>
<script src="{{ asset('server/assets/vendor/js/menu.js') }}"></script>
<script src="{{ asset('server/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
<script src="{{ asset('server/assets/vendor/libs/swiper/swiper.js') }}"></script>
<script src="{{ asset('server/assets/js/main.js') }}"></script>
<script src="{{ asset('server/assets/js/dashboards-analytics.js') }}"></script>
<script src="{{ asset('server/js/main.js') }}"></script>
{{-- Livewire js --}}
@livewireScripts
@yield('additional-js')
<script>
    $(document).ready(function() {
         $('.datatables').DataTable();
     });
     $(function() {
         $("[data-bs-tooltip='tooltip']").tooltip();
     });
</script>
@include('layouts.sweet-alert-notification')
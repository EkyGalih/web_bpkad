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
@yield('scripts')
<script src="{{ asset('server/assets/js/main.js') }}"></script>
{{-- Livewire js --}}
@livewireScripts
<script>
    $(document).ready(function() {
        $('.datatables').DataTable();
    });
    $(function() {
        $("[data-bs-tooltip='tooltip']").tooltip();
    });
    document.addEventListener("DOMContentLoaded", function() {
        const layoutPage = document.querySelector('.layout-page');

        window.addEventListener('scroll', function() {
            if (window.scrollY > 0) {
                layoutPage.classList.add('window-scrolled');
            } else {
                layoutPage.classList.remove('window-scrolled');
            }
        });
    });
</script>
<script src="{{ asset('js/sweet-alert.min.js') }}"></script>
<script src="{{ asset('js/toastr.min.js') }}"></script>
@include('layouts.sweet-alert-notification')

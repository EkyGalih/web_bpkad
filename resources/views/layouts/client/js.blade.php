<script src="{{ asset('client/assets/js/plugins.js') }}"></script>
<script src="{{ asset('client/assets/js/theme.js') }}"></script>
@yield('additional-js')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-tooltip="tooltip"]'));
        tooltipTriggerList.forEach(function(tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>

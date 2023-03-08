 <!-- Vendor JS Files -->
 <script src="{{ asset('server/vendor/apexcharts/apexcharts.min.js') }}"></script>
 <script src="{{ asset('server/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
 <script src="{{ asset('server/vendor/chart.js/chart.umd.js') }}"></script>
 <script src="{{ asset('server/vendor/echarts/echarts.min.js') }}"></script>
 <script src="{{ asset('server/vendor/quill/quill.min.js') }}"></script>
 <script src="{{ asset('server/vendor/simple-datatables/simple-datatables.js') }}"></script>
 <script src="{{ asset('server/vendor/tinymce/tinymce.min.js') }}"></script>
 <script src="{{ asset('server/vendor/php-email-form/validate.js') }}"></script>
 <!-- Template Main JS File -->
 <script src="{{ asset('server/js/main.js') }}"></script>
@yield('additional-js')
<script>
$(document).ready(function () {
    $('.datatables').DataTable();
});
$(function () {
    $("[data-bs-tooltip='tooltip']").tooltip();
});
</script>

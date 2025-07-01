@if (Session::has('success') || Session::has('info'))
    <script type="text/javascript">
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: "{!! Session::pull('success') ?: Session::pull('info') !!}",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            customClass: {
                popup: 'p-1',
                title: 'fs-6'
            }
        });
    </script>
    <style>
        .swal2-container {
            z-index: 1200 !important;
        }

        .swal2-toast {
            margin-top: 80px !important;
        }
    </style>
@endif

@if (Session::has('warning') || Session::has('error'))
    <script type="text/javascript">
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: "{!! Session::pull('error') ?: Session::pull('warning') !!}",
            timer: 3000,
            showConfirmButton: false
        });
    </script>
@endif


<script>
    function trashData(url) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data akan di tempatkan di tong sampah!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus sekarang!',
            cancelButtonText: 'Batalkan',
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false,
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke URL hapus
                window.location.href = url;
            }
        });
    }

    function deleteData(url) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang terhapus tidak dapat dikembalikan lagi!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus sekarang!',
            cancelButtonText: 'Batalkan',
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false,
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke URL hapus
                window.location.href = url;
            }
        });
    }

    function changeStatus(url) {
        swal({
            title: 'Apakah Anda Yakin?',
            text: "Perubahan status akan berdampak pada beberapa data",
            icon: 'warning',
            buttons: {
                cancel: {
                    text: 'Batalkan',
                    visible: true,
                    className: 'btn btn-danger'
                },
                confirm: {
                    text: 'Ya, Ganti Status!',
                    className: 'btn btn-success'
                }
            }
        }).then((Change) => {
            if (Change) {
                window.location.href = url;
            } else {
                swal.close();
            }
        });
    }

    function isInputNumber(event) {
        var char = String.fromCharCode(event.which);
        if (!(/[0-9]/).test(char)) {
            event.preventDefault();
        }
    }

    function formatRupiah(element) {
        let value = element.value.replace(/[^,\d]/g, '');
        let parts = value.split(',');
        let integerPart = parts[0];
        let decimalPart = parts[1] ? ',' + parts[1] : '';

        let rupiah = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        element.value = 'Rp ' + rupiah + decimalPart;
    }
</script>

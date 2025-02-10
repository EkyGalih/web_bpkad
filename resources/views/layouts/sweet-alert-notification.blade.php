@if (Session::has('success') || Session::has('info'))
    <script type="text/javascript">
        toastr.success("{!! Session::pull('success') !!}");
    </script>
@endif
@if (Session::has('warning') || Session::has('error'))
    <script type="text/javascript">
        toastr.error("{!! Session::pull('fail') !!}");
    </script>
@endif

<script>
    function deleteData(url) {
        swal({
            title: 'Apakah Anda yakin?',
            text: "Data yang terhapus tidak dapat dikembalikan lagi!",
            icon: 'warning',
            buttons: {
                cancel: {
                    text: 'Batalkan',
                    visible: true,
                    className: 'btn btn-danger'
                },
                confirm: {
                    text: 'Ya, Hapus sekarang!',
                    className: 'btn btn-success'
                }
            }
        }).then((Delete) => {
            if (Delete) {
                window.location.href = url;
            } else {
                swal.close();
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

<script>
    $('#jml_anggaran_sebelum_add').maskMoney({
        precision: 0
    });
    $('#jml_anggaran_setelah_add').maskMoney({
        precision: 0
    });

    $('#jml_anggaran_sebelum_edit').maskMoney({
        precision: 0
    });
    $('#jml_anggaran_setelah_edit').maskMoney({
        precision: 0
    });

    $('#jml_anggaran_setelah_add').on('change', function() {
        split1 = $('#jml_anggaran_sebelum_add').val().split(',');
        split2 = $('#jml_anggaran_setelah_add').val().split(',');
        join1 = split1.join('');
        join2 = split2.join('');

        jumlah_anggaran = parseFloat(join2) - parseFloat(join1);
        persen = (parseFloat(join2) - parseFloat(join1)) / parseFloat(join1);

        $('#selisih_add').val(jumlah_anggaran).maskMoney({
            precision: 0,
            reverse: true,
            translation: {
                '#': {
                    pattern: /\-|\d/,
                    recursive: true
                }
            },
        });
        $('#persen_add').val(parseFloat(persen) * 100);
    });

    function KodeRekeningAdd() {
        var kode_rekening = $('#kode_rekening_add').val();
        $.ajax({
            type: 'GET',
            async: true,
            url: '{{ url('api/kode-rekening/getRekening') }}/' + kode_rekening,
            dataType: 'json',
            success: function(data) {
                var uraian = "<option>Pilih</option>";

                for (a = 0; a < data.length; a++) {
                    if (data[a].kode_rekening.length == 3) {
                        uraian += ["<option value='" + data[a].kode_rekening + "'>[" + data[a]
                            .kode_rekening + "] " + data[a].nama_rekening + "</option>"
                        ];
                    }
                }
                $('#kode_rekening2_add').html("Pilih");
                $('#kode_rekening2_add').append(uraian);
                $('#nama_rekening_add').val(data[0].nama_rekening);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function getSubKodeAdd() {
        var uraian = $('#kode_rekening2_add').val();
        $.ajax({
            type: 'GET',
            async: true,
            url: '{{ url('api/kode-rekening/getRekening') }}/' + uraian,
            dataType: 'json',
            success: function(data) {
                var sub_uraian = "<option>Pilih</option>";

                for (a = 0; a < data.length; a++) {
                    if (data[a].kode_rekening.length == 6) {
                        sub_uraian += ["<option value='" + data[a].kode_rekening + "'>[" + data[a]
                            .kode_rekening + "] " + data[a].nama_rekening + "</option>"
                        ];
                    }
                }
                $('#kode_rekening3_add').html("Pilih");
                $('#kode_rekening3_add').append(sub_uraian);
                $('#uraian_add').val(data[0].nama_rekening);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function getSubUraianAdd() {
        var sub_uraian = $('#kode_rekening3_add').val();
        $.ajax({
            type: 'GET',
            async: true,
            url: '{{ url('api/kode-rekening/getSubRekening') }}/' + sub_uraian,
            dataType: 'json',
            success: function(data) {
                $('#sub_uraian_add').val(data['nama_rekening']);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>

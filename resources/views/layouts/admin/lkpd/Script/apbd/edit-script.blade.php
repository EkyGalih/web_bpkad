<script>
    $('#jml_anggaran_sebelum_edit').maskMoney({
        precision: 0
    });
    $('#jml_anggaran_setelah_edit').maskMoney({
        precision: 0
    });

    $('#jml_anggaran_setelah_edit').on('change', function() {
        split1 = $('#jml_anggaran_sebelum_edit').val().split(',');
        split2 = $('#jml_anggaran_setelah_edit').val().split(',');
        join1 = split1.join('');
        join2 = split2.join('');

        jumlah_anggaran = parseFloat(join2) - parseFloat(join1);
        persen = (parseFloat(join2) - parseFloat(join1)) / parseFloat(join1);

        $('#selisih_edit').val(jumlah_anggaran).maskMoney({
            precision: 0,
            reverse: true,
            translation: {
                '#': {
                    pattern: /\-|\d/,
                    recursive: true
                }
            },
        });
        $('#persen_edit').val(parseFloat(persen) * 100);
    });

    function KodeRekeningEdit() {
        kode_rekening_edit = $('#kode_rekening_edit').val();
        console.log(kode_rekening_edit);
        $.ajax({
            type: 'GET',
            async: true,
            url: '{{ url('api/kode-rekening/getRekening') }}/' + kode_rekening_edit,
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
                $('#kode_rekening2_edit').html("Pilih");
                $('#kode_rekening2_edit').append(uraian);
                $('#nama_rekening_edit').val(data[0].nama_rekening);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function getSubKodeEdit() {
        var uraian = $('#kode_rekening2_edit').val();
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
                $('#kode_rekening3_edit').html("Pilih");
                $('#kode_rekening3_edit').append(sub_uraian);
                $('#uraian_edit').val(data[0].nama_rekening);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function getSubUraianEdit() {
        var sub_uraian = $('#kode_rekening3_edit').val();
        $.ajax({
            type: 'GET',
            async: true,
            url: '{{ url('api/kode-rekening/getSubRekening') }}/' + sub_uraian,
            dataType: 'json',
            success: function(data) {
                $('#sub_uraian_edit').val(data['nama_rekening']);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>

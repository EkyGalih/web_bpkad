<script>
    // Fungsi untuk filter pencarian tahun
    function FilterArusKas()
    {
        var tahun_anggaran = $('#tahun_anggaran').val();
        var bulan_anggaran = $('#bulan_anggaran').val();
        var minggu_anggaran = $('#minggu_anggaran').val();

        if (tahun_anggaran != '' && bulan_anggaran == '' && minggu_anggaran == '') {
            window.location.href = window.location.origin+ '/admin/arus-kas/index/' + tahun_anggaran
        } else if (tahun_anggaran == '' && bulan_anggaran != '' && minggu_anggaran == '') {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Pilih Tahun Dulu',
                timer: 3000
            })
        } else if (tahun_anggaran == '' && bulan_anggaran == '' && minggu_anggaran != '') {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Pilih Tahun dan Bulan dulu',
                timer: 3000
            })
        } else if (tahun_anggaran != '' && bulan_anggaran != '' && minggu_anggaran == '') {
            window.location.href = window.location.origin+ '/admin/arus-kas/index/' + tahun_anggaran + '/' + bulan_anggaran
        } else if (tahun_anggaran != '' && bulan_anggaran != '' && minggu_anggaran != '') {
            window.location.href = window.location.origin+ '/admin/arus-kas/index/' + tahun_anggaran + '/' + bulan_anggaran + '/' + minggu_anggaran
        }
    }

    function getRef1()
    {
        var ref1 = $('#get_ref1').val();
        $.ajax({
            type: 'GET',
            async: true,
            url: '{{ url('api/kode-rekening/getRefRekening') }}/' + ref1,
            dataType: 'json',
            success: function(data){
                $('#ref1').val(data.kode_rekening);
                $('#jenis_laporan').val(data.nama_rekening);
            },error: function(error){
                console.log(error);
            }
        });
        $.ajax({
            type: 'GET',
            async: true,
            url: '{{ url('api/kode-rekening/getRefGroup') }}/' + ref1,
            dataType: 'json',
            success: function(data){
                var addOption = "";

                for (a = 0; a < data.length; a++){
                    addOption += ["<option value='"+data[a].rekening_id+"'>"+data[a].nama_rekening+"</option>"];
                }
                $('#get_ref2').html("Pilih");
                $('#get_ref2').append(addOption);
                $('#ref2').val(data[0].kode_rekening);
                $('#jenis_arus_kas').val(data[0].nama_rekening);
            }, error: function(error){
                console.log(error);
            }
        });
    }

    function getRef2()
    {
        var ref2 = $('#get_ref2').val();
        $.ajax({
            type: 'GET',
            async: true,
            url: '{{ url('api/kode-rekening/getRefSub') }}/' + ref2,
            dataType: 'json',
            success: function(data){
                console.log(data);
                $('#ref2').val(data.kode_rekening);
                $('#jenis_arus_kas').val(data.nama_rekening);
            },error: function(error){
                console.log(error);
            }
        });
    }

    function subTotal()
    {
        var ref1 = $('#ref1').val();
        var ref2 = $('#ref2').val();
        var tahun = $('#tahun_anggaran1').val();
        var anggaran = $('#anggaran').val();
        var debet =  $('#debet').val();
        var kredit =  $('#kredit').val();
        var totalSum = parseInt(anggaran) + parseInt(debet) - parseInt(kredit);
        $('#total').val(totalSum);

        $.ajax({
            type: 'GET',
            async: true,
            url: '{{ url('api/arus-kas/subTotal1') }}/' + ref1 + '/' + ref2 + '/' + tahun,
            success: function(data){
                var subTotal = (parseFloat(data) + parseInt(anggaran));
                console.log(data);
                $('#sub_total_saldo').text('Sub Total Saldo Kas ' + Intl.NumberFormat('id-ID', {style: 'currency', currency: 'IDR'}).format(subTotal));
            }, error: function(error){
                console.log(error);
            }
        });

        $.ajax({
            type: 'GET',
            async: true,
            url: '{{ url('api/arus-kas/Total1') }}/' + tahun,
            success: function(data){
                var total = parseInt(anggaran) + parseFloat(data);
                console.log(data);
                $('#total_saldo').text('Total Saldo Kas ' + Intl.NumberFormat('id-ID', {style: 'currency', currency: 'IDR'}).format(total));
            }, error: function(error){
                console.log(error);
            }
        });
    }

    function getTahun()
    {
        tahun = $('#tahun_anggaran1').val();
        $('#label_anggaran').text('Anggaran '+tahun);
        $('#label_debet').text('Debet '+tahun);
        $('#label_kredit').text('Kredit '+tahun);
        $('#label_total').text('Total (anggaran+debet-kredit)');
    }
</script>

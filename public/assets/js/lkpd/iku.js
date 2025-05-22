// Enable form function
function enableForm() {
    $('#indikator_kinerja_id').removeAttr('disabled');
}

// Get data function
function getData() {
    var id = $('#indikator_kinerja_id').val();
    $.ajax({
        type: 'GET',
        async: true,
        url: '/api/iku-realisasi/getFormulasi/' + id,
        dataType: 'json',
        success: function (data) {
            console.log(data);
            $('#formula_id').val(data.formula_id);
            $('#formula').val(data.formulasi);
            $('#tipe_penghitungan').val(data.tipe_penghitungan);
            $('#divisi_id').val(data.nama_divisi);
        },
        error: function (error) {
            console.log(error);
        }
    });
}

// Edit data function
function editData() {
    var formula_id = $('#indikator_kinerja_id_edit').val();
    $.ajax({
        type: 'GET',
        async: true,
        url: '/api/iku-realisasi/formulaDetail/' + formula_id,
        dataType: 'json',
        success: function (data) {
            $('#formula_id_edit').val(data.formula_id);
            $('#formula_edit').val(data.formulasi);
            $('#tipe_penghitungan_edit').val(data.tipe_penghitungan);
            $('#divisi_id_edit').val(data.nama_divisi);
            $('#target').val(data.target);
        },
        error: function (error) {
            console.log(error);
        }
    });
}

// Initialize maskMoney plugin
$('#anggaran_program').maskMoney({
    precision: 0
});
$('#anggaran_terpakai').maskMoney({
    precision: 0
});

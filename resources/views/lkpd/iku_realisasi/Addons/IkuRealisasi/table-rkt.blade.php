<h2 style="text-align: center;">RENCANAN KINERJA TAHUNAN (RKT) {{ date('Y') }}<br />TINGKAT ORGANISASI PERANGKAT
    DAERAH</h2>
<div class="table-responsive">
    <button type="button" class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#TambahData"
        style="float: right; margin-bottom: 5px;">
        <i class="ki-outline ki-plus-square fs-2 me-1"></i> Tambah Data
    </button>
    <table class="table table-hover table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th style="font-size: 16px; font-family: 'Times New Roman'; width: 300px;">Sasaran Strategis</th>
                <th style="font-size: 16px; font-family: 'Times New Roman'; width: 300px;">Indikator Kinerja</th>
                <th style="font-size: 16px; font-family: 'Times New Roman'; text-align: center;">Target</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($IkuRealisasi as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->sasaran->sasaran_strategis }}</td>
                    <td>{{ $data->IK->indikator_kinerja }}</td>
                    <td style="text-align: center;">{{ $data->target }}%</td>
                    <td style="text-align: center;">
                        <button type="button" class="btn btn-icon btn-warning" data-bs-toggle="modal"
                            data-bs-target="#EditData{{ $loop->iteration }}" data-bs-tooltip="tooltip" data-bs-placement="top"
                            title="Ubah Iku">
                            <i class="ki-outline ki-notepad-edit fs-2 me-1"></i>
                        </button>
                        <button type="button" class="btn btn-icon btn-danger"
                            onclick="deleteData('{{ route('iku-realisasi.destroy', $data->iku_realisasi_id) }}')"
                            data-bs-tooltip="tooltip" data-bs-placement="top" title="Hapus Iku">
                            <i class="ki-outline ki-trash fs-2 me-1"></i>
                        </button>
                    </td>
                </tr>
                @include('lkpd.iku_realisasi.Addons.IkuRealisasi.edit')
            @endforeach
        </tbody>
    </table>
</div>
{{ $IkuRealisasi->links() }}
@section('js-additional')
    <script src="{{ asset('lib/jquery-mask/jquery-mask.js') }}"></script>
    <script>
        $('#anggaran_program').maskMoney({
            precision: 0
        });
        $('#anggaran_terpakai').maskMoney({
            precision: 0
        });

        function enableForm() {
            $('#indikator_kinerja_id').removeAttr('disabled');
        }

        function getData() {
            var id = $('#indikator_kinerja_id').val();
            $.ajax({
                type: 'GET',
                async: true,
                url: '{{ url('api/iku-realisasi/getFormulasi') }}/' + id,
                dataType: 'json',
                success: function(data) {
                    $('#formula_id').val(data.formula_id);
                    $('#formula').val(data.formulasi);
                    $('#tipe_penghitungan').val(data.tipe_penghitungan);
                    $('#divisi_id').val(data.nama_divisi)
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function editData() {
            var formula_id = $('#indikator_kinerja_id_edit').val();
            $.ajax({
                type: 'GET',
                async: true,
                url: '{{ url('api/iku-realisasi/formulaDetail') }}/' + formula_id,
                dataType: 'json',
                success: function(data) {
                    $('#formula_id_edit').val(data.formula_id);
                    $('#formula_edit').val(data.formulasi);
                    $('#tipe_penghitungan_edit').val(data.tipe_penghitungan);
                    $('#divisi_id_edit').val(data.nama_divisi);
                    $('#target').val(data.target);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>
@endsection

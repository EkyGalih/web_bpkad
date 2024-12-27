<h2 style="text-align: center;">RENCANAN KINERJA TAHUNAN (RKT) {{ date('Y') }}<br />TINGKAT ORGANISASI PERANGKAT
    DAERAH</h2>
<div class="table-responsive">
    <button type="button" class="btn btn-theme btn-sm" data-toggle="modal" data-target="#TambahData"
        style="float: right; margin-bottom: 5px;">
        <i class="fas fa-plus"></i> Tambah Data
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
                        <div class="btn-group">
                            <button type="button" class="btn btn-link btn-xs" data-toggle="modal"
                                data-target="#EditData{{ $loop->iteration }}" data-tooltip="tooltip"
                                data-placement="top" title="Ubah Iku">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-link btn-xs"
                                onclick="deleteData('{{ route('iku-realisasi.destroy', $data->iku_realisasi_id) }}')"
                                data-tooltip="tooltip" data-placement="top" title="Hapus Iku">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @include('admin.iku_realisasi.Addons.IkuRealisasi.edit')
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

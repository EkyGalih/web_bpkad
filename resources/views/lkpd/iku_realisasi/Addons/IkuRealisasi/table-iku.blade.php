<h2 style="text-align: center;">INDIKATOR KINERJA UTAMA (IKU) {{ date('Y') }}</h2>
<div class="table-responsive">
    <table class="table table-hover table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th style="font-size: 16px; font-family: 'Times New Roman';">Sasaran Strategis</th>
                <th style="font-size: 16px; font-family: 'Times New Roman';">Indikator Kinerja</th>
                <th style="font-size: 16px; font-family: 'Times New Roman';">Penjelasan <br />(Formulasi Pengukuran, Tipe
                    Perhitungan, Sumber Data, Alasan)</th>
                <th style="font-size: 16px; font-family: 'Times New Roman';">Target</th>
                <th style="font-size: 16px; font-family: 'Times New Roman';">Target Tercapai</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($IkuRealisasi as $data)
                <tr>
                    <td rowspan="4">{{ $loop->iteration }}</td>
                    <td rowspan="4">{{ $data->sasaran->sasaran_strategis }}</td>
                    <td rowspan="4">{{ $data->IK->indikator_kinerja }}</td>
                    <td><strong>Formulasi Pengukuran :</strong> {{ $data->formula->formulasi }}</td>
                    <td rowspan="4">{{ $data->target }}%</td>
                    <td rowspan="4"><label style="font-size: 13px;"
                            class="label label-{{ $data->target > $data->target_tercapai ? 'danger' : 'success' }}">{{ $data->target_tercapai }}%</label>
                    </td>
                </tr>
                <tr>
                    <td><strong>Tipe Penghitungan : </strong>{{ $data->formula->tipe_penghitungan }}</td>
                </tr>
                <tr>
                    <td><strong>Sumber Data : </strong>{{ $data->formula->divisi->nama_divisi }}</td>
                </tr>
                <tr>
                    <td><strong>Alasan : </strong>{{ $data->formula->alasan }}</td>
                </tr>
                @include('admin.iku_realisasi.Addons.IkuRealisasi.edit')
            @endforeach
        </tbody>
    </table>
</div>
{{ $IkuRealisasi->links() }}
@section('js-additional')
    <script>

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
                    console.log(data);
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

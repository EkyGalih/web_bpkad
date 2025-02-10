@extends('admin.index')
@section('title', 'Kode Rekening')

@section('menu-tools', 'active')
@section('show-menu-tools', 'show')
@section('kode-rekening', 'active')

@section('content')
    <h3><a href="{{ route('kode-rekening-admin') }}"><i class="fas fa-barcode"></i> Sub Kode Rekening
            [<u>{{ $nama_rekening }}</u>]</a></h3>
    <div class="row mt">
        <div class="col-lg-8">
            <div class="content-panel" style="padding: 10px;">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-striper" id="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Rekening</th>
                                <th>Kode Rekening</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sub_kode as $rekening)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $rekening->nama_rekening }}</td>
                                    <td>{{ $rekening->kode_rekening }}</td>
                                    <td>
                                        <a href="{{ route('sub-kode-admin.edit', $rekening->sub_kode_id) }}"
                                            class="btn btn-warning btn-xs" data-tooltip="tooltip" data-placement="top"
                                            title="Edit Kode Rekening">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-xs" data-tooltip="tooltip"
                                            data-placement="top" title="Hapus Kode Rekening"
                                            onclick="deleteData('{{ route('sub-kode-admin.destroy', $rekening->sub_kode_id) }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="content-panel" style="padding: 10px;">
                <form
                    action="{{ isset($rekeningDetail) ? route('sub-kode-admin.update', $rekeningDetail->sub_kode_id) : route('sub-kode-admin.store') }}"
                    method="POST" onsubmit="return validateForm()">
                    @csrf
                    @if (isset($rekeningDetail))
                        @method('PUT')
                    @endif
                    <div class="form-group">
                        <label for="jenis_rekening">Jenis Rekening</label>
                        <select name="jenis_rekening" class="form-control" id="jenis_rekening" onchange="getSubKode()"
                            required="true">
                            <option>Pilih</option>
                            @if (isset($rekeningDetail))
                                <option value="realisasi"
                                    {{ $rekeningDetail->kodeRekening->jenis_rekening == 'realisasi' ? 'selected' : '' }}>
                                    Realisasi Anggaran</option>
                                <option value="saldo"
                                    {{ $rekeningDetail->kodeRekening->jenis_rekening == 'saldo' ? 'selected' : '' }}>Saldo
                                    Anggaran Lebih</option>
                                <option value="neraca"
                                    {{ $rekeningDetail->kodeRekening->jenis_rekening == 'neraca' ? 'selected' : '' }}>
                                    Neraca</option>
                                <option value="operasional"
                                    {{ $rekeningDetail->kodeRekening->jenis_rekening == 'operasional' ? 'selected' : '' }}>
                                    Operasional</option>
                                <option value="arus_kas"
                                    {{ $rekeningDetail->kodeRekening->jenis_rekening == 'arus_kas' ? 'selected' : '' }}>
                                    Arus Kas</option>
                                <option value="ekuitas"
                                    {{ $rekeningDetail->kodeRekening->jenis_rekening == 'ekuitas' ? 'selected' : '' }}>
                                    Perubahan Ekuitas</option>
                            @else
                                <option value="realisasi">Realisasi Anggaran</option>
                                <option value="saldo">Saldo Anggaran Lebih</option>
                                <option value="neraca">Neraca</option>
                                <option value="operasional">Operasional</option>
                                <option value="arus_kas">Arus Kas</option>
                                <option value="ekuitas">Perubahan Ekuitas</option>
                            @endif
                        </select>
                        <p class="text-danger" id="err_jenis_rekening" style="font-size: 12px"></p>
                    </div>
                    <div class="form-group">
                        <label for="kode_rekening">Kode Rekening Indux</label>
                        <select name="sub_kode_rekening" id="sub_kode" class="form-control"></select>
                    </div>
                    <div class="form-group">
                        <label for="nama_rekening">Nama Rekening</label>
                        <input type="text" name="nama_rekening" class="form-control"
                            value="{{ isset($rekeningDetail) ? $rekeningDetail->nama_rekening : '' }}" required="true">
                        <p class="text-danger" id="err_nama_rekening" style="font-size: 12px"></p>
                    </div>
                    <div class="form-group">
                        <label for="kode_rekening">Kode Rekening</label>
                        <input type="text" name="kode_rekening" class="form-control"
                            value="{{ isset($rekeningDetail) ? $rekeningDetail->kode_rekening : '' }}" required="true">
                        <p class="text-danger" id="err_kode_rekening" style="font-size: 12px"></p>
                    </div>
                    <button type="submit" class="btn btn-{{ isset($rekeningDetail) ? 'success' : 'theme' }} btn-sm"
                        id="simpan"><i class="fas fa-save"></i> Simpan</button>
                    @if (isset($rekeningDetail))
                        <a href="{{ route('kode-rekening-admin.show', $rekeningDetail->kode_rekening_id) }}"
                            class="btn btn-warning btn-sm"><i class="fas fa-sync"></i> Reset</a>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js-additional')
    <script>
        $(document).ready(function() {
            var jenis_rekening = $('#jenis_rekening').val();
            $.ajax({
                type: 'GET',
                async: true,
                url: '{{ url('api/kode-rekening/getSpesifikRekening') }}/' + jenis_rekening,
                dataType: 'json',
                success: function(data) {
                    var addOption = " ";

                    for (a = 0; a < data.length; a++) {
                        addOption += ["<option value='" + data[a].rekening_id + "'>" + data[a]
                            .nama_rekening + "</option>"
                        ];
                    }
                    $('#sub_kode').html("Pilih");
                    $('#sub_kode').append(addOption);
                }
            });
        });

        function getSubKode() {
            var jenis_rekening = $('#jenis_rekening').val();
            $.ajax({
                type: 'GET',
                async: true,
                url: '{{ url('api/kode-rekening/getSpesifikRekening') }}/' + jenis_rekening,
                dataType: 'json',
                success: function(data) {
                    var addOption = " ";

                    for (a = 0; a < data.length; a++) {
                        addOption += ["<option value='" + data[a].rekening_id + "'>" + data[a].nama_rekening +
                            "</option>"
                        ];
                    }
                    $('#sub_kode').html("Pilih");
                    $('#sub_kode').append(addOption);
                }
            });
        }
    </script>
@endsection

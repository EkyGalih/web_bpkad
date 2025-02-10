@extends('admin.index')
@section('title', 'Detail Rincian Iku Realisasi')
@section('menu-iku-realisasi', 'active')
@section('rincian-iku', 'active')
@section('css-additional')
    <link rel="stylesheet" href="{{ asset('lib/bootstrap-fileupload/bootstrap-fileupload.css') }}">
@endsection
@section('content')
    <h3> <a href="#"><i class="fas fa-info-circle"></i> Detail {{ $SubKegiatan->indikator_kinerja }}</a></h3>
    <hr />
    <a href="{{ route('rincian-iku-admin') }}" class="btn btn-default btn-sm"><i class="fas fa-backward"></i> Kembali</a>
    <div class="row mt">
        <div class="col-lg-12">
            <div class="col-lg-6">
                <div class="content-panel">
                    <div class="container">
                        <form action="{{ route('rincian-iku-admin.upload') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="sub_kegiatan_id" value="{{ $SubKegiatan->id }}">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <span class="btn btn-theme02 btn-file">
                                    <span class="fileupload-new"><i class="fas fa-paperclip"></i> Pilih File </span>
                                    <span class="fileupload-exists"><i class="fas fa-undo"></i> Ubah</span>
                                    <input type="file" class="default" name="file-bukti">
                                </span>
                                <span class="fileupload-preview" style="margin-left: 5px;"></span>
                                <a href="#" class="close fileupload-exists" data-dismiss="fileupload"
                                    style="float: none; margin-left: 5px;"></a>
                                <button type="submit" class="btn btn-theme">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="content-panel">
                    @php
                        $ListFile = Helpers::GetListFile($SubKegiatan->id);
                        $explode = explode(' ', $SubKegiatan->target_kinerja);
                    @endphp
                    <table class="table table-hover table-bordered table-responsive" style="color: #000000;">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Jumlah Bukti ({{ $explode[0] }})</td>
                                <td>File</td>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < $explode[0]; $i++)
                                @php $fileexp = explode("/", $ListFile[$i]['nama_file'] ?? '-') @endphp
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $explode[1] . ' ' . $i + 1 }}</td>
                                    <td>
                                        <a
                                            href="{{ asset($ListFile[$i]['nama_file'] ?? route('rincian-iku-admin.show', $SubKegiatan->id)) }}">
                                            {{ $fileexp[6] ?? 'Belum Upload' }}
                                        </a>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js-additional')
    <script src="{{ asset('lib/bootstrap-fileupload/bootstrap-fileupload.js') }}"></script>
@endsection

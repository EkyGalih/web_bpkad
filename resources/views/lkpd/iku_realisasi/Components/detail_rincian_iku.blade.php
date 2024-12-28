@extends('lkpd.index')
@section('title', 'Detail Rincian Iku Realisasi')
@section('iku', 'here show')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/bootstrap-fileupload/bootstrap-fileupload.css') }}">
@endsection
@section('toolbar')
    <div class="page-title me-5">
        <h1 class="page-heading d-flex text-white fw-bold fs-2 justify-content-center my-0">
            <i class="ki-outline ki-information-2 fs-1 me-2"></i> Detail {{ $SubKegiatan->indikator_kinerja }}
        </h1>
    </div>
    <div class="d-flex align-self-center flex-center flex-shrink-0">
        <a href="{{ route('rincian-iku') }}" class="btn btn-secondary btn-sm"><i class="ki-outline ki-arrow-left fs-2"></i>
            Kembali</a>
    </div>
@endsection
@section('content')
    <div class="row g-5 g-xl-12">
        <div class="col-xl-6">
            <div class="card card-flush p-5">
                <div class="card-header p-0">
                    <div class="card-title">
                        <h4>Upload Dokumen</h4>
                    </div>
                </div>
                <div class="card-body p-2">
                    <form action="{{ route('rincian-iku.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="fv-row mb-3">
                            <label class="form-label required" for="nama_file">Nama Bukti Dukung</label>
                            <input type="text" class="form-control" name="nama_file" value="{{ old('nama_file') }}">
                        </div>
                        <div class="fv-row">
                            <input type="hidden" name="sub_kegiatan_id" value="{{ $SubKegiatan->id }}">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <span class="btn btn-secondary btn-file">
                                    <span class="fileupload-new"><i class="ki-outline ki-paper-clip fs-3"></i> Pilih
                                        File </span>
                                    <span class="fileupload-exists"><i class="ki-outline ki-arrow-circle-left"></i>
                                        Ubah</span>
                                    <input type="file" class="default" name="file-bukti">
                                </span>
                                <span class="fileupload-preview" style="margin-left: 5px;"></span>
                                <a href="#" class="close fileupload-exists" data-dismiss="fileupload"
                                    style="float: none; margin-left: 5px;"></a>
                            </div>
                        </div>
                        <div class="float-end">
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="ki-outline ki-cloud-add fs-2"></i> Upload
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card card-flush p-5">
                @php
                    $ListFile = Iku::GetListFile($SubKegiatan->id);
                    $explode = explode(' ', $SubKegiatan->target_kinerja);
                @endphp
                <table class="table table-hover table-bordered table-responsive" style="color: #000000;">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Jumlah Bukti ({{ $explode[0] }})</td>
                            <td>Nama File</td>
                            <td>File</td>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < $explode[0]; $i++)
                            @php $fileexp = explode("/", $ListFile[$i]['nama_file'] ?? '-') @endphp
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $explode[1] . ' ' . $i + 1 }}</td>
                                <td></td>
                                <td>
                                    <a
                                        href="{{ asset($ListFile[$i]['nama_file'] ?? route('rincian-iku.show', $SubKegiatan->id)) }}">
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
@endsection
@section('scripts')
    <script src="{{ asset('assets/plugins/custom/bootstrap-fileupload/bootstrap-fileupload.js') }}"></script>
@endsection

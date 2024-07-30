@extends('layouts.admin.inventaris.app')
@section('title', 'Tambah Lokasi Aset')
@section('lokasi', 'active')
@section('header')
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Aset TIK
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="index.html" class="text-muted text-hover-primary">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Inventaris</li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Lokasi Aset</li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Tambah Lokasi Aset</li>
            </ul>
        </div>
    </div>
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card card-flush">
                <div class="card-header">
                    <h3 class="card-title">Form Tambah Lokasi Aset</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('inventaris.lokasi.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="aset_id" class="form-label">Aset</label>
                            <div class="form-floating border rounded">
                                <select name="aset_id" class="form-select form-select-transparent" data-placeholder="Pilih Aset"
                                    id="aset_id">
                                    <option></option>
                                    @foreach ($asets as $item)
                                        <option value="{{ $item->id }}"
                                            data-kt-rich-content-subcontent="{{ $item->kode_aset }}"
                                            data-kt-select2-aset="{{ $item->gambar }}" {{ $aset->id == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama_aset }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="aset_id">Pilih Aset</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="bidang_id" class="form-label">Bidang</label>
                            <select class="form-select" name="bidang_id">
                                <option value="">Pilih Bidang</option>
                                @foreach ($bidangs as $bidang)
                                    <option value="{{ $bidang->uuid }}">{{ strtoupper($bidang->nama_bidang) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="pegawai_id" class="form-label">Pegawai</label>
                            <div class="form-floating border rounded">
                                <select name="pegawai_id" class="form-select form-select-transparent" data-placeholder="Pilih Pegawai"
                                    id="pegawai_id">
                                    <option></option>
                                    @foreach ($pegawais as $pegawai)
                                        @php
                                            $gender = $pegawai->jenis_kelamin;
                                            if ($gender == 'pria') {
                                                $profile = $pegawai->foto
                                                    ? asset('uploads/pegawai/' . $pegawai->foto)
                                                    : asset('uploads/profile/male.jpg');
                                            } elseif ($gender == 'wanita') {
                                                $profile = $pegawai->foto
                                                    ? asset('uploads/pegawai/' . $pegawai->foto)
                                                    : asset('uploads/profile/female.jpg');
                                            }
                                        @endphp
                                        <option value="{{ $pegawai->id }}"
                                            data-kt-rich-content-subcontent="{{ $pegawai->nip }}"
                                            data-kt-select2-user="{{ $profile }}">
                                            {{ $pegawai->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="pegawai_id">Pilih Pegawai</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_penyerahan" class="form-label">Tanggal Penyerahan</label>
                            <input type="date" class="form-control" name="tanggal_penyerahan" id="tanggal_penyerahan">
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                        <a href="#" onclick="history.back(-1)" class="btn btn-secondary">
                            <i class="ki-duotone ki-arrow-left fs-2x">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="ki-duotone ki-send fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i> Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('server/vendor/ckeditor/ckeditor-classic.bundle.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            // Pegawai ID
            var optionFormatPegawai = function(peg) {
                if (!peg.id) {
                    return peg.text;
                }

                var span = document.createElement('span');
                var imgPeg = peg.element.getAttribute('data-kt-select2-user');
                var template = '';

                template += '<div class="d-flex align-items-center">';
                template += '<img src="' + imgPeg +
                    '" class="rounded img-thumbnail h-35px me-3" alt="' + peg.text + '"/>';
                template += '<div class="d-flex flex-column">'
                template += '<span class="fs-5 fw-bold lh-1">' + peg.text + '</span>';
                template += '<span class="text-muted fs-6">' + peg.element.getAttribute(
                    'data-kt-rich-content-subcontent') + '</span>';
                template += '</div>';
                template += '</div>';

                span.innerHTML = template;

                return $(span);
            }

            $('#pegawai_id').select2({
                templateSelection: optionFormatPegawai,
                templateResult: optionFormatPegawai
            });

            // Aset ID
            var optionFormatAset = function(aset) {
                if (!aset.id) {
                    return aset.text;
                }

                var span = document.createElement('span');
                var imgAset = aset.element.getAttribute('data-kt-select2-aset');
                var templates = '';

                templates += '<div class="d-flex align-items-center">';
                templates += '<img src="' + imgAset +
                    '" class="img-thumbnail rounded-5 w-50px me-3" alt="' + aset.text + '"/>';
                templates += '<div class="d-flex flex-column">'
                templates += '<span class="fs-5 fw-bold lh-1">' + aset.text + '</span>';
                templates += '<span class="text-muted fs-6">' + aset.element.getAttribute(
                    'data-kt-rich-content-subcontent') + '</span>';
                templates += '</div>';
                templates += '</div>';

                span.innerHTML = templates;

                return $(span);
            }

            $('#aset_id').select2({
                templateSelection: optionFormatAset,
                templateResult: optionFormatAset
            });

            ClassicEditor
                .create(document.querySelector('#keterangan'), {
                    // Konfigurasi tambahan untuk CKEditor
                    height: 500 // Atur tinggi editor di sini
                })
                .then(editor => {
                    console.log(editor);
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
@endsection

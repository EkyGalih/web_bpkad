@extends('admin.index')
@section('title', 'PPID | Tambah Klasifikasi Informasi Publik')
@section('styles')
<link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/quill/editor.css') }}">
<link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/select2/select2.css') }}">
<style>
    #link-file-group,
    #pdf-file-group {
        overflow: hidden;
        max-height: 0;
        opacity: 0;
        transition: max-height 0.5s ease, opacity 0.5s ease;
    }

    /* Saat tampil */
    #link-file-group.show,
    #pdf-file-group.show {
        max-height: 500px;
        /* atur sesuai kebutuhan konten */
        opacity: 1;
    }
</style>
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card" id="card-subpage">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">Tambah Data</h4>
            </div>
        </div>
        <form action="{{ route('ppid-kip.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-floating form-floating-outline mb-6">
                    <input type="text" name="nama_informasi" id="nama_informasi" placeholder="Judul"
                        class="form-control @error('nama_informasi') is-invalid @enderror"
                        value="{{ old('nama_informasi') }}">
                    <label for="nama_informasi">Judul</label>
                    @error('nama_informasi')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-floating form-floating-outline mb-6">
                    <label for="jenis_informasi" class="form-label">Jenis Informasi</label>
                    <select name="jenis_informasi"
                        class="form-select select2 @error('jenis_informasi') is-invalid @enderror">
                        <option value="">Pilih</option>
                        <option value="berkala" {{ old('jenis_informasi')=='berkala' ? 'selected' : '' }}>
                            Informasi
                            Berkala</option>
                        <option value="dikecualikan" {{ old('jenis_informasi')=='dikecualikan' ? 'selected' : '' }}>
                            Informasi Dikecualikan</option>
                        <option value="serta merta" {{ old('jenis_informasi')=='serta merta' ? 'selected' : '' }}>
                            Informasi Serta Merta</option>
                        <option value="setiap saat" {{ old('jenis_informasi')=='setiap saat' ? 'selected' : '' }}>
                            Informasi Tersedia Setiap Saat</option>
                    </select>
                    @error('jenis_informasi')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline mb-3">
                            <label for="tahun" class="form-label">Tahun</label>
                            <select name="tahun" id="tahun"
                                class="form-select select2 @error('tahun') is-invalid @enderror">
                                <option value="">Pilih</option>
                                @foreach (_GetYears() as $tahun)
                                <option value="{{ $tahun }}" {{ old('tahun')==$tahun ? 'selected' : '' }}>
                                    {{ $tahun }}</option>
                                @endforeach
                            </select>
                            @error('tahun')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline mb-3">
                            <label for="jenis_file" class="form-label">Jenis File</label>
                            <select name="jenis_file" id="jenis_file"
                                class="form-select select2 @error('jenis_file') is-invalid @enderror" id="jenis_file">
                                <option value="">Pilih</option>
                                <option value="link" {{ old('jenis_file')=='link' ? 'selected' : '' }}>Link
                                </option>
                                <option value="upload" {{ old('jenis_file')=='upload' ? 'selected' : '' }}>Upload
                                </option>
                            </select>
                            @error('jenis_file')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <small class="text-muted">Agar file yang di upload bisa di lihat di situs PPID pusat, maka
                                file
                                ukuran di bawah 20MB bisa diupload ke server</small>
                        </div>
                    </div>
                </div>
                <div class="form-floating form-floating-outline mb-6">
                    <div class="row {{ old('jenis_file') == 'upload' ? 'show' : '' }}" id="pdf-file-group">
                        <div class="small fw-medium mb-3">Upload PDF</div>

                        <div id="pdf-dropzone" class="mb-4"
                            style="border: 2px dashed #ccc; padding: 20px; text-align: center; cursor: pointer; border-radius: 6px;">
                            <input type="file" id="pdfInput" name="files" accept="application/pdf"
                                style="display: none;" />
                            <div id="pdf-drop-text" style="color: #999;">Drop file PDF di sini atau klik untuk
                                upload</div>
                        </div>

                        <div id="pdf-preview-wrapper" style="display: none; margin-top: 10px;"
                            data-old-pdf-url="{{ old('files') }}">
                            <div style="margin-top: 25px; text-align: right;">
                                <button class="btn btn-circle btn-outline-danger btn-xs" type="button" id="remove-pdf"
                                    data-bs-tooltip="tooltip" data-bs-placement="left" title="Hapus PDF">
                                    <i class="icon-base ri ri-close-line icon-18px"></i>
                                </button>
                            </div>
                            <embed id="pdfPreview" type="application/pdf"
                                style="width: 100%; height: 90vh; border: 1px solid #ccc; border-radius: 6px;" />
                        </div>
                        <small class="text-muted" id="desc_uplaod_file">Hanya file pdf dan ukuran maksimal 20MB</small>
                    </div>
                </div>
                <div class="form-floating form-floating-outline mb-6 {{ old('jenis_file') == 'link' ? 'show' : '' }}"
                    id="link-file-group">
                    <input id="link" type="text" name="links_file" placeholder="Link"
                        class="form-control @error('links_file') is-invalid @enderror" value="{{ old('links_file') }}">
                    <label for="link">Link</label>
                </div>
                @error('files')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                @error('links_file')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="card-footer">
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('ppid-kip.index') }}" class="btn btn-outline-secondary btn-lg"
                            style="float: right;" type="reset">
                            <i class="icon-base ri ri-arrow-left-circle-line icon-18px me-2"></i> Kembali
                        </a>
                        <button class="btn btn-success btn-lg" style="float: right; margin-right: 2px;" type="submit">
                            <i class="icon-base ri ri-save-3-line icon-18px me-2"></i> Simpan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('server/assets/vendor/libs/select2/select2.js') }}"></script>
<script src="{{ asset('server/assets/vendor/libs/quill/quill.js') }}"></script>
<script src="{{ asset('server/assets/js/forms-selects.js') }}"></script>
<script src="{{ asset('server/assets/js/forms-editors.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script>
    $('#jenis_file').change(function() {
            const jenis_file = $('#jenis_file').val();

            if (jenis_file == 'link') {
                $('#pdf-file-group').removeClass('show');
                $('#link-file-group').addClass('show');
            } else {
                $('#pdf-file-group').addClass('show');
                $('#link-file-group').removeClass('show');
            }
        });
</script>
@endsection
@extends('layouts.admin.inventaris.app')
@section('title', 'Tambah Aset TIK')
@section('aset-tik', 'active')
@section('styles')
    <style>
        .custom-file-input {
            position: relative;
            overflow: hidden;
        }

        .custom-file-input input[type="file"] {
            position: absolute;
            opacity: 0;
            right: 0;
            top: 0;
            font-size: 100px;
            cursor: pointer;
        }

        .custom-file-input-btn {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        #imagePreview {
            display: none;
            max-width: 300px;
            margin-top: 10px;
        }
    </style>
@endsection
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
                <li class="breadcrumb-item text-muted">Aset TIK</li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Edit Aset</li>
            </ul>
        </div>
    </div>
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card card-flush">
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                </div>
                <div class="card-body pt-1">
                    <form action="{{ route('inventaris.aset.update', $aset->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-6">
                            <div class="col-md-6">
                                <label for="nama" class="form-label">Nama Aset</label>
                                <input type="text" class="form-control @error('nama_aset') is-invalid @enderror"
                                    id="nama" name="nama_aset" value="{{ $aset->nama_aset ?? old('nama_aset') }}"
                                    required>
                                @error('nama_aset')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="kode" class="form-label">Kode Aset</label>
                                <input type="text" class="form-control @error('kode_aset') is-invalid @enderror"
                                    id="kode" name="kode_aset" value="{{ $aset->kode_aset ?? old('kode_aset') }}"
                                    required>
                                @error('kode_aset')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <div class="col-md-6">
                                <label for="type" class="form-label">Tipe</label>
                                <input type="text" class="form-control @error('type') is-invalid @enderror"
                                    id="type" name="type" value="{{ $aset->type ?? old('type') }}">
                                @error('type')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select class="form-select @error('kategori_id') is-invalid @enderror" name="kategori_id"
                                    id="kategori">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($kategories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $aset->kategori_id == $category->id ? 'selected' : (old('kategori_id') == $category->id ? 'selected' : '') }}>
                                            {{ $category->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6">
                            <div class="col-md-6">
                                <label for="model" class="form-label">Model</label>
                                <input type="text" class="form-control @error('model') is-invalid @enderror"
                                    id="model" name="model" value="{{ $aset->model ?? old('model') }}" required>
                                @error('model')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="serial_number" class="form-label">Serial Number</label>
                                <input type="text" class="form-control @error('serial_number') is-invalid @enderror"
                                    id="serial_number" name="serial_number"
                                    value="{{ $aset->serial_number ?? old('serial_number') }}">
                                @error('serial_number')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-6 ml-1">
                            <div class="col-md-6">
                                <label for="tanggal_perolehan" class="form-label">Tanggal Perolehan</label>
                                <input type="date" class="form-control @error('tanggal_perolehan') is-invalid @enderror"
                                    id="tanggal_perolehan" name="tanggal_perolehan"
                                    value="{{ $aset->tanggal_perolehan ?? old('tanggal_perolehan') }}">
                                @error('tanggal_perolehan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-control @error('status') is-invalid @enderror">
                                    <option value="">Pilih</option>
                                    <option value="baru"
                                        {{ $aset->status == 'baru' ? 'selected' : (old('status') == 'baru' ? 'selected' : '') }}>
                                        Baru</option>
                                    <option value="baik"
                                        {{ $aset->status == 'baik' ? 'selected' : (old('status') == 'baik' ? 'selected' : '') }}>
                                        Baik</option>
                                    <option value="rusak"
                                        {{ $aset->status == 'rusak' ? 'selected' : (old('status') == 'rusak' ? 'selected' : '') }}>
                                        Rusak</option>
                                    <option value="perbaikan"
                                        {{ $aset->status == 'perbaikan' ? 'selected' : (old('status') == 'perbaikan' ? 'selected' : '') }}>
                                        Perbaikan
                                    </option>
                                    <option value="hilang"
                                        {{ $aset->status == 'hilang' ? 'selected' : (old('status') == 'hilang' ? 'selected' : '') }}>
                                        Hilang
                                    </option>
                                </select>
                                @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row mb-6 mt-5">
                                <div class="col-md-6">
                                    <label for="nilai" class="form-label">Nilai</label>
                                    <input type="text" class="form-control @error('nilai') is-invalid @enderror"
                                        onkeypress="isInputNumber(event)" oninput="formatRupiah(this)" id="nilai"
                                        name="nilai" value="{{ $aset->nilai ?? old('nilai') }}">
                                    @error('nilai')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="text" class="form-control @error('jumlah') is-invalid @enderror"
                                        onkeypress="isInputNumber(event)" id="jumlah" name="jumlah"
                                        value="{{ $aset->jumlah ?? old('jumlah') }}">
                                    @error('jumlah')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-6">
                                <div class="col-md-6">
                                    <label for="deskripsi" class="form-label">Deskripsi Aset</label>
                                    <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror">{{ $aset->deskripsi ?? old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror">{{ $aset->keterangan ?? old('keterangan') }}</textarea>
                                    @error('keterangan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-6">
                                <div class="col-md-6">
                                    <div class="form-group custom-file-input">
                                        <button type="button" class="custom-file-input-btn">Select an Image</button>
                                        <input type="file" id="imageInput" name="gambar" accept="image/*"
                                            value="{{ $aset->gambar ?? old('gambar') }}">
                                        @error('gambar')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <img id="imagePreview"
                                            src="@if ($aset->gambar) {{ asset($aset->gambar) }} @endif"
                                            alt="Image Preview" class="img-thumbnail"
                                            style="display: {{ $aset->gambar ? 'block' : 'none' }}; max-width: 300px;">
                                    </div>
                                </div>
                                <div class="col-md-6 text-end">
                                    <a href="{{ route('inventaris.aset.index') }}" class="btn btn-secondary">
                                        <i class="ki-duotone ki-arrow-left fs-2x">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i>
                                        Kembali
                                    </a>
                                    <button type="submit" class="btn btn-success">
                                        <i class="ki-duotone ki-send fs-2x">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i> Simpan
                                    </button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#imageInput').on('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview').attr('src', e.target.result).show();
                    }
                    reader.readAsDataURL(file);
                } else {
                    $('#imagePreview').hide();
                }
            });
        });
    </script>
@endsection

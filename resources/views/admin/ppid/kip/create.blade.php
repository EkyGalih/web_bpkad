@extends('admin.index')
@section('title', 'PPID | Tambah Klasifikasi Informasi Publik')
@section('ppid-menu', 'show')
@section('ppid-ki', 'active')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <div class="pagetitle">
                <h1>Klasifikasi Informasi Publik</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('ppid-kip.index') }}">PPID</a></li>
                        <li class="breadcrumb-item active">Tambah Data Klasifikasi Informasi Publik</li>
                    </ol>
                </nav>
            </div>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title"><i class="bi bi-plus-square"></i> Tambah Data</div>
                            <hr />
                            <form action="{{ route('ppid-kip.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Nama Data</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama_informasi"
                                            class="form-control @error('nama_informasi') is-invalid @enderror" value="{{ old('nama_informasi') }}">
                                        @error('nama_informasi')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Jenis Informasi</label>
                                    <div class="col-sm-10">
                                        <select name="jenis_informasi"
                                            class="form-control @error('jenis_informasi') is-invalid @enderror">
                                            <option value="">---Pilih---</option>
                                            <option value="berkala" {{ old('jenis_informasi') == 'berkala' ? 'selected' : '' }}>Informasi Berkala</option>
                                            <option value="dikecualikan" {{ old('jenis_informasi') == 'dikecualikan' ? 'selected' : '' }}>Informasi Dikecualikan</option>
                                            <option value="serta merta" {{ old('jenis_informasi') == 'serta merta' ? 'selected' : '' }}>Informasi Serta Merta</option>
                                            <option value="setiap saat" {{ old('jenis_informasi') == 'setiap saat' ? 'selected' : '' }}>Informasi Tersedia Setiap Saat</option>
                                        </select>
                                        @error('jenis_informasi')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Tahun</label>
                                    <div class="col-sm-10">
                                        @php
                                            $years = Helpers::_GetYears();
                                        @endphp
                                        <select name="tahun" class="form-control @error('tahun') is-invalid @enderror">
                                            <option value="">--Pilih--</option>
                                            @foreach ($years as $tahun)
                                                <option value="{{ $tahun }}" {{ old('tahun') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                                            @endforeach
                                        </select>
                                        @error('tahun')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Jenis File</label>
                                    <div class="col-sm-10">
                                        <select name="jenis_file"
                                            class="form-control @error('jenis_file') is-invalid @enderror" id="jenis_file">
                                            <option value="">---Pilih---</option>
                                            <option value="link" {{ old('jenis_file') == 'link' ? 'selected' : '' }}>Link</option>
                                            <option value="upload" {{ old('jenis_file') == 'upload' ? 'selected' : '' }}>Upload</option>
                                        </select>
                                        @error('jenis_file')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <small class="text-muted">Agar file yang di upload bisa di lihat di situs PPID pusat, maka file ukuran di bawah 20MB bisa diupload ke server</small>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Files</label>
                                    <div class="col-sm-10">
                                        <input id="upload_file" type="file" name="upload_files"
                                            class="form-control @error('upload_files') is-invalid @enderror" value="{{ old('upload_files') }}">
                                        @error('upload_files')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <small class="text-muted" id="desc_uplaod_file">Hanya file pdf dan ukuran maksimal 20MB</small>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Waktu Upload</label>
                                    <div class="col-sm-2">
                                        <input id="date" type="date" name="date"
                                            class="form-control @error('date') is-invalid @enderror"
                                            value="{{ old('date') }}">
                                        @error('date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-2">
                                        <input id="time" type="time" name="time"
                                            class="form-control @error('time') is-invalid @enderror"
                                            value="{{ old('time') }}">
                                        @error('time')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <button class="btn btn-outline-warning btn-md" style="float: right;" type="reset">
                                            <i class="bi bi-arrow-clockwise"></i> Reset
                                        </button>
                                        <button class="btn btn-success btn-md"
                                            style="float: right; margin-right: 2px;" type="submit">
                                            <i class="bi bi-save"></i> Simpan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('additional-js')
    <script>
        $('#jenis_file').change(function() {
            var jenis_file = $('#jenis_file').val();

            if (jenis_file == 'link') {
                $('#upload_file').prop('type', 'text');
                $('#desc_uplaod_file').attr('hidden', true);
            } else {
                $('#upload_file').prop('type', 'file');
                $('#desc_uplaod_file').attr('hidden', false);
            }
        })
    </script>
@endsection

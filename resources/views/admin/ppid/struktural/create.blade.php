@extends('admin.index')
@section('title', 'PPID | Tambah Struktur Organisasi PPID')
@section('di-menu', 'show')
@section('di-ppid', 'active')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <div class="pagetitle">
                <h1>Struktur Organisasi PPID</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('ppid-struktur.index') }}">PPID</a></li>
                        <li class="breadcrumb-item active">Tambah Data Struktur Organisasi PPID</li>
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
                                    <label for="inputText" class="col-sm-2 col-form-label">Nama Pegawai</label>
                                    <div class="col-sm-10">
                                        <select name="pegawai_id" class="form-control">
                                            <option value="">--Pilih---</option>
                                            @foreach ($pegawais as $pegawai)
                                            <option value="{{ $pegawai->id }}">{{ $pegawai->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('nama_informasi')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Jabatan</label>
                                    <div class="col-sm-10">
                                        <select name="jabatan" class="form-control">
                                            <option value="">--Pilih--</option>
                                            <option value="atasan">Atasan PPID</option>
                                            <option value="ketua">Ketua PPID</option>
                                            <option value="kepala_pengelola">Kepala Pengelola</option>
                                            <option value="kepala_pelayanan">Kepala Pelayanan</option>
                                            <option value="kepala_pengaduan">Kepala Pengaduan</option>
                                            <option value="anggota_pengelola">Anggota Pengelola</option>
                                            <option value="anggota_pelayanan">Anggota Pelayanan</option>
                                            <option value="anggota_pengaduan">Anggota Pengaduan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Nama Jabatan</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama_jabatan" class="form-control">
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

            if (jenis_file == 'upload') {
                $('#upload_file').prop('type', 'file');
            } else {
                $('#upload_file').prop('type', 'text');
            }
        })
    </script>
@endsection

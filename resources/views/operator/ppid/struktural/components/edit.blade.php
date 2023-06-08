@extends('operator.index')
@section('title', 'PPID | Edit Struktur Organisasi PPID')
@section('ppid-menu', 'show')
@section('ppid-struktur', 'active')
@section('additional-css')
    <link rel="stylesheet" href="{{ asset('server/vendor/tom-select/tom-select.css') }}">
@endsection
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <div class="pagetitle">
                <h1>Struktur Organisasi PPID</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('operator') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('ppid-op-struktur.index') }}">PPID</a></li>
                        <li class="breadcrumb-item active">Edit Data Struktur Organisasi PPID</li>
                    </ol>
                </nav>
            </div>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title"><i class="bi bi-plus-square"></i> Edit Data</div>
                            <hr />
                            <form action="{{ route('ppid-op-struktur.update', $struktur->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Nama Pegawai</label>
                                    <div class="col-sm-10">
                                        <select name="pegawai_id" id="select-pegawai" autocomplete="off"
                                            placeholder="--Pilih--">
                                            <option value="">--Pilih---</option>
                                            @foreach ($pegawais as $pegawai)
                                                <option value="{{ $pegawai->id }}"
                                                    {{ $struktur->pegawai_id == $pegawai->id ? 'selected' : '' }}>
                                                    {{ $pegawai->name }}</option>
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
                                        <select name="jabatan" id="select-jabatan" autocomplete="off"
                                            placeholder="--Pilih--">
                                            <option value="">--Pilih--</option>
                                            @foreach ($jabatan as $item)
                                                <option value="{{ $item['jabatan'] }}"
                                                    {{ $struktur->jabatan == $item['jabatan'] ? 'selected' : '' }}>
                                                    {{ $item['nama_jabatan'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Nama Jabatan</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama_jabatan" value="{{ $struktur->nama_jabatan }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <button class="btn btn-outline-warning btn-md" style="float: right;" type="reset">
                                            <i class="bi bi-arrow-clockwise"></i> Reset
                                        </button>
                                        <button class="btn btn-success btn-md" style="float: right; margin-right: 2px;"
                                            type="submit">
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
    <script src="{{ asset('server/vendor/tom-select/tom-select.js') }}"></script>
    <script>
        new TomSelect("#select-pegawai", {
            create: true,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });
        new TomSelect("#select-jabatan", {
            create: true,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });

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

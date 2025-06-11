@extends('admin.index')
@section('title', 'PPID | Tambah Struktur Organisasi PPID')
@section('styles')
    <link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/select2/select2.css') }}">
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">Tambah Struktur Organisasi PPID</h4>
                    </div>
                </div>
                <form action="{{ route('struktur-organisasi.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-floating form-floating-outline mb-6">
                            <label for="select-pegawai" class="form-label">Nama Pegawai</label>
                            <select name="pegawai_id" id="select-pegawai" class="select2 form-select"
                                data-allow-clear="true">
                                <option value="">Pilih</option>
                                @foreach ($pegawais as $pegawai)
                                    <option value="{{ $pegawai->id }}">{{ $pegawai->name }}</option>
                                @endforeach
                            </select>
                            @error('nama_informasi')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <label for="select-jabatan" class="form-label">Jabatan</label>
                            <select name="jabatan" id="select-jabatan" class="select2 form-select">
                                <option value="">Pilih</option>
                                @foreach ($jabatan as $item)
                                    <option value="{{ $item['jabatan'] }}">{{ $item['nama_jabatan'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="text" id="nama" name="nama_jabatan" placeholder="Nama Jabatan"
                                class="form-control">
                            <label for="nama">Nama Jabatan</label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end gap-2">
                            <a class="btn btn-outline-secondary" href="{{ route('post-admin.index') }}">
                                <i class="icon-base ri ri-skip-back-line"></i> Kembali
                            </a>
                            <button class="btn btn-outline-success" type="submit">
                                <i class="icon-base ri ri-save-line"></i> Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('server/assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('server/assets/js/forms-selects.js') }}"></script>
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

@extends('admin.index')
@section('title', 'Ubah User')
@section('styles')
    <link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/select2/select2.css') }}">
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">Ubah User</h4>
                </div>
            </div>
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <input type="hidden" name="nama" id="nama" value="{{ $user->nama }}"
                        class="form-control @error('nama') is-invalid @enderror" placeholder="Nama Pengguna">
                    <div class="form-floating form-floating-outline mb-6">
                        <label class="form-label" for="pegawai_id">Pegawai <sup class="text-danger">*</sup></label>
                        <select id="pegawai_id" name="pegawai_id" class="select2 form-select" data-allow-clear="true">
                            <option value="">Pilih Pegawai</option>
                            @foreach ($pegawais as $pegawai)
                                <option value="{{ $pegawai->id }}"
                                    {{ $user->pegawai_id == $pegawai->id ? 'selected' : '' }}>
                                    {{ $pegawai->name }} -
                                    {{ $pegawai->nip == 0 ? $pegawai->jenis_pegawai : $pegawai->nip }}
                                </option>
                            @endforeach
                        </select>
                        @error('pegawai_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating form-floating-outline mb-6">
                        <input type="text" placeholder="Username" value="{{ $user->username }}" id="username" name="username"
                            class="form-control @error('username') is-invalid @enderror">
                        <label for="username">Username</label>
                        @error('username')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating form-floating-outline mb-6">
                        <input type="email" id="email" name="email" value="{{ $user->email }}"
                            class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                        <label for="email">Email</label>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating form-floating-outline mb-6">
                        <label for="role" class="form-label">Role User</label>
                        <select name="role" id="role"
                            class="select2 form-select @error('role') is-invalid @enderror" data-allow-clear="true">
                            <option value="">Pilih</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="operator" {{ $user->role == 'operator' ? 'selected' : '' }}>Operator</option>
                        </select>
                        @error('role')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('users') }}" class="btn btn-outline-secondary">
                            <i class="icon-base ri ri-arrow-left-double-fill me-2"></i> Kembali
                        </a>
                        <button class="btn btn-outline-success" type="submit" id="submitBtn">
                            <i class="icon-base ri ri-save-3-fill me-2"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('server/assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('server/assets/js/forms-selects.js') }}"></script>
    <script>
        $('#pegawai_id').on('change', function() {
            const id = $(this).val();
            if (!id) return;

            $.ajax({
                url: `/admin/web/Users/get-pegawai/${id}`,
                type: 'GET',
                success: function(data) {
                    $('#nama').val(data.nama);
                    $('#username').val(data.username);
                    $('#email').val(data.email);

                },
                error: function() {
                    alert('Gagal mengambil data pegawai.');
                }
            });
        });
    </script>
@endsection

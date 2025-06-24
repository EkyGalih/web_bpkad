@extends('admin.index')
@section('title', 'Tambah User')
@section('styles')
    <link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/select2/select2.css') }}">
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">Tambah User</h4>
                </div>
            </div>
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <input type="hidden" name="nama" id="nama" value="{{ old('nama') }}"
                        class="form-control @error('nama') is-invalid @enderror" placeholder="Nama Pengguna">
                    <div class="form-floating form-floating-outline mb-6">
                        <label class="form-label" for="pegawai_id">Pegawai <sup class="text-danger">*</sup></label>
                        <select id="pegawai_id" name="pegawai_id" class="select2 form-select" data-allow-clear="true">
                            <option value="">Pilih Pegawai</option>
                            @foreach ($pegawais as $pegawai)
                                <option value="{{ $pegawai->id }}"
                                    {{ old('pegawai_id') == $pegawai->id ? 'selected' : '' }}>
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
                        <input type="text" id="username" placeholder="Username" value="{{ old('username') }}"
                            name="username" class="form-control @error('username') is-invalid @enderror">
                        <label for="username">Username</label>
                        @error('username')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating form-floating-outline mb-6">
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
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
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="operator" {{ old('role') == 'operator' ? 'selected' : '' }}>Operator</option>
                        </select>
                        @error('role')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating form-floating-outline mb-6">
                        <input type="text" value="{{ old('password') }}" placeholder="Password" class="form-control"
                            name="password" id="password">
                        <label for="password">Password</label>
                        <button type="button" onclick="pass()" class="btn btn-link btn-sm">
                            <i class="bi bi-qr-code"></i> Generate Password
                        </button>

                        <!-- Bar Progress -->
                        <div class="progress mt-2" style="height: 6px;">
                            <div class="progress-bar" id="passwordStrengthBar" style="width: 0%;"></div>
                        </div>

                        <!-- Status Text -->
                        <small id="passwordStrengthText" class="form-text text-muted"></small>

                        <!-- Error Message -->
                        <div id="passwordError" class="text-danger small mt-1">Password belum memenuhi aturan.</div>

                        <!-- Aturan Password -->
                        <div id="passwordRules" class="text-danger small mt-1">
                            Password minimal 8 karakter, huruf besar, huruf kecil, angka & simbol.
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('users') }}" class="btn btn-outline-secondary">
                            <i class="icon-base ri ri-arrow-left-double-fill me-2"></i> Kembali
                        </a>
                        <button class="btn btn-outline-primary" type="submit" id="submitBtn">
                            <i class="icon-base ri ri-add-fill me-2"></i> Tambah
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

        function makeid(length = 15) {
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%&';
            return Array.from({
                length
            }, () => chars[Math.floor(Math.random() * chars.length)]).join('');
        }

        function checkPasswordStrength(pwd) {
            return [
                /[a-z]/, /[A-Z]/, /[0-9]/, /[^A-Za-z0-9]/
            ].reduce((acc, r) => acc + r.test(pwd), 0) + (pwd.length >= 8 ? 1 : 0);
        }

        function updatePasswordUI(strength) {
            const bar = document.getElementById("passwordStrengthBar");
            const text = document.getElementById("passwordStrengthText");
            const error = document.getElementById("passwordError");
            const rules = document.getElementById("passwordRules");
            const input = document.getElementById("password");
            const btn = document.getElementById("submitBtn");

            bar.className = "progress-bar";
            input.classList.remove("is-invalid");

            if (strength < 5) {
                const weak = strength < 3;
                bar.classList.add(weak ? "bg-danger" : "bg-warning");
                bar.style.width = weak ? "20%" : "60%";
                text.innerText = weak ? "Password Lemah" : "Password Sedang";
                error.style.display = 'block';
                rules.style.display = 'block';
                input.classList.add('is-invalid');
                btn.disabled = true; // disable tombol
            } else {
                bar.classList.add("bg-success");
                bar.style.width = "100%";
                text.innerText = "Password Kuat";
                error.style.display = 'none';
                rules.style.display = 'none';
                btn.disabled = false; // enable tombol
            }
        }

        function pass() {
            const input = document.getElementById('password');
            let generated = '';
            do {
                generated = makeid();
            } while (checkPasswordStrength(generated) < 5);

            input.value = generated;
            input.dispatchEvent(new Event('input'));
        }

        document.getElementById('password').addEventListener('input', (e) => {
            updatePasswordUI(checkPasswordStrength(e.target.value));
        });

        document.addEventListener('DOMContentLoaded', () => {
            pass(); // Auto generate saat load
        });
    </script>
@endsection

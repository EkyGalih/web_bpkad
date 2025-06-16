@extends('admin.index')
@section('title', 'Users')
@section('styles')
    <link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('server/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">Daftar User</h4>
                    <div class="d-flex gap-2">
                        <a href="{{ route('users.create') }}" class="btn btn-outline-primary btn-md">
                            <i class="icon-base ri ri-file-add-line icon-18px me-2"></i> Tambah
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-datatable table-responsive text-nowrap">
                <table class="table table-hover table-users">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Dibuat</th>
                            <th class="d-flex align-items-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>
                                    @if ($user->active == '0')
                                        <i class="icon-base ri ri-close-circle-fill me-2 text-danger"
                                            data-bs-tooltip="tooltip" data-bs-placement="top" title="User tidak aktif"></i>
                                    @endif
                                    {{ $user->nama }}
                                </td>
                                <td>{{ $user->username }}</td>
                                <td>
                                    <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : 'info' }}">
                                        <i class="icon-base ri ri-user-2-fill me-2"></i> {{ $user->role }}
                                    </span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($user->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="icon-base ri ri-more-2-line icon-18px"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('users.edit', $user->id) }}"><i
                                                    class="icon-base ri ri-pencil-line icon-18px me-2"></i> Edit</a>
                                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-tooltip="tooltip"
                                                data-bs-placement="top" title="Update Password"
                                                data-bs-target="#UbahSandi{{ $loop->iteration }}">
                                                <i class="icon-base ri ri-lock-2-fill me-2"></i> Update Password
                                            </button>
                                            <button class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#ActiveModal{{ $loop->iteration }}"
                                                data-bs-tooltip="tooltip" data-bs-placement="top"
                                                title="{{ $user->active == '1' ? 'NonAktifkan' : 'Aktifkan' }} User">
                                                <i
                                                    class="icon-base ri ri-{{ $user->active == '1' ? 'close-circle-fill' : 'check-double-fill' }} me-2"></i>
                                                {{ $user->active == '1' ? 'NonAktifkan' : 'Aktifkan' }} User
                                            </button>
                                            <button class="dropdown-item"
                                                onclick="trashData('{{ route('users.destroy', $user->id) }}')"><i
                                                    class="icon-base ri ri-delete-bin-6-line icon-18px me-2"></i>
                                                Delete</button>
                                        </div>
                                    </div>
                                </td>
                                @include('admin.users.addons.password')
                                @include('admin.users.addons.activated')
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('server/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.table-users').DataTable();
        });

        function checkStrength(pwd) {
            let s = 0;
            if (/[a-z]/.test(pwd)) s++;
            if (/[A-Z]/.test(pwd)) s++;
            if (/[0-9]/.test(pwd)) s++;
            if (/[^A-Za-z0-9]/.test(pwd)) s++;
            if (pwd.length >= 8) s++;
            return s;
        }

        function applyValidationModal(iter) {
            const input = document.getElementById('passwordModal' + iter);
            const bar = document.getElementById('passwordStrengthBarModal' + iter);
            const text = document.getElementById('passwordStrengthTextModal' + iter);
            const error = document.getElementById('passwordErrorModal' + iter);
            const rules = document.getElementById('passwordRulesModal' + iter);
            const btn = document.getElementById('updatePass');

            input.addEventListener('input', () => {
                const pwd = input.value;
                const strength = checkStrength(pwd);
                input.classList.remove("is-invalid");
                bar.className = "progress-bar";

                if (strength < 5) {
                    const weak = strength < 3;
                    bar.classList.add(weak ? "bg-danger" : "bg-warning");
                    bar.style.width = weak ? "20%" : "60%";
                    text.innerText = weak ? "Password Lemah" : "Password Sedang";
                    input.classList.add("is-invalid");
                    error.style.display = 'block';
                    rules.style.display = 'block';
                    btn.disabled = true;
                } else {
                    bar.classList.add("bg-success");
                    bar.style.width = "100%";
                    text.innerText = "Password Kuat";
                    error.style.display = 'none';
                    rules.style.display = 'none';
                    btn.disabled = false;
                }
            });
        }

        // Inisialisasi semua modal sesuai jumlah user
        document.addEventListener('DOMContentLoaded', () => {
            @foreach ($users as $i => $user)
                applyValidationModal({{ $loop->iteration }});
            @endforeach
        });
    </script>
@endsection

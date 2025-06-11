@extends('admin.index')
@section('title', 'PPID | Struktur Organisasi PPID')
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
                    <h4 class="mb-0">Struktur Organisasi PPID</h4>
                    <div class="d-flex gap-2">
                        <a href="{{ route('struktur-organisasi.create') }}" class="btn btn-outline-primary btn-md">
                            <i class="icon-base ri ri-file-add-line icon-18px me-2"></i> Tambah
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-datatable table-responsive text-nowrap">
                <table class="table table-bordered table-responsive struktur-organisasi">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Pegawai</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($struktural as $item)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ $item->Pegawai->name }}</td>
                                <td>{{ $item->nama_jabatan }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="icon-base ri ri-more-2-line icon-18px"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('struktur-organisasi.edit', $item->ppid_id) }}"><i
                                                    class="icon-base ri ri-pencil-line icon-18px me-2"></i> Edit</a>
                                            <button class="dropdown-item"
                                                onclick="trashData('{{ route('struktur-organisasi.delete', $item->id) }}')"><i
                                                    class="icon-base ri ri-delete-bin-6-line icon-18px me-2"></i>
                                                Delete</button>
                                        </div>
                                    </div>
                                </td>
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
            $('.struktur-organisasi').DataTable();
        });
    </script>
@endsection

@extends('admin.index')
@section('title', 'Daftar Apps')
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
                    <h4 class="mb-0">Daftar Aplikasi</h4>
                    <div class="d-flex gap-2">
                        <a href="{{ route('apps.create') }}" class="btn btn-outline-primary btn-md">
                            <i class="icon-base ri ri-file-add-line icon-18px me-2"></i> Tambah
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-datatable table-responsive text-nowrap">
                <table class="apps table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th></th>
                            <th>Aplikasi</th>
                            <th>Deskripsi</th>
                            <th class="d-flex align-items-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($apps as $app)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ asset($app->icon) }}" alt="{{ $app->name }}" class="rounded-circle"
                                        width="40" height="40">
                                </td>
                                <td class="text-wrap">
                                    <div class="d-flex gap-3 border-start border-3 border-success ps-3">
                                        <div>
                                            <a href="#" class="mb-1 text-gray-900 text-success fw-bold">
                                                {{ strtoupper($app->name) }}
                                            </a>
                                            <sup class="text-primary text-hover-primary fw-semibold fs-18">{{ $app->versi }}</sup>
                                            <div class="fs-7 text-muted fw-bold">
                                                <a href="{{ $app->url }}" target="_blank" class="text-reset"
                                                    style="color: inherit; text-decoration: underline;">{{ $app->url }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-wrap">{{ $app->deskripsi }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="icon-base ri ri-more-2-line icon-18px"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('apps.edit', $app->id) }}"><i
                                                    class="icon-base ri ri-pencil-line icon-18px me-2"></i> Edit</a>
                                            <button class="dropdown-item"
                                                onclick="trashData('{{ route('apps.destroy', $app->id) }}')"><i
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
            $('.apps').DataTable();
        });
    </script>
@endsection

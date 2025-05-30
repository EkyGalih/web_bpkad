@extends('admin.index')
@section('title', 'Halaman')
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
                    <h4 class="mb-0">Halaman</h4>
                    <div class="d-flex gap-2">
                        <a href="{{ route('pages-admin.create') }}" class="btn btn-outline-primary btn-md">
                            <i class="icon-base ri ri-file-add-line icon-18px me-2"></i> Tambah
                        </a>
                        <button data-bs-toggle="modal" data-bs-target="#CachePages" data-bs-tooltip="tooltip"
                            data-bs-placement="top" title="Tong Sampah" class="btn btn-danger btn-md">
                            <i class="icon-base ri ri-delete-bin-3-fill icon-18px"></i>
                        </button>
                    </div>
                </div>
                @include('admin.pages.page.addons._cache')
            </div>
            <div class="card-datatable table-responsive text-nowrap">
                <table class="table table-bordered table-responsive page">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Tipe Halaman</th>
                            <th>Dibuat Oleh</th>
                            <th>Buat Pada</th>
                            <th>Ubah Pada</th>
                            <th class="d-flex align-items-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pages as $page)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $page->title }}</td>
                                <td>{{ GetTypePage($page->pages_type_id) }}</td>
                                <td>{{ GetUser($page->create_by_id) }}</td>
                                <td>{{ \Carbon\Carbon::parse($page->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                                </td>
                                <td>{{ $page->updated_at == null ? 'None' : \Carbon\Carbon::parse($page->updated_at)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="icon-base ri ri-more-2-line icon-18px"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('pages-admin.edit', $page->id) }}"><i
                                                    class="icon-base ri ri-pencil-line icon-18px me-2"></i> Edit</a>
                                            <button class="dropdown-item"
                                                onclick="trashData('{{ route('pages-admin.destroy', $page->id) }}')"><i
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
            $('.page').DataTable();
            $('.recycle').DataTable();
        });
    </script>
@endsection

@extends('admin.index')
@section('title', 'Pengumuman')
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
                    <h4 class="mb-0">Pengumuman Informasi</h4>
                    <a href="{{ route('pengumuman.create') }}" class="btn btn-outline-primary">
                        <i class="icon-base ri ri-add-large-fill me-2"></i> Tambah
                    </a>
                </div>
            </div>
            <div class="card-datatable table-responsive text-nowrap">
                <table class="table table-hover pengumuman">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Judul Informasi</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengumuman as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>
                                    <img src="{{ asset($item->foto) }}" alt="{{ $item->title }}" class="me-2" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
                                    {{ $item->title }}
                                </td>
                                <td>{{ $item->keterangan }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="icon-base ri ri-more-2-line icon-18px"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('pengumuman.edit', $item->id) }}"><i
                                                    class="icon-base ri ri-pencil-line icon-18px me-2"></i> Edit</a>
                                            <button class="dropdown-item"
                                                onclick="trashData('{{ route('pengumuman.destroy', $item->id) }}')"><i
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
            $('.pengumuman').DataTable();
        });
    </script>
@endsection

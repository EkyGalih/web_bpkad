@extends('admin.index')
@section('title', 'PPID | Agenda Pimpinan')
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
                    <h4 class="mb-0">Agenda Pimpinan</h4>
                    <div class="d-flex gap-2">
                        <a href="{{ route('agenda-pimpinan.create') }}" class="btn btn-outline-primary btn-md">
                            <i class="icon-base ri ri-file-add-line icon-18px me-2"></i> Tambah
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-datatable table-responsive text-nowrap">
                <table class="agenda-pimpinan table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Dibuat Oleh</th>
                            <th>Pada</th>
                            <th>dan diubah Pada</th>
                            <th class="d-flex align-items-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($agendas as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-wrap">{{ $item->title }}</td>
                                <td>
                                    <span class="badge bg-label-primary">
                                        <i class="ri ri-newspaper-fill"></i> Agenda Pimpinan</span>
                                </td>
                                <td>{{ GetUser($item->users_id) }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                                </td>
                                <td>
                                    @if (
                                        \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY') !=
                                            \Carbon\Carbon::parse($item->updated_at)->locale('id')->isoFormat('dddd, D MMMM YYYY'))
                                        {{ \Carbon\Carbon::parse($item->updated_at)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                                    @else
                                        <span class="text-muted fs-10 font-italic">Belum pernah diubah</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="icon-base ri ri-more-2-line icon-18px"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="{{ route('agenda-pimpinan.destroy', $item->id) }}"
                                                class="dropdown-item" data-bs-tooltip="tooltip" data-bs-placement="top"
                                                title="Hapus Agenda Kaban">
                                                <i class="icon-base ri ri-delete-bin-3-line icon-18px me-2"></i>
                                                Hapus Agenda Pimpinan
                                            </a>
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
            $('.agenda-pimpinan').DataTable();
        });
    </script>
@endsection

@extends('admin.index')
@section('title', 'PPID | Tambah Agenda Pimpinan')
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
                    <h4 class="mb-0">Tambah Agenda Pimpinan</h4>
                </div>
            </div>
            <div class="card-datatable table-responsive text-nowrap">
                <table class="post table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Dibuat Oleh</th>
                            <th class="d-flex align-items-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-wrap">{{ $post->title }}</td>
                                <td>
                                    <span
                                        class="badge bg-label-{{ \App\Enum\CategoryEnum::tryFrom($post->category->category)?->getColor() ?? 'secondary' }}">
                                        <i class="ri ri-newspaper-fill"></i> {{ $post->category->category }}</span>
                                </td>
                                <td>
                                    @if (
                                        \Carbon\Carbon::parse($post->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY') !=
                                            \Carbon\Carbon::parse($post->updated_at)->locale('id')->isoFormat('dddd, D MMMM YYYY'))
                                        {{ \Carbon\Carbon::parse($post->updated_at)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
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
                                            <a href="{{ route('agenda-pimpinan.jadikan_agenda', $post->id) }}"
                                                class="dropdown-item" data-bs-tooltip="tooltip" data-bs-placement="top"
                                                title="Jadikan Agenda Kaban">
                                                <i class="icon-base ri ri-calendar-2-line icon-18px me-2"></i>
                                                Jadikan Agenda Pimpinan
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
            $('.post').DataTable();
        });
    </script>
@endsection

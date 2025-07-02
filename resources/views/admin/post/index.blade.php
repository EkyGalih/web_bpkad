@extends('admin.index')
@section('title', 'Berita/Artikel')
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
                    <h4 class="mb-0">Berita/Artikel</h4>
                    <div class="d-flex gap-2">
                        <a href="{{ route('post-' . Auth::user()->rule->rule . '.create') }}"
                            class="btn btn-outline-primary btn-md">
                            <i class="icon-base ri ri-file-add-line icon-18px me-2"></i> Tambah
                        </a>
                        <button data-bs-toggle="modal" data-bs-target="#CachePost" data-bs-tooltip="tooltip"
                            data-bs-placement="top" title="Tong Sampah" class="btn btn-danger btn-md">
                            <i class="icon-base ri ri-delete-bin-3-fill icon-18px"></i>
                        </button>
                    </div>
                </div>

                @include('admin.post.addons._cache')

            </div>
            <div class="card-datatable table-responsive text-nowrap">
                <table class="post table table-bordered table-responsive">
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
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-wrap">{{ $post->title }}</td>
                                <td>
                                    <span
                                        class="badge bg-label-{{ \App\Enum\CategoryEnum::tryFrom($post->category->category)?->getColor() ?? 'secondary' }}">
                                        <i class="ri ri-newspaper-fill"></i> {{ $post->category->category }}</span>
                                </td>
                                <td>{{ GetUser($post->users_id) }}</td>
                                <td>{{ \Carbon\Carbon::parse($post->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
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
                                            <a class="dropdown-item"
                                                href="{{ route('post-' . Auth::user()->rule->rule . '.edit', $post->id) }}"><i
                                                    class="icon-base ri ri-pencil-line icon-18px me-2"></i> Edit</a>
                                            <a href="{{ route('post-' . Auth::user()->rule->rule . '.agenda', $post->id) }}"
                                                class="dropdown-item" data-bs-tooltip="tooltip" data-bs-placement="top"
                                                title="Jadikan Agenda Kaban">
                                                <i
                                                    class="icon-base ri ri-{{ $post->agenda_kaban != 'ya' ? 'calendar-2-fill' : 'delete-bin-3-line' }} icon-18px me-2"></i>
                                                {{ $post->agenda_kaban != 'ya' ? 'Agenda' : 'Hapus Agenda' }}
                                            </a>
                                            <button class="dropdown-item"
                                                onclick="trashData('{{ route('post-' . Auth::user()->rule->rule . '.destroy', $post->id) }}')"><i
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
            $('.post').DataTable();
        });
    </script>
@endsection

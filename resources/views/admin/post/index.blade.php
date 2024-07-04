@extends('admin.index')
@section('title', 'Berita/Artikel')
@section('additional-css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('server/vendor/DataTables/DataTables-1.13.1/css/jquery.dataTables.min.css') }}" />
@endsection
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Berita/Artikel</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('post-admin.index') }}">Berita/Artikel</a></li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-10">
                                    <h5 class="card-title">Berita/Artikel</h5>
                                </div>
                                <div class="col-lg-2">
                                    <a href="{{ route('post-admin.create') }}" class="btn btn-outline-primary btn-md"
                                        style="margin-top: 10px; margin-left: 30px;">
                                        <i class="bi bi-journal-plus"></i> Tambah
                                    </a>
                                    <button data-bs-toggle="modal" data-bs-target="#CachePost" data-bs-tooltip="tooltip"
                                        data-bs-placement="top" style="margin-top: 10px;" title="Tong Sampah"
                                        class="btn btn-danger btn-md">
                                        <i class="bi bi-trash2"></i>
                                    </button>
                                    @include('admin/post/addons/_cache')
                                </div>
                            </div>
                            <table class="table table-hover post">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Dibuat Oleh</th>
                                        <th scope="col">Buat Pada</th>
                                        <th scope="col">Ubah Pada</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td style="width: 50%;">{{ $post->created_at }}</td>
                                            <td>
                                                <button
                                                    class="btn btn-sm btn-{{ $post->posts_category_id == '1' ? 'success' : 'primary' }}">
                                                    <i
                                                        class="bi bi-{{ $post->posts_category_id == '1' ? 'newspaper' : 'file-text' }}"></i>
                                                    {{ Helpers::GetCategoryContent($post->posts_category_id) }}
                                                </button>
                                            </td>
                                            <td>{{ Helpers::GetUser($post->users_id) }}</td>
                                            <td>{{ Helpers::GetDate($post->created_at) }}</td>
                                            <td>{{ $post->updated_at == null ? 'None' : Helpers::GetDate($post->updated_at) }}
                                            </td>
                                            <td>
                                                <a href="{{ route('post-admin.edit', $post->id) }}"
                                                    class="btn btn-secondary btn-md" data-bs-tooltip="tooltip"
                                                    data-bs-placement="top" title="Ubah Berkas">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <button class="btn btn-warning btn-md" data-bs-toggle="modal"
                                                    data-bs-tooltip="tooltip" data-bs-placement="top" title="Hapus Berkas"
                                                    data-bs-target="#DeletePost{{ $loop->iteration }}">
                                                    <i class="bi bi-recycle"></i>
                                                </button>
                                                @include('admin/post/addons/_delete')
                                                <a href="{{ route('post-admin.agenda', $post->id) }}" class="btn btn-{{ $post->agenda_kaban == 'ya' ? 'danger' : 'success' }} btn-md" data-bs-tooltip="tooltip"
                                                    data-bs-placement="top" title="{{ $post->agenda_kaban == 'ya' ? 'Hapus agenda kaban' : 'Jadikan Agenda Kaban' }}">
                                                <i class="bi bi-calendar"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('additional-js')
    <script type="text/javascript" src="{{ asset('server/js/jquery-5.3.1.js') }}"></script>
    <script src="{{ asset('server/vendor/DataTables/DataTables-1.13.1/js/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.post').DataTable();
        });
    </script>
@endsection

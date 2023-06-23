@extends('admin.index')
@section('title', 'Halaman')
@section('menu-pages', 'active')
@section('pages-menu', 'show')
@section('p-pages', 'active')
@section('additional-css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('server/vendor/DataTables/DataTables-1.13.1/css/jquery.dataTables.min.css') }}" />
@endsection
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Halaman</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('pages-admin.index') }}">Halaman</a></li>
                    <li class="breadcrumb-item active">Data Halaman</li>
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
                                    <h5 class="card-title">Data Halaman</h5>
                                </div>
                                <div class="col-lg-2">
                                    <a href="{{ route('pages-admin.create') }}" class="btn btn-outline-primary btn-md"
                                        style="margin-top: 10px; margin-left: 30px;">
                                        <i class="bi bi-journal-plus"></i> Tambah
                                    </a>
                                    <button type="button" class="btn btn-danger btn-md" data-bs-toggle="modal"
                                        data-bs-target="#CachePages" data-bs-tooltip="tooltip" data-bs-placement="top"
                                        title="Tong Sampah" style="margin-top: 10px;">
                                        <i class="bi bi-trash2"></i>
                                    </button>
                                    @include('admin/pages/page/addons/_cache')
                                </div>
                            </div>
                            <table class="table table-hover page">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">Tipe Halaman</th>
                                        <th scope="col">Dibuat Oleh</th>
                                        <th scope="col">Buat Pada</th>
                                        <th scope="col">Ubah Pada</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pages as $page)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $page->title }}</td>
                                            <td>{{ Helpers::GetTypePage($page->pages_type_id) }}</td>
                                            <td>{{ Helpers::GetUser($page->create_by_id) }}</td>
                                            <td>{{ Helpers::GetDate($page->created_at) }}</td>
                                            <td>{{ $page->updated_at == null ? 'None' : Helpers::GetDate($page->updated_at) }}
                                            </td>
                                            <td>
                                                <a href="{{ route('pages-admin.edit', $page->id) }}"
                                                    class="btn btn-secondary btn-md" data-bs-tooltip="tooltip" data-bs-placement="top" title="Ubah Berkas">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <button class="btn btn-warning btn-md" data-bs-tooltip="tooltip" data-bs-placement="top" title="Hapus Berkas" data-bs-toggle="modal"
                                                    data-bs-target="#DeletePages{{ $loop->iteration }}">
                                                    <i class="bi bi-recycle"></i>
                                                </button>

                                                @include('admin/pages/page/addons/_delete')
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
            $('.page').DataTable();
            $('.recycle').DataTable();
        });
    </script>
@endsection

@extends('operator.index')
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
                    <li class="breadcrumb-item"><a href="{{ route('operator') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('pages-op.index') }}">Halaman</a></li>
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
                            </div>
                            <table class="table table-hover" id="example">
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
                                                <a href="{{ route('pages-op.edit', $page->id) }}"
                                                    class="btn btn-warning btn-md">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <button class="btn btn-danger btn-md" data-bs-toggle="modal"
                                                    data-bs-target="#DeletePages{{ $loop->iteration }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>

                                                <div class="modal fade" id="DeletePages{{ $loop->iteration }}"
                                                    tabindex="-1">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"><i
                                                                        class="bi bi-exclamation-octagon-fill"></i> Hapus
                                                                    Postingan</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Halaman <strong><u>{{ $page->title }}</u></strong>
                                                                    akan dihapus.<br /> Anda Yakin?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-secondary"
                                                                    data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>
                                                                    Tidak</button>
                                                                <a href="{{ route('pages-op.destroy', $page->id) }}"
                                                                    class="btn btn-outline-danger">
                                                                    <i class="bi bi-check-circle"></i> Ya
                                                                </a>
                                                            </div>
                                                        </div>
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
            </div>
        </section>
    </main>
@endsection
@section('additional-js')
    <script type="text/javascript" src="{{ asset('server/js/jquery-5.3.1.js') }}"></script>
    <script src="{{ asset('server/vendor/DataTables/DataTables-1.13.1/js/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endsection

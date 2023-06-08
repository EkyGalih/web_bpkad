@extends('admin.index')
@section('title', 'Daftar Apps')
@section('menu-tools', 'show')
@section('tools-apps', 'active')
@section('additional-css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('server/vendor/DataTables/DataTables-1.13.1/css/jquery.dataTables.min.css') }}" />
@endsection
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Daftar Apps</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('apps-admin.index') }}">Daftar Apps</a></li>
                    <li class="breadcrumb-item active">Daftar Apps</li>
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
                    <a href="{{ route('apps-admin.create') }}" class="btn btn-outline-primary btn-md" style="float: right; margin-bottom: 5px;">
                        <i class="bi bi-plus"></i> Tambah Apps
                    </a>
                </div>
                <div class="row">
                    @foreach ($apps as $app)
                        <div class="col-lg-3">
                            <div class="card">
                                <img src="{{ asset($app->icon) }}" class="card-img-top" alt="{{ $app->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{ $app->name }}<br/>
                                        <small class="badge bg-info"><i class="bi bi-tags"></i>
                                            {{ $app->versi }}</small>
                                    </h5>
                                    <p class="card-text">{{ $app->deskripsi }}</p>
                                </div>
                                <div class="card-footer">
                                    <a href="{{ $app->url }}" class="btn btn-outline-primary btn-md" target="_blank"><i
                                            class="bi bi-link-45deg"></i> Link</a>
                                    <a href="{{ route('apps-admin.edit', $app->id) }}" class="btn btn-outline-warning brn-md">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <button type="button" class="btn btn-outline-danger btn-md" data-bs-toggle="modal" data-bs-target="#DeleteApp{{ $loop->iteration }}">
                                        <i class="bi bi-x-circle"></i> Hapus
                                    </button>

                                    <div class="modal fade" id="DeleteApp{{ $loop->iteration }}"
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
                                                    <p>Data Aplikasi <strong><u>{{ $app->name }}</u></strong>
                                                        akan dihapus.<br /> Anda Yakin?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>
                                                        Tidak</button>
                                                    <a href="{{ route('apps-admin.destroy', $app->id) }}"
                                                        class="btn btn-outline-danger">
                                                        <i class="bi bi-check-circle"></i> Ya
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
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

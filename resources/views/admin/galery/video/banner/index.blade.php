@extends('admin.index')
@section('title', 'Banner Video')
@section('di-menu', 'show')
@section('di-video', 'active')
@section('additional-css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('server/vendor/DataTables/DataTables-1.13.1/css/jquery.dataTables.min.css') }}" />
@endsection
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Banner Video</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('banner-video.index') }}">Banner Video</a></li>
                    <li class="breadcrumb-item active">Banner Video</li>
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
                                    <h5 class="card-title">Banner Video</h5>
                                </div>
                                <div class="col-lg-2">
                                    <a href="{{ route('banner-video.create') }}" class="btn btn-outline-primary btn-md"
                                        style="float: right; margin-top: 5px;">
                                        <i class="bi bi-plus"></i> Tambah Banner
                                    </a>
                                </div>
                            </div>

                            <table class="table table-hover" id="foto">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Buat Pada</th>
                                        <th scope="col">Ubah Pada</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($video as $foto)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $foto->Galery->name }}</td>
                                            <td>{{ $foto->Galery->keterangan }}</td>
                                            <td>{{ $foto->Galery->tanggal }}</td>
                                            <td>{{ Helpers::GetDate($foto->created_at) }}</td>
                                            <td>{{ $foto->updated_at == null ? 'None' : Helpers::GetDate($foto->updated_at) }}
                                            <td>
                                                <a href="{{ route('galery-admin.edit', $foto->id) }}"
                                                    class="btn btn-warning btn-md">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="#" class="btn btn-info btn-md">
                                                    <i class="bi bi-eye"></i>
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
                                                                        class="bi bi-exclamation-octagon-fill"></i>
                                                                    Hapus Postingan</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Galery Foto
                                                                    <strong><u>{{ $foto->name }}</u></strong>
                                                                    akan dihapus.<br /> Anda Yakin?
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-secondary"
                                                                    data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>
                                                                    Tidak</button>
                                                                <a href="{{ route('galery-admin.destroy', $foto->id) }}"
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
            $('#foto').DataTable();
            $('#video').DataTable();
        });
    </script>
@endsection

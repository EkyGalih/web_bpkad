@extends('operator.index')
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
                    <li class="breadcrumb-item"><a href="{{ route('operator') }}">Home</a></li>
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
                                    @foreach ($videos as $video)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $video->Galery->name }}</td>
                                            <td>{{ $video->Galery->keterangan }}</td>
                                            <td>{{ $video->Galery->tanggal }}</td>
                                            <td>{{ Helpers::GetDate($video->created_at) }}</td>
                                            <td>{{ $video->updated_at == null ? 'None' : Helpers::GetDate($video->updated_at) }}
                                            <td>
                                                <a href="{{ route('banner-video.edit', $video->Galery->id) }}"
                                                    class="btn btn-warning btn-md" data-bs-tooltip="tooltip"
                                                    data-bs-placement="top" title="Ubah Data">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="{{ route('banner-video.show', $video->Galery->id) }}"
                                                    class="btn btn-info btn-md" data-bs-tooltip="tooltip"
                                                    data-bs-placement="top" title="Lihat Data">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <button class="btn btn-danger btn-md" data-bs-toggle="modal"
                                                    data-bs-target="#DeletePages{{ $loop->iteration }}" data-bs-tooltip="tooltip"
                                                    data-bs-placement="top" title="Hapus Data">
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
                                                                    <strong><u>{{ $video->name }}</u></strong>
                                                                    akan dihapus.<br /> Anda Yakin?
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-secondary"
                                                                    data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>
                                                                    Tidak</button>
                                                                <a href="{{ route('banner-video.destroy', $video->id) }}"
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

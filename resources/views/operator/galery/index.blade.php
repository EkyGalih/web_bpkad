@extends('operator.index')
@section('title', 'Galery')
@section('di-menu', 'show')
@section('di-galery', 'active')
@section('additional-css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('server/vendor/DataTables/DataTables-1.13.1/css/jquery.dataTables.min.css') }}" />
@endsection
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Galery</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('operator') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('galery-op.index') }}">Galery</a></li>
                    <li class="breadcrumb-item active">Galery</li>
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
                                    <h5 class="card-title">Galery</h5>
                                </div>
                                <div class="col-lg-2">
                                    <a href="#" class="btn btn-outline-primary btn-md" data-bs-target="#BtnGalery"
                                        data-bs-toggle="modal" style="float: right; margin-top: 5px;">
                                        <i class="bi bi-plus"></i> Tambah galery
                                    </a>
                                    <div class="modal fade" id="BtnGalery" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"><i class="bi bi-list-check"></i>
                                                        Tambah Galery</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="btn-group container" role="group">
                                                        <a href="{{ route('galery-op.create') }}"
                                                            class="btn btn-outline-primary btn-md">
                                                            <i class="bi bi-card-image"></i> Foto
                                                        </a>
                                                        <a href="{{ route('galery-op.create') }}"
                                                            class="btn btn-outline-primary btn-md">
                                                            <i class="bi bi-camera-video-fill"></i> video
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>
                                                        Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Default Tabs -->
                            <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                                <li class="nav-item flex-fill" role="presentation">
                                    <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab"
                                        data-bs-target="#home-justified" type="button" role="tab" aria-controls="home"
                                        aria-selected="true">Foto</button>
                                </li>
                                <li class="nav-item flex-fill" role="presentation">
                                    <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#profile-justified" type="button" role="tab"
                                        aria-controls="profile" aria-selected="false">Video</button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2" id="myTabjustifiedContent">
                                <div class="tab-pane fade show active" id="home-justified" role="tabpanel"
                                    aria-labelledby="home-tab">
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
                                            @foreach ($fotos as $foto)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $foto->name }}</td>
                                                    <td>{{ $foto->keterangan }}</td>
                                                    <td>{{ $foto->tanggal }}</td>
                                                    <td>{{ Helpers::GetDate($foto->created_at) }}</td>
                                                    <td>{{ $foto->updated_at == null ? 'None' : Helpers::GetDate($foto->updated_at) }}
                                                    <td>
                                                        <a href="{{ route('galery-op.edit', $foto->id) }}"
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
                                                                                class="bi bi-exclamation-octagon-fill"></i>
                                                                            Hapus Postingan</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Galery Foto
                                                                            <strong><u>{{ $foto->name }}</u></strong>
                                                                            akan dihapus.<br /> Anda Yakin?
                                                                        </p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-outline-secondary"
                                                                            data-bs-dismiss="modal"><i
                                                                                class="bi bi-x-circle"></i> Tidak</button>
                                                                        <a href="{{ route('galery-op.destroy', $foto->id) }}"
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
                                <div class="tab-pane fade" id="profile-justified" role="tabpanel"
                                    aria-labelledby="profile-tab">
                                    <table class="table table-hover" id="video">
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
                                                    <td>{{ $video->name }}</td>
                                                    <td>{{ $video->keterangan }}</td>
                                                    <td>{{ $video->tanggal }}</td>
                                                    <td>{{ Helpers::GetDate($video->created_at) }}</td>
                                                    <td>{{ $video->updated_at == null ? 'None' : Helpers::GetDate($video->updated_at) }}
                                                    <td>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- End Default Tabs -->

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

@extends('admin.index')
@section('title', 'Pegawai')
@section('db-menu', 'show')
@section('db-pegawai', 'active')
@section('additional-css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('server/vendor/DataTables/DataTables-1.13.1/css/jquery.dataTables.min.css') }}" />
@endsection
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Pegawai</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin-pegawai.index') }}">Pegawai</a></li>
                    <li class="breadcrumb-item active">Data Pegawai</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12" style="float: right; margin-bottom: 2%;">
                <a href="{{ route('admin-pegawai.create') }}" class="btn btn-outline-primary btn-md"
                    style="float: right; margin-top: 5px;">
                    <i class="bi bi-person-add"></i> Tambah Pegawai
                </a>
            </div>
        </div>
        <section class="section">
            <div class="card" style="padding: 2%;">
                <div class="row">
                    <div class="col-lg-12">
                        @if (Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                                {{ Session::get('success') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    @foreach ($pegawais as $pegawai)
                        <div class="col-lg-3">
                            <div class="card" style="width: 18rem;">
                                <img src="{{ asset('uploads/pegawai/' . $pegawai->foto) }}" class="card-img-top"
                                    alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $pegawai->name }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $pegawai->nip }}</h6>
                                    <p class="card-text">{{ $pegawai->jabatan }}</p>
                                    <a href="#" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Ubah</a>
                                    <a href="#" class="btn btn-info btn-sm"><i class="bi bi-eye"></i> Detail</a>
                                    <button type="button" data-bs-toggle="modal"
                                        data-bs-target="#HapusPegawai{{ $loop->iteration }}"
                                        class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Hapus</button>
                                    @include('admin/pegawai/addons/_delete')
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{ $pegawais->links() }}
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

        $('#jenis_video').change(function() {
            var jenis_video = $('#jenis_video').val();

            if (jenis_video == 'non-upload') {
                $('#video_input').prop('type', 'text');
                $('#video_input').attr('placeholder', 'input link video');
            } else {
                $('#video_input').prop('type', 'file');
            }
        })
    </script>
@endsection

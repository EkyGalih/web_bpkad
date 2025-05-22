@extends('operator.index')
@section('title', 'Show Video')
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
                    <li class="breadcrumb-item"><a href="{{ route('banner-op-video.index') }}">Banner Video</a></li>
                    <li class="breadcrumb-item active">Daftar Video Banner</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="col-lg-2" style="float: right;">
                <button type="button" class="btn btn-outline-primary btn-md" data-bs-toggle="modal"
                    data-bs-target="#AddVideo" style="float: right; margin-top: 5px;">
                    <i class="bi bi-plus"></i> Tambah Video
                </button>
                @include('operator/galery/video/banner/addons/_upload')
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            {{ Session::get('success') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                @foreach ($video as $item)
                    <div class="col-lg-4">
                        <div class="card">
                            <iframe src="{{ $item->path }}"></iframe>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#DeleteVideo{{ $loop->iteration }}"><i class="bi bi-trash"></i>Hapus</button>

                            @include('admin/galery/video/banner/addons/_delete')
                        </div>
                    </div>
                @endforeach
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

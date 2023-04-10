@extends('admin.index')
@section('title', 'Tambah Banner Video')
@section('di-menu', 'show')
@section('di-video', 'active')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <div class="pagetitle">
                <h1>Tambah Banner Video</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('banner-video.index') }}">Banner</a></li>
                        <li class="breadcrumb-item active">Tambah Banner Video</li>
                    </ol>
                </nav>
            </div>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Tambah Banner Video</div>
                            <hr />
                            <form action="{{ route('galery-admin.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Jenis Video</label>
                                    <div class="col-sm-10">
                                        <select name="jenis_video" id="jenis_video" class="form-control">
                                            <option value="">--Pilih--</option>
                                            <option value="upload">Upload</option>
                                            <option value="non-upload">Non Upload</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Nama Galery</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Tanggal</label>
                                    <div class="col-sm-10">
                                        <input type="date" name="tanggal" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Keterangan</label>
                                    <div class="col-sm-10">
                                        <textarea name="keterangan" class="form-control"></textarea>
                                        <input type="hidden" name="galery_type_id" value="1">
                                    </div>
                                </div>
                                <div class="row mb-3" id="video">
                                    <label for="inputText" class="col-sm-2 col-form-label">Video</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="path" id="video_input" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <button class="btn btn-outline-warning btn-md" style="float: right;" type="reset">
                                            <i class="bi bi-arrow-clockwise"></i> Reset
                                        </button>
                                        <button class="btn btn-outline-success btn-md"
                                            style="float: right; margin-right: 2px;" type="submit">
                                            <i class="bi bi-plus"></i> Tambah
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('additional-js')
    <script src="{{ asset('server/js/jquery-5.3.1.js') }}"></script>
    <script>
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

@extends('admin.index')
@section('title', 'Ubah Banner Video')
@section('di-menu', 'show')
@section('di-video', 'active')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <div class="pagetitle">
                <h1>Ubah Banner Video</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('banner-video.index') }}">Banner</a></li>
                        <li class="breadcrumb-item active">Ubah Banner Video</li>
                    </ol>
                </nav>
            </div>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Ubah Banner Video</div>
                            <hr />
                            <form action="{{ route('galery-admin.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Nama Galery</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" value="{{ $banner->name }}"
                                            class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Tanggal</label>
                                    <div class="col-sm-10">
                                        <input type="date" name="tanggal" value="{{ $banner->tanggal }}"
                                            class="form-control @error('tanggal') is-invalid @enderror">
                                        @error('tanggal')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Keterangan</label>
                                    <div class="col-sm-10">
                                        <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror">{{ $banner->keterangan }}</textarea>
                                        @error('keterangan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <input type="hidden" name="galery_type_id" value="1">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <a href="{{ route('banner-video.index') }}" class="btn btn-secondary btn-md"
                                            style="float: right;">
                                            <i class="bi bi-backspace"></i> Kembali
                                        </a>
                                        <button class="btn btn-outline-success btn-md"
                                            style="float: right; margin-right: 2px;" type="submit">
                                            <i class="bi bi-save"></i> Simpan
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

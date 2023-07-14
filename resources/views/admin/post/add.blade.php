@extends('admin.index')
@section('title', 'Buat Berita/Artikel')
@section('additional-css')
    <link rel="stylesheet" href="{{ asset('server/vendor/tom-select/tom-select.css') }}">
    <style>
        .image_upload>input {
            display: none;
        }

        .images {
            max-width: 100%;
            max-height: auto;
        }
    </style>
@endsection
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <div class="pagetitle">
                <h1>Berita/Artikel</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('post-admin.index') }}">Berita/Artikel</a></li>
                        <li class="breadcrumb-item active">Buat Berita/Artikel</li>
                    </ol>
                </nav>
            </div>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Buat Berita/Artikel</div>
                            <hr />
                            <form action="{{ route('post-admin.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Kategori</label>
                                    <div class="col-sm-10">
                                        <select name="posts_category_id" class="form-control">
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($PostCategory as $category)
                                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Judul</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="title" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Agenda Kaban?</label>
                                    <div class="col-sm-10">
                                        <input type="radio" name="agenda_kaban" value="ya"> Ya
                                        <input type="radio" name="agenda_kaban" value="tidak" checked> Tidak
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Foto Berita</label>
                                    <div class="col-sm-10">
                                        <p class="image_upload">
                                            <label for="userImage">
                                                <a class="btn btn-primary btn-sm" rel="nofollow"><span
                                                        class='bi bi-upload'></span> Upload Foto</a>
                                            </label>
                                            <input type="file" name="foto_berita" id="userImage" accept="image/*"
                                                onchange="loadFile(event)">
                                        </p>
                                        <img class="images" id="post">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Kontent</label>
                                    <div class="col-sm-10">
                                        <textarea name="content" class="tinymce-editor"></textarea><!-- End TinyMCE Editor -->
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Caption</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="caption" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Tags</label>
                                    <div class="col-sm-10">
                                        <input id="input-tags" autocomplete="off" placeholder="Tags" name="tags">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Waktu Upload</label>
                                    <div class="col-sm-2">
                                        <input id="date" type="date" name="date"
                                            class="form-control @error('date') is-invalid @enderror">
                                        @error('date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-2">
                                        <input id="time" type="time" name="time"
                                            class="form-control @error('time') is-invalid @enderror">
                                        @error('time')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success btn-md"
                                            style="float: right; margin-right: 2px;" type="submit">
                                            <i class="bi bi-save"></i> Simpan
                                        </button>
                                        <button class="btn btn-warning btn-md"
                                            style="float: right; margin-right: 2px;" type="reset">
                                            <i class="bi bi-arrow-clockwise"></i> Reset
                                        </button>
                                        <a class="btn btn-secondary btn-md" href="{{ route('post-admin.index') }}"
                                            style="float: right; margin-right: 2px;">
                                            <i class="bi bi-skip-backward"></i> Kembali
                                        </a>
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
    <script src="{{ asset('server/vendor/tom-select/tom-select.js') }}"></script>
    <script>
        new TomSelect("#input-tags", {
            persist: false,
            createOnBlur: true,
            create: true
        });

        // preview image
        var loadFile = function(event) {
            var output = document.getElementById('post');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
@endsection

@extends('admin.index')
@section('title', 'Edit Berita/Artikel')
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
                        <li class="breadcrumb-item active">Edit Berita/Artikel {{ $posts->title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Ubah Berita/Artikel</div>
                            <hr />
                            <form action="{{ route('post-admin.update', $posts->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Judul</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="title" class="form-control"
                                            value="{{ $posts->title }}">
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
                                        <img src="{{ asset($posts->foto_berita) }}" class="images" id="post">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Kontent</label>
                                    <div class="col-sm-10">
                                        <textarea name="content" class="tinymce-editor">{{ $posts->content }}</textarea><!-- End TinyMCE Editor -->
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Caption</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="caption" class="form-control"
                                            value="{{ $posts->caption }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Kategori</label>
                                    <div class="col-sm-10">
                                        <select name="posts_category_id" class="form-control">
                                            <option value="">-------</option>
                                            @foreach ($PostCategory as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $posts->posts_category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->category }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Tags</label>
                                    <div class="col-sm-10">
                                        <input id="input-tags" autocomplete="off" placeholder="Tags" name="tags"
                                            value="{{ $posts->tags }}">
                                    </div>
                                </div>
                                {{-- <div class="row mb-3">
                                    @php $created_at = explode(" ", $posts->created_at) @endphp
                                    <label for="inputText" class="col-sm-2 col-form-label">Waktu Upload</label>
                                    <div class="col-sm-2">
                                        <input id="date" type="date" name="date" value="{{ $created_at[0] }}"
                                            class="form-control @error('date') is-invalid @enderror">
                                        @error('date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-2">
                                        <input id="time" type="time" name="time" value="{{ $created_at[1] }}"
                                            class="form-control @error('time') is-invalid @enderror">
                                        @error('time')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="row mb-4">
                                    <div class="col-sm-12">
                                        <a class="btn btn-dark btn-md" href="{{ route('post-admin.index') }}"
                                            style="float: right">
                                            <i class="bi bi-skip-backward"></i> Kembali
                                        </a>
                                        <button class="btn btn-warning btn-md" style="float: right; margin-right: 2px;"
                                            type="reset">
                                            <i class="bi bi-arrow-clockwise"></i> Reset
                                        </button>
                                        <button class="btn btn-success btn-md"
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

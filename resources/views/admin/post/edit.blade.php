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

        #content {
            min-height: 400px; /* Atur tinggi minimum sesuai keinginan Anda */
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
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="col-sm-12">
                                            <label for="title" class="form-label">Judul <sup
                                                    style="color: red;">*</sup></label>
                                            <input type="text" id="title" name="title" class="form-control mb-3"
                                                required value="{{ $posts->title }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="slug" class="form-label">Slug <sup
                                                    style="color: red;">*</sup></label>
                                            <input type="text" id="slug" name="slug" class="form-control mb-3"
                                                required readonly value="{{ $posts->slug }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputText" class="form-label">Konten <sup
                                                    style="color: red;">*</sup></label>
                                            <textarea class="form-control" id="content" name="content">{{ $posts->content }}</textarea>
                                        </div>
                                        <div class="d-flex" style="float: right;">
                                            <button class="btn btn-success me-2" type="submit">
                                                <i class="bi bi-save"></i> Simpan
                                            </button>
                                            <button class="btn btn-warning me-2" type="reset">
                                                <i class="bi bi-arrow-clockwise"></i> Reset
                                            </button>
                                            <a class="btn btn-secondary" href="{{ route('post-admin.index') }}">
                                                <i class="bi bi-skip-backward"></i> Kembali
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="col-sm-12">
                                            <label for="inputText" class="col-form-label">Kategori <sup
                                                    style="color: red;">*</sup></label>
                                            <select name="posts_category_id" class="form-control mb-3">
                                                <option value="">Pilih Kategori</option>
                                                @foreach ($PostCategory as $category)
                                                    <option value="{{ $category->id }}" {{ $category->id == $posts->posts_category_id ? 'selected' : '' }}>{{ $category->category }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="inputText" class="col-form-label">Agenda Kaban? <sup
                                                    style="color: red;">*</sup></label>
                                            <input type="radio" name="agenda_kaban" value="ya" {{ $posts->agenda_kaban == 'ya' ? 'checked' : '' }}> Ya
                                            <input type="radio" name="agenda_kaban" value="tidak" {{ $posts->agenda_kaban == 'tidak' ? 'checked' : '' }}> Tidak
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="inputText" class="col-form-label">Foto Berita <sup
                                                    style="color: red;">*</sup></label>
                                            <p class="image_upload">
                                                <label for="userImage">
                                                    <a class="btn btn-primary btn-sm" rel="nofollow"><span
                                                            class='bi bi-upload'></span> Upload Foto</a>
                                                </label>
                                                <input type="file" name="foto_berita" id="userImage" accept="image/*"
                                                    onchange="loadFile(event)" value="{{ $posts->foto_berita }}">
                                            </p>
                                            <img class="images" id="post" src="{{ asset($posts->foto_berita) }}" style="max-height: 250px; max-width: 100%;">
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="inputText" class="col-form-label">Caption <sup
                                                    style="color: red;">*</sup></label>
                                            <input type="text" name="caption" class="form-control mb-3" value="{{ $posts->caption }}">
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="inputText" class="col-form-label">Tags</label>
                                            <input id="input-tags" autocomplete="off" class="mb-3" placeholder="Tags"
                                                name="tags" value="{{ $posts->tags }}">
                                        </div>
                                        <div class="row">
                                            <label for="inputText" class="col-form-label">Waktu Upload <sup
                                                    style="color: red;">*</sup></label>
                                            <div class="col-sm-6">
                                                <input id="date" type="date" name="date"
                                                    class="form-control mb-3 @error('date') is-invalid @enderror"
                                                    value="{{ $posts->created_at->format('Y-m-d') }}">
                                                @error('date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <input id="time" type="time" name="time"
                                                    class="form-control mb-3 @error('time') is-invalid @enderror"
                                                    value="{{ $posts->created_at->format('H:i') }}">
                                                @error('time')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
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
    <script src="{{ asset('server/vendor/ckeditor/ckeditor-classic.bundle.js') }}" type="text/javascript"></script>
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

        $(document).ready(function() {
            $('#title').on('keyup', function() {
                var slug = $(this).val()
                    .toLowerCase()
                    .replace(/\s+/g, '-') // Ganti spasi dengan -
                    .replace(/[^\w\-]+/g, '') // Hapus semua karakter non-word
                    .replace(/\-\-+/g, '-') // Ganti multiple - dengan single -
                    .replace(/^-+/, '') // Hapus - di awal teks
                    .replace(/-+$/, ''); // Hapus - di akhir teks
                $('#slug').val(slug);
            });

            ClassicEditor
                .create(document.querySelector('#content'), {
                    // Konfigurasi tambahan untuk CKEditor
                    height: 500 // Atur tinggi editor di sini
                })
                .then(editor => {
                    console.log(editor);
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
@endsection

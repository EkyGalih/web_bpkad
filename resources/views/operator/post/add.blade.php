@extends('operator.index')
@section('title', 'Tambah Post')
@section('additional-css')
    <link rel="stylesheet" href="{{ asset('server/vendor/tom-select/tom-select.css') }}">
@endsection
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <div class="pagetitle">
                <h1>Post</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('operator') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('post-op.index') }}">Post</a></li>
                        <li class="breadcrumb-item active">Tambah Post</li>
                    </ol>
                </nav>
            </div>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Tambah Postingan</div>
                            <hr />
                            <form action="{{ route('post-op.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Judul</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="title" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Foto Berita</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="foto_berita" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Kontent</label>
                                    <div class="col-sm-10">
                                        <textarea name="content" class="tinymce-editor"></textarea><!-- End TinyMCE Editor -->
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Kategori</label>
                                    <div class="col-sm-10">
                                        <select name="post_category_id" class="form-control">
                                            <option value="">-------</option>
                                            @foreach ($PostCategory as $category)
                                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Tags</label>
                                    <div class="col-sm-10">
                                        <input id="input-tags" autocomplete="off" placeholder="Tags" name="tags">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <button class="btn btn-outline-warning btn-md" style="float: right;" type="reset">
                                            <i class="bi bi-arrow-clockwise"></i> Reset
                                        </button>
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
    <script src="{{ asset('server/vendor/tom-select/tom-select.js') }}"></script>
    <script>
        new TomSelect("#input-tags", {
            persist: false,
            createOnBlur: true,
            create: true
        });
    </script>
@endsection

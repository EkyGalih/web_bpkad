@extends('admin.index')
@section('title', 'Edit Halaman')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <div class="pagetitle">
                <h1>Halaman</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('post-admin.index') }}">Halaman</a></li>
                        <li class="breadcrumb-item active">Edit Halaman {{ $pages->title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Ubah Halaman</div>
                            <hr />
                            <form action="{{ route('pages-admin.update', $pages->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-2 col-form-label">Jenis Pages</label>
                                            <div class="col-sm-10">
                                                <select name="jenis_link" class="form-control" id="jenis_link">
                                                    <option value="non-link" {{ $pages->jenis_link == 'non-link' ? 'selected' : '' }}>Tanpa Link</option>
                                                    <option value="link" {{ $pages->jenis_link == 'link' ? 'selected' : '' }}>Link</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3" id="content" {{ $pages->link != null ? 'hidden' : '' }}>
                                            <label for="inputText" class="col-sm-2 col-form-label">Kontent</label>
                                            <div class="col-sm-10">
                                                <textarea name="content" class="form-control" id="kontent">{{ $pages->content }}</textarea><!-- End TinyMCE Editor -->
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-2 col-form-label" id="label-link"
                                                {{ $pages->link == null ? 'hidden' : '' }}>Ekternal Link</label>
                                            <div class="col-sm-10">
                                                <input type="{{ $pages->link == null ? 'hidden' : '' }}" value="{{ $pages->link }}" name="link" class="form-control" id="link"
                                                    placeholder="https://example.com/example">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-2 col-form-label">Judul</label>
                                            <div class="col-sm-10">
                                                <input type="text" value="{{ $pages->title }}" id="title" name="title" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-2 col-form-label">Slug</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="slug" value="{{ $pages->slug }}" name="slug" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-2 col-form-label">Menu</label>
                                            <div class="col-sm-10">
                                                <select name="menu_id" id="menu_id" class="form-control" {{ $pages->link != null ? 'disabled' : '' }}>
                                                    <option value="">--Tanpa Menu--</option>
                                                    @foreach ($menus as $menu)
                                                        <option value="{{ $menu->id }}" {{ $menu->id == $pages->menu_id ? 'selected' : '' }}>{{ $menu->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-12">
                                                <button class="btn btn-outline-warning btn-md" style="float: right;"
                                                    type="reset">
                                                    <i class="bi bi-arrow-clockwise"></i> Reset
                                                </button>
                                                <button class="btn btn-outline-success btn-md"
                                                    style="float: right; margin-right: 2px;" type="submit">
                                                    <i class="bi bi-save"></i> Simpan
                                                </button>
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
    <script src="{{ asset('server/vendor/ckeditor/ckeditor-classic.bundle.js') }}" type="text/javascript"></script>
    <script>
        $('#jenis_link').change(function() {
            var jenis_link = $('#jenis_link').val();

            if (jenis_link == 'non-link') {
                $('#content').attr('hidden', false);
                $('#link').attr('hidden', true);
                $('#label-link').attr('hidden', true);
                $('#menu_id').attr('disabled', false);
            } else if (jenis_link == 'link'){
                $('#content').attr('hidden', true);
                $('#link').attr('hidden', false);
                $('#label-link').attr('hidden', false);
                $('#menu_id').attr('disabled', true);
            }
        });

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
                .create(document.querySelector('#kontent'), {
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

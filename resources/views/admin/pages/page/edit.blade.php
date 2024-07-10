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
                        <hr/>
                        <form action="{{ route('pages-admin.update', $pages->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Jenis Pages</label>
                                <div class="col-sm-10">
                                    <select name="jenis_link" class="form-control" id="jenis_link">
                                        <option value="non-link {{ $pages->link == null ? 'selected' : '' }}">Tanpa Link</option>
                                        <option value="link" {{ $pages->link != null ? 'selected' : '' }}>Link</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Judul</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control" value="{{ $pages->title }}">
                                </div>
                            </div>
                            <div class="row mb-3" id="content" {{ $pages->link != null ? 'hidden' : '' }}>
                                <label for="inputText" class="col-sm-2 col-form-label">Kontent</label>
                                <div class="col-sm-10">
                                    <textarea name="content" class="form-control" id="kontent">{{ $pages->content }}</textarea><!-- End TinyMCE Editor -->
                                </div>
                            </div>
                            <div class="row mb-3" id="link">
                                <label for="inputText" class="col-sm-2 col-form-label" id="label-link"
                                    {{ $pages->link != null ? '' : 'hidden' }}>Link</label>
                                <div class="col-sm-10">
                                    <input type="{{ $pages->link != null ? 'text' : 'hidden' }}" name="link" value="{{ $pages->link }}" class="form-control" id="link">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Menu</label>
                                <div class="col-sm-10">
                                    <select name="menu_id" class="form-control">
                                        <option value="">---Tanpa Menu--</option>
                                        @foreach ($menus as $menu)
                                        <option value="{{ $menu->id }}" {{ $pages->menu_id == $menu->id ? 'selected' : '' }}>{{ $menu->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <button class="btn btn-outline-warning btn-md" style="float: right;" type="reset">
                                        <i class="bi bi-arrow-clockwise"></i> Reset
                                    </button>
                                    <button class="btn btn-outline-success btn-md" style="float: right; margin-right: 2px;" type="submit">
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
    <script src="{{ asset('server/vendor/ckeditor/ckeditor-classic.bundle.js') }}" type="text/javascript"></script>
    <script>
        $('#jenis_link').change(function() {
            var jenis_link = $('#jenis_link').val();
            console.log(jenis_link);
            if (jenis_link == 'non-link') {
                $('#content').attr('hidden', false);
            } else {
                $('#link').attr('hidden', false);
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

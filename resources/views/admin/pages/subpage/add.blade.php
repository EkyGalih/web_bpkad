@extends('admin.index')
@section('title', 'Tambah Sub Halaman')
@section('pages-menu', 'show')
@section('p-subpages', 'active')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <div class="pagetitle">
                <h1>Halaman</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pages-admin.index') }}">Sub Halaman</a></li>
                        <li class="breadcrumb-item active">Tambah Sub Halaman</li>
                    </ol>
                </nav>
            </div>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Tambah Sub Halaman</div>
                            <hr />
                            <form action="{{ route('subpages-admin.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Jenis Sub Pages</label>
                                    <div class="col-sm-10">
                                        <select name="jenis_link" class="form-control" id="jenis_link">
                                            <option value="non-link">Tanpa Link</option>
                                            <option value="link">Link</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Judul</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="title" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3" id="content">
                                    <label for="inputText" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <textarea name="content" class="tinymce-editor"></textarea><!-- End TinyMCE Editor -->
                                    </div>
                                </div>
                                <div class="row mb-3" id="pdf_file">
                                    <label for="inputtext" class="col-sm-2 col-form-label">File</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="pdf_file">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Menu</label>
                                    <div class="col-sm-10">
                                        <select name="sub_pages_id" class="form-control">
                                            <option value="">--Tanpa Menu--</option>
                                            @foreach ($pages as $item)
                                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label" id="label-link"
                                        hidden>Link</label>
                                    <div class="col-sm-10">
                                        <input type="hidden" name="link" class="form-control" id="link">
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
    <script>
        $('#jenis_link').change(function() {
            var jenis_link = $('#jenis_link').val();

            if (jenis_link == 'non-link') {
                $('#label-link').attr('hidden', true);
                $('#link').prop('type', 'hidden');
                $('#content').attr('hidden', false);
                $('#pdf_file').attr('hidden', false);
            } else {
                $('#link').prop('type', 'text');
                $('#content').attr('hidden', true);
                $('#pdf_file').attr('hidden', true);
                $('#label-link').removeAttr('hidden');
            }
        })
    </script>
@endsection

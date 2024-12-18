@extends('operator.index')
@section('title', 'Edit Sub Halaman')
@section('pages-menu', 'show')
@section('p-subpages', 'active')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <div class="pagetitle">
                <h1>Halaman</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('operator') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pages-op.index') }}">Sub Halaman</a></li>
                        <li class="breadcrumb-item active">Edit Sub Halaman {{ $subpages->title }}</li>
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
                            <form action="{{ route('subpages-op.update', $subpages->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Jenis Link</label>
                                    <div class="col-sm-10">
                                        <select name="jenis_link" class="form-control" id="jenis_link">
                                            <option value="non-link"
                                                {{ $subpages->jenis_link == 'non-link' ? 'selected' : '' }}>Tanpa
                                                Link</option>
                                            <option value="link" {{ $subpages->jenis_link == 'link' ? 'selected' : '' }}>Link
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Judul</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="title" class="form-control"
                                            value="{{ $subpages->title }}">
                                    </div>
                                </div>
                                <div class="row mb-3" id="content" {{ $subpages->jenis_link == 'link' ? 'hidden' : '' }}>
                                    <label for="inputText" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <textarea name="content" class="tinymce-editor">{{ $subpages->content }}</textarea><!-- End TinyMCE Editor -->
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Pages</label>
                                    <div class="col-sm-10">
                                        <select name="sub_pages_id" class="form-control">
                                            <option value="">---Tanpa Sub Menu--</option>
                                            @foreach ($pages as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $subpages->sub_pages_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3" id="link" {{ $subpages->jenis_link == 'link' ? '' : 'hidden' }}>
                                    <label for="inputText" class="col-sm-2 col-form-label">Link</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="link" value="{{ $subpages->link }}"
                                            class="form-control" id="link">
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
                $('#content').attr('hidden', false);
                $('#link').attr('hidden', true);
            } else {
                $('#link').attr('hidden', false);
                $('#content').attr('hidden', true);
            }
        })
    </script>
@endsection

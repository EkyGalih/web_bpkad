@extends('admin.index')
@section('title', 'Tambah Halaman')
@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <div class="pagetitle">
            <h1>Halaman</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('pages-admin.index') }}">Halaman</a></li>
                    <li class="breadcrumb-item active">Tambah Halaman</li>
                </ol>
            </nav>
        </div>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Tambah Halaman</div>
                        <hr/>
                        <form action="{{ route('pages-admin.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Judul</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <textarea name="content" class="tinymce-editor"></textarea><!-- End TinyMCE Editor -->
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Menu</label>
                                <div class="col-sm-10">
                                    <select name="menu_id" class="form-control">
                                        <option value="">--Tanpa Menu--</option>
                                        @foreach ($menus as $menu)
                                        <option value="{{ $menu->id }}">{{ $menu->name }}</option>
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

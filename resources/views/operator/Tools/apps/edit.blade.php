@extends('operator.index')
@section('title', 'Update Apps')
@section('menu-tools', 'show')
@section('tools-apps', 'active')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <div class="pagetitle">
                <h1>Update Apps</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('operator') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('apps-op.index') }}">Daftar Apps</a></li>
                        <li class="breadcrumb-item active">Update Apps</li>
                    </ol>
                </nav>
            </div>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Update Apps</div>
                            <hr />
                            <form action="{{ route('apps-op.update', $app->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Nama Aplikasi</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" value="{{ $app->name }}" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Versi Aplikasi</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="versi" value="{{ $app->versi }}" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Deskripsi</label>
                                    <div class="col-sm-10">
                                        <textarea name="deskripsi" class="form-control">{{ $app->deskripsi }}</textarea><!-- End TinyMCE Editor -->
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Url</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="url" value="{{ $app->url }}" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Icon</label>
                                    <div class="col-sm-10">
                                        <input type='file' name="icon" onchange="readURL(this);" /><br/><br/>
                                        <img id="blah" src="{{ asset($app->icon) }}" height="200" width="200" alt="your image" />
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
<script src="{{ asset('server/js/jquery-5.3.1.js') }}"></script>
    <script>
         function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection

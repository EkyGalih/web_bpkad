@extends('admin.index')
@section('title', 'Upload Foto')
@section('di-menu', 'show')
@section('di-galery', 'active')
@section('additional-css')
<script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
<link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <div class="pagetitle">
                <h1>Upload Foto</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('galery-admin.index') }}">Galery</a></li>
                        <li class="breadcrumb-item active">Upload Foto</li>
                    </ol>
                </nav>
            </div>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Upload Foto</div>
                            <hr />
                            <form action="{{ route('Gfoto-admin.store') }}" method="POST" enctype="multipart/form-data" id="image-upload" class="dropzone">
                                <input type="hidden" name="galery_id" value="{{ $id }}">
                                @csrf
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
        new Dropzone("#image-upload", {
            thumbnailWidth:200,
            maxFilesize:5,
            acceptedFiles:".jpeg,.jpg,.png,.gif"
        });
    </script>
@endsection

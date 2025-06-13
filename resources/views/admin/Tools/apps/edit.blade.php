@extends('admin.index')
@section('title', 'Edit Apps')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">Edit Aplikasi</h4>
                </div>
            </div>
            <form action="{{ route('apps.update', $apps->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row form-floating form-floating-outline mb-6">
                        <input type="text" id="name" placeholder="Nama Aplikasi" name="name"
                            class="form-control" value="{{ $apps->name }}">
                        <label for="name">Nama Aplikasi</label>
                    </div>
                    <div class="row form-floating form-floating-outline mb-6">
                        <input type="text" id="versi" placeholder="Versi Aplikasi (misal: 1.01)" name="versi"
                            class="form-control" pattern="^\d+(\.\d+)?$" title="Masukkan versi dengan format angka, misal: 1.01" value="{{ $apps->versi }}">
                        <label for="versi">Versi Aplikasi</label>
                    </div>
                    <div class="row form-floating form-floating-outline mb-6">
                        <textarea id="deskripsi" placeholder="Deskripsi" name="deskripsi" class="form-control">{{ $apps->deskripsi }}</textarea>
                        <label for="deskripsi">Deskripsi</label>
                    </div>
                    <div class="row form-floating form-floating-outline mb-6">
                        <input type="text" id="url" placeholder="Url" name="url" class="form-control" value="{{ $apps->url }}">
                        <label for="url">Url</label>
                    </div>
                    <div class="row form-floating form-floating-outline mb-6">
                        <div class="col-md-6">
                            <input type='file' id="icon" name="icon" class="form-control mb-6"
                            onchange="readURL(this);" accept="image/*" />
                        </div>
                        <div class="col-md-4">
                            <img id="blah" src="{{ $apps->icon ? asset($apps->icon) : asset('static/images/no_image.png') }}" height="150" width="150" alt="your image" />
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end gap-2">
                        <button class="btn btn-outline-secondary" type="reset">
                            <i class="icon-base ri ri-arrow-left-box-line icon-18px me-2"></i> Kembali
                        </button>
                        <button class="btn btn-outline-success" type="submit">
                            <i class="icon-base ri ri-save-3-line icon-18px me-2"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('server/js/jquery-5.3.1.js') }}"></script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
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

@extends('admin.index')
@section('title', 'Tambah Galery')
@section('styles')
    <link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/dropzone/dropzone.css') }}" />
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">Tambah Galery</h4>
                </div>
            </div>
            <form action="#" class="dropzone" id="dropzoneForm" enctype="multipart/form-data">
                @csrf
                <div class="form-floating form-floating-outline mb-4">
                    <input type="text" name="name" id="name" placeholder="Nama Galery" class="form-control">
                    <label for="name">Nama Galery</label>
                </div>

                <div class="dz-message">
                    Drop files here or click to upload
                </div>

                <div class="fallback">
                    <input name="file" type="file" multiple />
                </div>
            </form>

        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('server/assets/vendor/libs/dropzone/dropzone.js') }}"></script>
    <script>
        Dropzone.autoDiscover = false;

        const myDropzone = new Dropzone("#dropzoneForm", {
            paramName: "file", // Nama parameter yang dikirim ke server
            maxFilesize: 5, // MB
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            dictDefaultMessage: "Drop gambar di sini atau klik untuk upload",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            init: function() {
                this.on("success", function(file, response) {
                    console.log('Upload berhasil:', response);
                });

                this.on("error", function(file, errorMessage) {
                    console.error('Upload gagal:', errorMessage);
                });
            }
        });
    </script>
@endsection

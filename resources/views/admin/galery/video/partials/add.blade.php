@extends('admin.index')
@section('title', 'Tambah Galery')
@section('styles')
    <link href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" rel="stylesheet">
    <style>
        .dropzone {
            border: 2px dashed #0d6efd;
            padding: 30px;
            background: #f8f9fa;
        }
    </style>
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">Tambah Video Galery {{ $galery->name }}</h4>
                    <a href="{{ route('galery-video.show', $galery->id) }}" class="btn btn-outline-primary ms-3">
                        <i class="icon-base ri ri-eye-fill me-2"></i> Lihat Galery
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('galery-video.store') }}" class="dropzone" id="my-dropzone" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="galery_id" value="{{ $galery->id }}">
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script>
        Dropzone.options.myDropzone = {
            paramName: 'file',
            method: 'post',
            maxFilesize: 10,
            acceptedFiles: ".mp4",
            dictInvalidFileType: "Format file tidak didukung. Hanya MP4.",
            dictFileTooBig: "Maksimal: 10MB.",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            sending: function(file, xhr, formData) {
                formData.append('galery_id', '{{ $galery->id }}');
            },
            success: function(file, response) {
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    icon: 'success',
                    title: 'Video ditambahkan ke galery',
                    showConfirmButton: false,
                    timer: 1200,
                    timerProgressBar: true,
                    customClass: {
                        popup: 'p-1',
                        title: 'fs-6'
                    }
                });
            },
            error: function(file, response) {
                let message = "";

                if (typeof response === "object" && response.errors) {
                    if (response.errors.file) {
                        message = response.errors.file.join('<br>');
                    } else {
                        message = Object.values(response.errors).flat().join('<br>');
                    }
                } else if (typeof response === "string") {
                    message = response;
                }

                Swal.fire({
                    icon: 'warning',
                    title: message,
                    showConfirmButton: true,
                });
                this.removeFile(file);
            }
        };
    </script>
@endsection

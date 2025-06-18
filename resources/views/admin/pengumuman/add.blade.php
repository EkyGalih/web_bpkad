@extends('admin.index')
@section('title', 'Buat Pengumuman')
@section('styles')
    <link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/select2/select2.css') }}">
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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">Tambah Pengumuman</h4>
                    </div>
                </div>
                <form id="form" action="{{ route('pengumuman.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-floating form-floating-outline mb-6">
                                    <input type="text" id="title" name="title" value="{{ old('title') }}"
                                        class="form-control" required placeholder="title" />
                                    <label for="title">Judul Informasi <sup class="text-danger">*</sup></label>
                                </div>
                                <div class="form-floating form-floating-outline mb-6">
                                    <textarea type="text" id="keterangan" value="{{ old('keterangan') }}" name="keterangan" class="form-control"
                                        placeholder="Keterangan" required></textarea>
                                    <label for="keterangan">Keterangan <sup class="text-danger">*</sup></label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="small fw-medium mb-3">Foto</div>
                                <div id="my-dropzone" class="dropzone" class="mb-6"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-3">
                        <div class="d-flex justify-content-end align-items-center mb-3">
                            <button class="btn btn-outline-primary me-2" type="button" id="submitBtn">
                                <i class="icon-base ri ri-add-large-line me-2"></i> Tambah
                            </button>
                            <a class="btn btn-outline-secondary" href="{{ route('pengumuman.index') }}">
                                <i class="icon-base ri ri-skip-back-line"></i> Kembali
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('server/assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script>
        Dropzone.autoDiscover = false;

        const myDropzone = new Dropzone("#my-dropzone", {
            url: "{{ route('pengumuman.store') }}", // atau sama seperti `form.action`
            autoProcessQueue: false,
            uploadMultiple: false,
            maxFiles: 1,
            paramName: 'file',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            // Data tambahan ke backend
            sending: function(file, xhr, formData) {
                formData.append("title", document.getElementById("title").value);
                formData.append("keterangan", document.getElementById("keterangan").value);
            },
            success: function(file, response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Pengumuman berhasil disimpan',
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = "{{ route('pengumuman.index') }}";
                });
            },
            error: function(file, response) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: typeof response === 'string' ? response : (response.message ||
                        'Terjadi kesalahan')
                });
                this.removeFile(file);
            }
        });

        // Submit button event
        document.getElementById("submitBtn").addEventListener("click", function(e) {
            e.preventDefault();

            const title = document.getElementById("title").value.trim();
            const keterangan = document.getElementById("keterangan").value.trim();

            if (!title || !keterangan) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Judul dan keterangan wajib diisi'
                });
                return;
            }

            if (myDropzone.getAcceptedFiles().length > 0) {
                myDropzone.processQueue();
            } else {
                // Kirim form manual via AJAX jika tanpa file
                const form = document.getElementById("form");
                const formData = new FormData(form);

                fetch(form.action, {
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Pengumuman berhasil disimpan',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = "{{ route('pengumuman.index') }}";
                        });
                    })
                    .catch(error => {
                        console.error(error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi kesalahan saat mengirim form'
                        });
                    });
            }

            myDropzone.processQueue();
        });
    </script>

@endsection

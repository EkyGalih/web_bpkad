@extends('admin.index')
@section('title', 'Tambah Sub Halaman')
@section('styles')
    <link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/quill/editor.css') }}">
    <link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/select2/select2.css') }}">
    <style>
        #pdf-file-group {
            overflow: hidden;
            max-height: 0;
            opacity: 0;
            transition: all 0.5s ease;
            display: flex;
            /* tetap menggunakan flex agar sesuai layout */
            flex-wrap: wrap;
        }

        #pdf-file-group.show {
            max-height: 50vh;
            /* sesuaikan sesuai tinggi elemen */
            opacity: 1;
        }

        #content-editor {
            overflow: hidden;
            max-height: 50vh;
            /* tinggi normal saat tampil */
            opacity: 1;
            transition: max-height 0.5s ease, opacity 0.5s ease;
        }

        #content-editor.hidden {
            max-height: 0;
            opacity: 0;
            pointer-events: none;
        }
    </style>
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card" id="card-subpage">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">Tambah Sub Halaman</h4>
                </div>
            </div>
            <form action="{{ route('subpages-admin.store') }}" id="form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5" id="form-subpage">
                            <div class="form-floating form-floating-outline mb-6">
                                <label for="jenis_link" class="form-label">Jenis Pages</label>
                                <select name="jenis_link" id="jenis_link" class="select2 form-select"
                                    data-allow-clear="true">
                                    <option value="">Pilih Jenis Link</option>
                                    <option value="non-link" {{ old('jenis_link') == 'non-link' ? 'selected' : '' }}>Tanpa
                                        Link</option>
                                    <option value="link" {{ old('jenis_link') == 'link' ? 'selected' : '' }}>Link</option>
                                </select>
                            </div>
                            <div class="form-floating form-floating-outline mb-6">
                                <input type="{{ old('jenis_link') == 'link' ? 'non-link' : 'hidden' }}" name="link"
                                    class="form-control" id="link"
                                    placeholder="https://example.com/example or /example" value="{{ old('link') }}">
                                <label for="link" id="label-link"
                                    {{ old('jenis_link') == 'link' ? 'link' : 'hidden' }}>Ekternal
                                    Link</label>
                            </div>
                            <div class="form-floating form-floating-outline mb-6">
                                <input type="text" name="title" placeholder="Judul Halaman" id="title"
                                    class="form-control" value="{{ old('title') }}">
                                <label for="title">Judul Halaman</label>
                            </div>
                            <div class="form-floating form-floating-outline mb-6">
                                <input type="text" id="slug" placeholder="Slug" name="slug" class="form-control"
                                    readonly value="{{ old('slug') }}">
                                <label for="slug">Slug</label>
                            </div>
                            <div class="form-floating form-floating-outline mb-6">
                                <select id="sub_pages_id" name="sub_pages_id" class="form-select select2">
                                    <option value="">Tanpa Menu</option>
                                    @foreach ($pages as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('sub_pages_id') == $item->id ? 'selected' : '' }}>{{ $item->title }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="inputText" class="col-sm-2 col-form-label">Menu</label>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="mb-3" id="content-editor">
                                <div id="full-editor">{!! old('content') !!}</div>
                                <input type="hidden" name="content" id="quill-content" value="{{ old('content') }}">
                            </div>
                            <!-- Input File -->
                            <div class="row mb-3 show" id="pdf-file-group">
                                <div class="small fw-medium mb-3">Upload PDF</div>

                                <div id="pdf-dropzone" class="mb-4"
                                    style="border: 2px dashed #ccc; padding: 20px; text-align: center; cursor: pointer; border-radius: 6px;">
                                    <input type="file" id="pdfInput" name="pdf_file" accept="application/pdf"
                                        style="display: none;" />
                                    <div id="pdf-drop-text" style="color: #999;">Drop file PDF di sini atau klik untuk
                                        upload</div>
                                </div>

                                <div id="pdf-preview-wrapper" style="display: none; margin-top: 10px;"
                                    data-old-pdf-url="{{ old('pdf_file') }}">
                                    <div style="margin-top: 25px; text-align: right;">
                                        <button class="btn btn-circle btn-outline-danger btn-xs" type="button"
                                            id="remove-pdf" data-bs-tooltip="tooltip" data-bs-placement="left"
                                            title="Hapus PDF">
                                            <i class="icon-base ri ri-close-line icon-18px"></i>
                                        </button>
                                    </div>
                                    <embed id="pdfPreview" type="application/pdf"
                                        style="width: 100%; height: 90vh; border: 1px solid #ccc; border-radius: 6px;" />
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end gap-2">
                        <a class="btn btn-outline-secondary" href="{{ route('subpages-admin.index') }}">
                            <i class="icon-base ri ri-skip-back-line"></i> Kembali
                        </a>
                        <button class="btn btn-primary btn-lg" type="submit">
                            <i class="icon-base ri ri-add-large-line icon-18px me-2"></i> Tambah
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('server/assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('server/assets/vendor/libs/quill/quill.js') }}"></script>
    <script src="{{ asset('server/assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('server/assets/js/forms-editors.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script>
        // add slug generation from title
        $(document).ready(function() {
            $('#title').on('keyup', function() {
                var slug = $(this).val()
                    .toLowerCase()
                    .replace(/\s+/g, '-') // Ganti spasi dengan -
                    .replace(/[^\w\-]+/g, '') // Hapus semua karakter non-word
                    .replace(/\-\-+/g, '-') // Ganti multiple - dengan single -
                    .replace(/^-+/, '') // Hapus - di awal teks
                    .replace(/-+$/, ''); // Hapus - di akhir teks

                $.ajax({
                    url: '/check-slug-sub',
                    method: 'GET',
                    data: {
                        slug: slug
                    },
                    success: function(response) {
                        $('#slug').val(response.slug);
                    }
                });
            });
        });
    </script>
@endsection

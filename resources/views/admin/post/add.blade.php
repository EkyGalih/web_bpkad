@extends('admin.index')
@section('title', 'Buat Berita/Artikel')
@section('styles')
    <link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/quill/editor.css') }}">
    <link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/tagify/tagify.css') }}">
    <link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/flatpickr/flatpickr.css') }}">
    <style>
        #dropzone-box {
            border: 2px dashed #bbb;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            border-radius: 10px;
            background-color: #f9f9f9;
            transition: background-color 0.3s;
        }

        #dropzone-box:hover {
            background-color: #f1f1f1;
        }

        #dropzone-box.dragover {
            background-color: #e0f7fa;
            border-color: #00acc1;
        }

        #preview-img {
            margin-top: 10px;
            max-height: 200px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .dragover {
            border-color: #007bff;
            background-color: #f0f8ff;
        }
    </style>

@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">Tambah Berita/Artikel</h4>
                        <d class="flex gap-2">
                            <a class="btn btn-secondary" href="{{ route('post-admin.index') }}">
                                <i class="icon-base ri ri-skip-back-line"></i> Kembali
                            </a>
                        </d>
                    </div>
                </div>
                <form action="{{ route('post-admin.store') }}" id="form" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-floating form-floating-outline mb-6">
                                    <input type="text" id="title" name="title" value="{{ old('title') }}"
                                        class="form-control" required placeholder="title" />
                                    <label for="title">Judul <sup class="text-danger">*</sup></label>
                                </div>
                                <div class="form-floating form-floating-outline mb-6">
                                    <input type="text" id="slug" value="{{ old('slug') }}" name="slug"
                                        class="form-control" placeholder="slug" required readonly>
                                    <label for="slug">Slug <sup class="text-danger">*</sup></label>
                                </div>
                                <div class="mb-3">
                                    <div id="full-editor"></div>
                                    <input type="hidden" name="content" id="quill-content">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-floating form-floating-outline mb-6">
                                    <label class="form-label" for="post_category_id">Kategori <sup
                                            class="text-danger">*</sup></label>
                                    <select id="post_category_id" name="posts_category_id" class="select2 form-select"
                                        data-allow-clear="true">
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($PostCategory as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('posts_category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->category }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="small fw-medium mb-3">Foto Headline</div>
                                <div id="dropzone-box" class="mb-6"
                                    style="border: 2px dashed #ccc; padding: 20px; text-align: center; cursor: pointer; position: relative;">
                                    <input type="file" name="foto_berita" id="foto_berita" style="display: none;" value="{{ $post->foto_berita ?? '' }}"
                                        accept="image/*" />

                                    <div id="dropzone-text" style="color: #999;">Drop file di sini atau klik untuk upload
                                    </div>

                                    <div id="image-preview-wrapper"
                                        style="position: relative; display: none; margin-top: 10px;">
                                        <img id="preview-img" src=""
                                            style="max-width: 100%; max-height: 300px; display: block; margin: auto; border-radius: 6px;" />
                                        <button type="button" id="remove-preview"
                                            style="
                                            position: absolute;
                                            top: 5px;
                                            right: 5px;
                                            background: rgba(0, 0, 0, 0.6);
                                            color: white;
                                            border: none;
                                            border-radius: 50%;
                                            width: 28px;
                                            height: 28px;
                                            cursor: pointer;
                                            font-size: 18px;
                                            line-height: 1;
                                            display: flex;
                                            align-items: center;
                                            justify-content: center;
                                            z-index: 10;
                                        ">&times;</button>
                                    </div>
                                </div>
                                <div class="form-floating form-floating-outline mb-6">
                                    <input type="text" name="caption" placeholder="Caption" class="form-control"
                                        value="{{ old('caption') }}">
                                    <label for="caption">Caption <sup class="text-danger">*</sup></label>
                                </div>
                                <div class="form-floating form-floating-outline mb-6">
                                    <input id="TagifyCustomInlineSuggestion" name="tags" class="form-control h-auto"
                                        placeholder="Pilih Tags" value="{{ old('tags') }}" />
                                    <label for="TagifyCustomInlineSuggestion">Tags</label>
                                </div>
                                {{-- <div class="form-floating form-floating-outline">
                                    <input type="text" name="datetime" class="form-control"
                                        placeholder="YYYY-MM-DD HH:MM" id="waktu-upload" />
                                    <label for="waktu-upload">Waktu Upload</label>
                                </div> --}}
                                <div class="small fw-medium mb-3">Agenda Kaban?</div>

                                <input type="hidden" name="agenda_kaban" value="tidak" />

                                <label class="switch switch-success switch-square switch-lg mb-6">
                                    <input type="checkbox" class="switch-input" name="agenda_kaban" value="ya"
                                        {{ old('agenda_kaban') == 'ya' ? 'checked' : '' }} />
                                    <span class="switch-toggle-slider">
                                        <span class="switch-on"><i class="icon-base ri ri-check-line"></i></span>
                                        <span class="switch-off"><i class="icon-base ri ri-close-line"></i></span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-3">
                        <div class="d-flex justify-content-end align-items-center mb-3">
                            <button class="btn btn-primary me-2" type="submit">
                                <i class="icon-base ri ri-add-large-line me-2"></i> Tambah
                            </button>
                            <button class="btn btn-warning" type="reset">
                                <i class="icon-base ri ri-reset-left-line me-2"></i> Reset
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('server/assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('server/assets/vendor/libs/tagify/tagify.js') }}"></script>
    <script src="{{ asset('server/assets/vendor/libs/quill/quill.js') }}"></script>
    <script src="{{ asset('server/assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('server/assets/js/forms-selects.js') }}"></script>
    <script>
        window.availableTags = @json($tags);
    </script>
    <script src="{{ asset('server/assets/js/forms-tagify.js') }}"></script>
    <script src="{{ asset('server/assets/js/forms-editors.js') }}"></script>
    <script src="{{ asset('server/assets/js/forms-file-upload.js') }}"></script>
    <script src="{{ asset('server/assets/js/forms-pickers.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#title').on('keyup', function() {
                var slug = $(this).val()
                    .toLowerCase()
                    .replace(/\s+/g, '-') // Ganti spasi dengan -
                    .replace(/[^\w\-]+/g, '') // Hapus semua karakter non-word
                    .replace(/\-\-+/g, '-') // Ganti multiple - dengan single -
                    .replace(/^-+/, '') // Hapus - di awal teks
                    .replace(/-+$/, ''); // Hapus - di akhir teks
                $('#slug').val(slug);
            });
        });
    </script>
@endsection

@extends('admin.index')
@section('title', 'Tambah Sub Halaman')
@section('styles')
    <link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/quill/editor.css') }}">
    <link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/select2/select2.css') }}">
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">Tambah Sub Halaman</h4>
                    <d class="flex gap-2">
                        <a class="btn btn-secondary" href="{{ route('subpages-admin.index') }}">
                            <i class="icon-base ri ri-skip-back-line"></i> Kembali
                        </a>
                    </d>
                </div>
            </div>
            <form action="{{ route('subpages-admin.store') }}" id="form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-5">
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
                                <input type="{{ old('jenis_link') == 'link' ? 'text' : 'hidden' }}" name="link"
                                    class="form-control" id="link"
                                    placeholder="https://example.com/example or /example" value="{{ old('link') }}">
                                <label for="link" id="label-link"
                                    {{ old('jenis_link') == 'link' ? '' : 'hidden' }}>Ekternal
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
                                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                                    @endforeach
                                </select>
                                <label for="inputText" class="col-sm-2 col-form-label">Menu</label>
                            </div>
                            <div class="row mb-3" id="pdf_file">
                                <label for="inputtext" class="col-sm-2 col-form-label">File</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="pdf_file">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="mb-3">
                                <div id="full-editor">{!! old('content') !!}</div>
                                <input type="hidden" name="content" id="quill-content" value="{{ old('content') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end gap-2">
                        <button class="btn btn-outline-warning btn-md" style="float: right;" type="reset">
                            <i class="bi bi-arrow-clockwise"></i> Reset
                        </button>
                        <button class="btn btn-outline-success btn-md" style="float: right; margin-right: 2px;"
                            type="submit">
                            <i class="bi bi-save"></i> Simpan
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
    <script>
        $('#jenis_link').change(function() {
            var jenis_link = $('#jenis_link').val();

            if (jenis_link == 'non-link') {
                $('#label-link').attr('hidden', true);
                $('#link').prop('type', 'hidden');
                $('#content').attr('hidden', false);
                $('#pdf_file').attr('hidden', false);
            } else {
                $('#link').prop('type', 'text');
                $('#content').attr('hidden', true);
                $('#pdf_file').attr('hidden', true);
                $('#label-link').removeAttr('hidden');
            }
        });

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

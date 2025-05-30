@extends('admin.index')
@section('title', 'Edit Halaman')
@section('styles')
    <link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/quill/editor.css') }}">
    <link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/select2/select2.css') }}">
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">Tambah Halaman</h4>
                    <d class="flex gap-2">
                        <a class="btn btn-secondary" href="{{ route('pages-admin.index') }}">
                            <i class="icon-base ri ri-skip-back-line"></i> Kembali
                        </a>
                    </d>
                </div>
            </div>
            <form action="{{ route('pages-admin.update', $page->id) }}" id="form" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline mb-6">
                                <label for="jenis_link" class="form-label">Jenis Pages</label>
                                <select name="jenis_link" id="jenis_link" class="select2 form-select" data-allow-clear="true">
                                    <option value="">Pilih Jenis Link</option>
                                    <option value="non-link" {{ $page->jenis_link == 'non-link' ? 'selected' : '' }}>Tanpa Link</option>
                                    <option value="link" {{ $page->jenis_link == 'link' ? 'selected' : '' }}>Link</option>
                                </select>
                            </div>
                            <div class="form-floating form-floating-outline mb-6">
                                <input type="{{ $page->jenis_link == 'link' ? 'text' : 'hidden' }}" name="link" class="form-control" id="link"
                                    placeholder="https://example.com/example or /example" value="{{ old('link', $page->link) }}">
                                <label for="link" id="label-link" {{ $page->jenis_link == 'link' ? '' : 'hidden' }}>Ekternal
                                    Link</label>
                            </div>
                            <div class="form-floating form-floating-outline mb-6">
                                <input type="text" name="title" placeholder="Judul Halaman" id="title"
                                    class="form-control" value="{{ old('title', $page->title) }}">
                                <label for="title">Judul Halaman</label>
                            </div>
                            <div class="form-floating form-floating-outline mb-6">
                                <input type="text" id="slug" placeholder="Slug" name="slug" class="form-control"
                                    value="{{ old('slug', $page->slug) }}" readonly>
                                <label for="slug">Slug</label>
                            </div>
                            <div class="form-floating form-floating-outline mb-6">
                                <select name="menu_id" id="menu_id" class="form-select select2">
                                    <option value="">Pilih Menu</option>
                                    @foreach ($menus as $menu)
                                        <option value="{{ $menu->id }}" {{ $page->menu_id == $menu->id ? 'selected' : '' }}>{{ $menu->name }}</option>
                                    @endforeach
                                </select>
                                <label for="menu_id" class="form-label">Pilih Menu</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <div id="full-editor">{!! old('content', $page->content) !!}</div>
                                <input type="hidden" name="content" id="quill-content" value="{{ old('content', $page->content) }}">
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-end gap-2">
                                <button class="btn btn-success btn-lg" type="submit">
                                    <i class="icon-base ri ri-save-3-line icon-18px me-2"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </form>
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
            } else {
                $('#label-link').removeAttr('hidden');
                $('#link').prop('type', 'text');
                $('#content').attr('hidden', true);
                $('#slug').attr('readonly', true);
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
                    url: '/check-slug',
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

@extends('operator.index')
@section('title', 'Slider&Carousel | Tambah')
@section('di-menu', 'show')
@section('di-slider', 'active')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <div class="pagetitle">
                <h1>Slider & Caraousel</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('operator') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('slider-op.index') }}">Slider&Caraousel</a></li>
                        <li class="breadcrumb-item active">Tambah Slider&Caarousel</li>
                    </ol>
                </nav>
            </div>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title"><i class="bi bi-plus-square"></i> Tambah Data</div>
                            <hr />
                            <form action="{{ route('slider-op.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Jenis Slide</label>
                                    <div class="col-sm-10">
                                        <select name="slide_id" id="slide_id"
                                            class="form-control" required>
                                            <option value="">---Pilih---</option>
                                            @foreach ($slide as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_slide }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label id="judul_slide" for="inputText" class="col-sm-2 col-form-label">Judul Slide</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="title" name="title"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Keterangan</label>
                                    <div class="col-sm-10">
                                        <textarea name="keterangan"
                                            class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3" id="foto">
                                    <label for="inputText" class="col-sm-2 col-form-label">Foto</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="foto" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <a href="{{ route('slider-op.index') }}" class="btn btn-outline-secondary btn-md" style="float: right;" type="reset">
                                            <i class="bi bi-backspace-fill"></i> Kembali
                                        </a>
                                        <button class="btn btn-success btn-md" style="float: right; margin-right: 2px;"
                                            type="submit">
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
    <script>
        $('#slide_id').change(function() {
            var slide_id = $('#slide_id').val();

            if (slide_id == '2') {
                $('#foto').prop('type', 'file');
            } else {
                $('#foto').attr('hidden', true);
                $('#judul_slide').text('Kategori Slide');
                $('#title').attr('placeholder', 'contoh: pengumuman, sport, informasi');
            }
        })
    </script>
@endsection

@extends('client.index')
@section('title', 'Q&A |')
@section('additional-css')
    <style>
        .image_upload>input {
            display: none;
        }
    </style>
@endsection
@section('content_home')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs" style="margin-top: 8%;">
        <div class="container">
            <div class="card" style="padding: 3%;">

                <div class="d-flex justify-content-between align-items-center">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $Pactive }}" id="permohonan-tab" data-toggle="tab"
                                data-target="#permohonan" type="button" role="tab" aria-controls="permohonan"
                                aria-selected="true">Permohonan</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $Lactive }}" id="pengaduan-tab" data-toggle="tab"
                                data-target="#pengaduan" type="button" role="tab" aria-controls="pengaduan"
                                aria-selected="false">Pengaduan</button>
                        </li>
                    </ul>
                    <ol>
                        <li><a href="{{ '/' }}">Home</a></li>
                        <li><a href="{{ route('faq.index') }}">F.A.Q</a></li>
                        <li>Permohonan dan Pengaduan</li>
                    </ol>
                </div>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade {{ $Pshow }} {{ $Pactive }}" id="permohonan" role="tabpanel"
                        aria-labelledby="permohonan-tab">
                        <div class="row">
                            <div class="col-lg-8">
                                <div>Perhatikan cara menyampaikan pengaduan yang
                                    baik
                                    dan
                                    benar
                                    <i class="bx bx-question-mark"></i>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <form action="{{ route('faq.show') }}" method="POST" onsubmit="return validateForm()">
                                    @csrf
                                    <div class="col-auto">
                                        <label class="sr-only" for="inlineFormInputGroup"></label>
                                        <div class="input-group mb-2">
                                            <input type="text" name="code" class="form-control" id="inlineFormInputGroup"
                                                placeholder="cek status permohonan anda" required>
                                            <div class="input-group-prepend">
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    <i class="bx bx-search"></i> Cari
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @if (session('success_req'))
                            <div class="alert alert-success" role="alert">
                                <button class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                {{ session('success_req') }}
                            </div>
                        @endif
                        @if (session('warning_size_req'))
                            <div class="alert alert-warning" role="alert">
                                <button class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                {{ session('warning_size_req') }}
                            </div>
                        @endif
                        @if (session('warning_ext_req'))
                            <div class="alert alert-warning" role="alert">
                                <button class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                {{ session('warning_ext_req') }}
                            </div>
                        @endif
                        <form action="{{ route('faq.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="hidden" name="jenis" value="permohonan">
                                    <input class="form-control @error('nama') is-invalid @enderror"
                                        value="{{ old('nama') }}" type="text" style="margin-bottom: 15px;"
                                        name="nama" placeholder="Nama">
                                    @error('nama')
                                        <div class="alert alert-danger" style="padding: 8px;">{{ $message }}</div>
                                    @enderror
                                    <input class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" type="email" style="margin-bottom: 15px;"
                                        name="email" placeholder="Email">
                                    @error('email')
                                        <div class="alert alert-danger" style="padding: 8px;">{{ $message }}</div>
                                    @enderror
                                    <input class="form-control @error('telepon') is-invalid @enderror"
                                        value="{{ old('telepon') }}" type="text" style="margin-bottom: 15px;"
                                        name="telepon" placeholder="Telepon">
                                    @error('telepon')
                                        <div class="alert alert-danger" style="padding: 8px;">{{ $message }}</div>
                                    @enderror
                                    <input class="form-control @error('pekerjaan') is-invalid @enderror"
                                        value="{{ old('pekerjaan') }}" type="text" style="margin-bottom: 15px;"
                                        name="pekerjaan" placeholder="Pekerjaan">
                                    @error('pekerjaan')
                                        <div class="alert alert-danger" style="padding: 8px;">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label for="ktp">Upload KTP</label>
                                                <p class="image_upload">
                                                    <label for="berkasKtp">
                                                        <a rel="nofollow" class="btn btn-info btn-sm"><i
                                                                class="bx bx-upload"></i> Pilih File</a>
                                                    </label>
                                                    <input type="file" style="margin-bottom: 15px;" name="ktp"
                                                        id="berkasKtp" accept="image/*" onchange="loadFile(event)">
                                                </p>
                                            </div>
                                            <div class="col-lg-8">
                                                <img src="{{ asset('static/images/KTP.jpg') }}" alt="ktp"
                                                    id="ktp" style="max-width: 50%; height: 120px;">
                                                @error('ktp')
                                                    <div class="alert alert-danger" style="padding: 8px;">{{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" style="margin-bottom: 15px; height: 100px;"
                                        name="alamat" placeholder="Alamat">{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <div class="alert alert-danger" style="padding: 8px;">{{ $message }}</div>
                                    @enderror
                                    <input type="text" name="asal_instansi" style="margin-bottom: 15px;"
                                        class="form-control @error('asal_instansi') is-invalid @enderror"
                                        value="{{ old('asal_instansi') }}" placeholder="Asal Instansi">
                                    @error('asal_instansi')
                                        <div class="alert alert-danger" style="padding: 8px;">{{ $message }}</div>
                                    @enderror
                                    <textarea class="form-control @error('informasi_diminta') is-invalid @enderror"
                                        style="margin-bottom: 15px; height: 100px;" placeholder="Rincian Informasi yang Dibutuhkan"
                                        name="informasi_diminta">{{ old('informasi_diminta') }}</textarea>
                                    @error('informasi_diminta')
                                        <div class="alert alert-danger" style="padding: 8px;">{{ $message }}</div>
                                    @enderror
                                    <textarea class="form-control @error('tujuan_informasi') is-invalid @enderror"
                                        style="margin-bottom: 15px; height: 100px;" name="tujuan_informasi" placeholder="Tujuan Penggunaan Informasi">{{ old('tujuan_informasi') }}</textarea>
                                    @error('tujuan_informasi')
                                        <div class="alert alert-danger" style="padding: 8px;">{{ $message }}</div>
                                    @enderror
                                    <button type="submit" class="btn btn-primary btn-md">
                                        <i class="bx bx-send"></i> Kirim
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade {{ $Lshow }} {{ $Lactive }}" id="pengaduan" role="tabpanel"
                        aria-labelledby="pengaduan-tab">
                        <p style="text-align: center; margin: 10px;">Perhatikan cara menyampaikan pengaduan yang baik dan
                            benar
                            <i class="bx bx-question-mark"></i>
                        </p>
                        @if (session('lap_success'))
                            <div class="alert alert-success" role="alert">
                                <button class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                {{ session('lap_success') }}
                            </div>
                        @endif
                        @if (session('warning_lap_size'))
                            <div class="alert alert-warning" role="alert">
                                <button class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                {{ session('warning_lap_size') }}
                            </div>
                        @endif
                        @if (session('warning_lap_ext'))
                            <div class="alert alert-warning" role="alert">
                                <button class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                {{ session('warning_lap_ext') }}
                            </div>
                        @endif
                        <form action="{{ route('faq.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="hidden" name="jenis" value="pelaporan">
                                    <input class="form-control @error('nama_pelapor') is-invalid @enderror"
                                        value="{{ old('nama_pelapor') }}" name="nama_pelapor" type="text"
                                        style="margin-bottom: 15px;" placeholder="Nama Anda">
                                    @error('nama_pelapor')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <input class="form-control @error('judul_laporan') is-invalid @enderror"
                                        type="text" style="margin-bottom: 15px;" value="{{ old('judul_laporan') }}"
                                        name="judul_laporan" placeholder="Judul Pengaduan">
                                    @error('judul_laporan')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <input class="form-control @error('no_pelapor') is-invalid @enderror" type="text"
                                        style="margin-bottom: 15px;" value="{{ old('no_pelapor') }}" name="no_pelapor"
                                        placeholder="Nomor Handphone">
                                    @error('no_pelapor')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <textarea class="form-control @error('isi_laporan') is-invalid @enderror" style="margin-bottom: 15px; height: 100px;"
                                        value="{{ old('isi_laporan') }}" name="isi_laporan" placeholder="Isi Pengaduan anda"></textarea>
                                    @error('isi_laporan')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <input class="form-control @error('lokasi_kejadian') is-invalid @enderror"
                                        type="text" style="margin-bottom: 15px;" value="{{ old('lokasi_kejadian') }}"
                                        name="lokasi_kejadian" placeholder="Lokasi Kejadian">
                                    @error('lokasi_kejadian')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <select class="form-control @error('kategori_laporan') is-invalid @enderror"
                                        style="margin-bottom: 15px;" value="{{ old('kategori_laporan') }}"
                                        name="kategori_laporan">
                                        <option value="">Kategori Laporan</option>
                                        <option value="keluhan">Keluhan</option>
                                        <option value="teguran">Teguran</option>
                                    </select>
                                    @error('kategori_laporan')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <p class="image_upload">
                                                <label for="berkas">
                                                    <a rel="nofollow" class="btn btn-info btn-sm">
                                                        <i class="bx bx-upload"></i> Upload Berkas Pendukung
                                                    </a>
                                                </label>
                                                <input type="file" style="margin-bottom: 15px" name="berkas"
                                                    id="berkas" accept="image/*" onchange="loadBerkas(event)"
                                                    placeholder="Upload Lampiran">
                                                @error('berkas')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            </p>
                                        </div>
                                        <div class="col-lg-6">
                                            <img src="{{ asset('static/images/no_image.png') }}" alt="berkas"
                                                id="berkass" style="max-width: 80%; height: 120px;">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-md">
                                        <i class="bx bx-send"></i> Kirim
                                    </button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="portfolio" class="portfolio">
        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

        </div>
    </section>
@endsection
@section('additional-js')
    <script>
        var loadFile = function(event) {
            var ktp = document.getElementById('ktp');
            ktp.src = URL.createObjectURL(event.target.files[0]);
            ktp.onload = function() {
                URL.revokeObjectURL(ktp.src) // free memory
            }
        };

        var loadBerkas = function(event) {
            var berkas = document.getElementById('berkass');
            berkas.src = URL.createObjectURL(event.target.files[0]);
            berkas.onload = function() {
                URL.revokeObjectURL(berkas.src) // free memory
            }
        };
    </script>
@endsection

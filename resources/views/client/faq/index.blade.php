@extends('client.index')
@section('title', 'Halaman')
@section('content')
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
                        <p style="text-align: center; margin: 10px;">Perhatikan cara menyampaikan pengaduan yang baik dan
                            benar
                            <i class="bx bx-question-mark"></i>
                        </p>
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                <button class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('warning_size'))
                            <div class="alert alert-warning" role="alert">
                                <button class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                {{ session('warning_size') }}
                            </div>
                        @endif
                        @if (session('warning_ext'))
                            <div class="alert alert-warning" role="alert">
                                <button class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                {{ session('warning_ext') }}
                            </div>
                        @endif
                        <form action="{{ route('faq.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="jenis" value="permohonan">
                            <input class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}"
                                type="text" style="margin-bottom: 15px;" name="nama" placeholder="Nama">
                            @error('nama')
                                <div class="alert alert-danger" style="padding: 8px;">{{ $message }}</div>
                            @enderror
                            <input class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                type="email" style="margin-bottom: 15px;" name="email" placeholder="Email">
                            @error('email')
                                <div class="alert alert-danger" style="padding: 8px;">{{ $message }}</div>
                            @enderror
                            <input class="form-control @error('telepon') is-invalid @enderror" value="{{ old('telepon') }}"
                                type="text" style="margin-bottom: 15px;" name="telepon" placeholder="Telepon">
                            @error('telepon')
                                <div class="alert alert-danger" style="padding: 8px;">{{ $message }}</div>
                            @enderror
                            <input class="form-control @error('pekerjaan') is-invalid @enderror"
                                value="{{ old('pekerjaan') }}" type="text" style="margin-bottom: 15px;" name="pekerjaan"
                                placeholder="Pekerjaan">
                            @error('pekerjaan')
                                <div class="alert alert-danger" style="padding: 8px;">{{ $message }}</div>
                            @enderror
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
                            <div class="form-group">
                                <label for="ktp">Upload KTP</label>
                                <input class="form-control @error('ktp') is-invalid @enderror" type="file"
                                    style="margin-bottom: 15px;" name="ktp">
                                @error('ktp')
                                    <div class="alert alert-danger" style="padding: 8px;">{{ $message }}</div>
                                @enderror
                            </div>
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
                        @if (session('warning_ext'))
                            <div class="alert alert-warning" role="alert">
                                <button class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                {{ session('warning_lap_ext') }}
                            </div>
                        @endif
                        <form action="{{ route('faq.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="jenis" value="pelaporan">
                            <input class="form-control @error('nama_pelapor') is-invalid @enderror"
                                value="{{ old('nama_pelapor') }}" name="nama_pelapor" type="text"
                                style="margin-bottom: 15px;" placeholder="Nama Anda">
                            @error('nama_pelapor')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <input class="form-control @error('judul_laporan') is-invalid @enderror" type="text"
                                style="margin-bottom: 15px;" value="{{ old('judul_laporan') }}" name="judul_laporan"
                                placeholder="Judul Pengaduan">
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
                            <input class="form-control @error('lokasi_kejadian') is-invalid @enderror" type="text"
                                style="margin-bottom: 15px;" value="{{ old('lokasi_kejadian') }}" name="lokasi_kejadian"
                                placeholder="Lokasi Kejadian">
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
                            <input type="file" class="form-control @error('berkas') is-invalid @enderror"
                                style="margin-bottom: 15px"name="berkas" placeholder="Upload Lampiran">
                            @error('berkas')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <button type="submit" class="btn btn-primary btn-md">
                                <i class="bx bx-send"></i> Kirim
                            </button>
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

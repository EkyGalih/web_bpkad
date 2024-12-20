@extends('SimPeg.index')
@section('title', env('APP_NAME') . ' - Pegawai')
@section('pegawai', 'here show')
@section('styles')
    <link rel="stylesheet" href="{{ asset('server/vendor/tom-select/tom-select.css') }}">
    <style>
        .image_upload>input {
            display: none;
        }
    </style>
@endsection
@section('header')
    <div class="d-flex flex-stack justify-content-end flex-row-fluid" id="kt_app_navbar_wrapper">
        <div class="app-page-entry d-flex align-items-center flex-row-fluid gap-3">
            <div class="d-flex flex-column">
                <h1 class="text-gray-900 fs-2 fw-bold mb-0">Tambah Pegawai</h1>
            </div>
        </div>
    </div>
    <div class="float-end p-7">
        <a href="{{ route('pegawai.index') }}" class="btn btn-secondary btn-md">
            <i class="bi bi-skip-backward"></i> Kembali
        </a>
    </div>
@endsection
@section('content')
    <div class="card mb-6">
        <div class="card-body pt-9 pb-0">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pegawai.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <h4 style="text-align: center; font-weight: bold; color: #726e6e">DATA PRIBADI</h4>
                        <hr />
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">NIP</label>
                            <div class="col-sm-9">
                                <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror"
                                    value="{{ old('nip') }}"
                                    placeholder="isi 0 jika tidak memiliki nip atau pegawai non asn">
                                @error('nip')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Nama Pegawai</label>
                            <div class="col-sm-9">
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Pendidikan</label>
                            <div class="col-sm-9">
                                <input type="text" name="pendidikan"
                                    class="form-control @error('pendidikan') is-invalid @enderror"
                                    value="{{ old('pendidikan') }}">
                                @error('pendidikan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Tgl/Tempat Lahir</label>
                            <div class="col-sm-5">
                                <input type="text" name="tempat_lahir"
                                    class="form-control @error('tempat_lahir') is-invalid @enderror"
                                    value="{{ old('tempat_lahir') }}">
                                @error('tempat_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-4">
                                <input type="date" name="tanggal_lahir" id="birthday"
                                    class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                    value="{{ old('tanggal_lahir') }}">
                                @error('tanggal_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Usia</label>
                            <div class="col-sm-2">
                                <input type="text" id="umur" name="umur" class="form-control @error('umur') is-invalid @enderror" readonly
                                    value="{{ old('umur') }}" style="background-color: rgb(238, 236, 236)">
                                    @error('umur')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <label for="inputText" class="form-label mt-3">Tahun</label>
                                </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9">
                                <select name="jenis_kelamin"
                                    class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                    <option value="">--Pilih--</option>
                                    <option value="pria" {{ old('jenis_kelamin') == 'pria' ? 'selected' : '' }}>Pria
                                    </option>
                                    <option value="wanita" {{ old('jenis_kelamin') == 'wanita' ? 'selected' : '' }}>Wanita
                                    </option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Agama</label>
                            <div class="col-sm-9">
                                <select name="agama" class="form-control @error('agama') is-invalid @enderror">
                                    <option value="">--Pilih--</option>
                                    <option value="islam" {{ old('agama') == 'islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="kristen" {{ old('agama') == 'kristen' ? 'selected' : '' }}>Kristen
                                    </option>
                                    <option value="hindu" {{ old('agama') == 'hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="budha" {{ old('agama') == 'budha' ? 'selected' : '' }}>Budha</option>
                                    <option value="konghucu" {{ old('agama') == 'konghucu' ? 'selected' : '' }}>Konghucu
                                    </option>
                                </select>
                                @error('agama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Foto</label>
                            <div class="col-sm-1">
                                <p class="image_upload">
                                    <label for="userImage">
                                        <a class="btn btn-primary btn-sm" rel="nofollow"><span
                                                class='bi bi-upload'></span></a>
                                    </label>
                                    <input type="file" name="foto" id="userImage" accept="image/*"
                                        onchange="loadFile(event)" class="@error('foto') is-invalid @enderror">
                                    @error('foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                </p>
                            </div>
                            <div class="col-sm-8">
                                <img src="{{ asset('uploads/profile/male.jpg') }}" alt="Profile" id="foto"
                                    style="max-width: 100%; height: 120px;">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Rekening</label>
                            <div class="col-sm-4">
                                <input type="text" name="nama_rekening"
                                    class="form-control @error('nama_rekening') is-invalid @enderror"
                                    placeholder="Nama Bank" value="{{ old('nama_rekening') }}">
                                @error('nama_rekening')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-5">
                                <input type="text" name="no_rekening"
                                    class="form-control @error('no_rekening') is-invalid @enderror"
                                    placeholder="Nomor Rekening" value="{{ old('no_rekening') }}">
                                @error('no_rekening')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <h4 style="text-align: center; font-weight: bold; color: #726e6e">DATA PEGAWAI</h4>
                        <hr />
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Pangkat/Golongan</label>
                            <div class="col-sm-5">
                                <select name="golongan_id" id="golongan" placeholder="Cari.." autocomplete="off"
                                    class="form-control @error('golongan_id') is-invalid @enderror">
                                    <option value="">Cari..</option>
                                    @foreach ($golongan as $gol)
                                        <option value="{{ $gol->id }}"
                                            {{ old('golongan_id') == $gol->id ? 'selected' : '' }}>
                                            {{ $gol->nama_golongan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('golongan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-4">
                                <select name="pangkat_id" id="pangkat" placeholder="Cari.." autocomplete="off"
                                    class="form-control @error('pangkat_id') is-invalid @enderror">
                                    <option value="">Cari..</option>
                                    @foreach ($pangkat as $pang)
                                        <option value="{{ $pang->id }}"
                                            {{ old('pangkat_id') == $pang->id ? 'selected' : '' }}>
                                            {{ $pang->nama_pangkat }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('pangkat_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Jabatan/Inisial
                                Jabatan</label>
                            <select class="col-sm-4" name="nama_jabatan" id="jabatan" autocomplete="off"
                                placeholder="Cari.." class="form-control @error('nama_jabatan') is-invalid @enderror">
                                <option value="#">Cari..</option>
                                @foreach ($NamaJabatan as $nj)
                                    <option value="{{ $nj['nama_jabatan'] }}"
                                        {{ old('nama_jabatan') == $nj['nama_jabatan'] ? 'selected' : '' }}>
                                        {{ $nj['nama_jabatan'] }}
                                    </option>
                                @endforeach
                            </select>
                            @error('nama_jabatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <select class="col-sm-5" name="initial_jabatan" id="initial-jabatan" autocomplete="off"
                                placeholder="Cari.." class="form-control @error('initial_jabatan') is-invalid @enderror">
                                <option value="#">Cari..</option>
                                @foreach ($InitialJabatan as $ij)
                                    <option value="{{ $ij['initial_jabatan'] }}"
                                        {{ old('initial_jabatan') == $ij['initial_jabatan'] ? 'selected' : '' }}>
                                        {{ $ij['initial_jabatan'] }}</option>
                                @endforeach
                            </select>
                            @error('initial_jabatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Nama jabatan</label>
                            <div class="col-sm-9">
                                <input type="text" name="jabatan" class="form-control"
                                    placeholder="Contoh: Peng administrasi [Fungsional Umum]"
                                    value="{{ old('jabatan') }}"
                                    class="form-control @error('jabatan') is-invalid @enderror">
                                @error('jabatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Tahun/Bulan
                                Pengangkatan</label>
                            <div class="col-sm-4">
                                <input type="date" id="masa-kerja" name="tanggal_sk" class="form-control"
                                    placeholder="Contoh: Jan, 2000" value="{{ old('masa_kerja_golongan') }}"
                                    class="form-control @error('tanggal_sk') is-invalid @enderror">
                                @error('tanggal_sk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-5">
                                <input type="text" name="masa_kerja_golongan" class="form-control"
                                    id="masa_kerja_golongan" readonly style="background-color: rgb(238, 236, 236)">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Nomor SK</label>
                            <div class="col-sm-9">
                                <input type="text" name="no_sk" class="form-control"
                                    placeholder="Contoh: 123/2021/PPD/II/01" value="{{ old('no_sk') }}"
                                    class="form-control @error('no_sk') is-invalid @enderror">
                                @error('no_sk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Diklat</label>
                            <div class="col-sm-9">
                                <textarea name="diklat" class="form-control" placeholder="Contoh: Diklat keahlian A, B, C">{{ old('diklat') }}</textarea>
                                @error('diklat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Promosi <sup data-bs-tooltip="tooltip"
                                    data-bs-placement="top"
                                    title="Tahun Kenaikan pangkat hanya perkiraan berdasarkan tahun pengangkatan, tahun promosi bisa berubah tergantung jabatan yang diduduki"><i
                                        class="bi bi-info-circle"></i></sup></label>
                            <div class="col-sm-9">
                                <input type="text" name="kenaikan_pangkat" class="form-control"
                                    value="{{ old('kenaikan_pangkat') }}"
                                    class="form-control @error('kenaikan_pangkat') is-invalid @enderror">
                                @error('kenaikan_pangkat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Tahun Pensiun <sup
                                    data-bs-tooltip="tooltip" data-bs-placement="top"
                                    title="Tahun pensiun hanya perkiraan berdasarkan tahun lahir, tahun pensiun bisa berubah berdasarkan jabatan terakhir yang diduduki"><i
                                        class="bi bi-info-circle"></i></sup></label>
                            <div class="col-sm-9">
                                <input type="text" id="pensiun" name="pensiun" class="form-control"
                                    style="background-color: rgb(238, 236, 236)" readonly value="{{ old('pensiun') }}"
                                    class="form-control @error('pensiun') is-invalid @enderror">
                                @error('pensiun')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Bidang
                                Penempatan</label>
                            <div class="col-sm-9">
                                <select name="bidang_id" id="bidang" placeholder="Cari.." autocomplete="off"
                                    class="form-control @error('bidang_id') is-invalid @enderror">
                                    <option value="">Cari..</option>
                                    @foreach ($bidang as $bid)
                                        <option value="{{ $bid->id }}"
                                            {{ old('bidang_id') == $bid->id ? 'selected' : '' }}>{{ $bid->nama_bidang }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('bidang_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12 text-end">
                                <div class="d-grid gap-2 d-md-block">
                                    <button class="btn btn-success btn-md" type="submit">
                                        <i class="bi bi-plus-square"></i> Tambah
                                    </button>
                                    <button class="btn btn-warning btn-md" type="reset">
                                        <i class="bi bi-arrow-clockwise"></i> Reset
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('server/vendor/tom-select/tom-select.js') }}"></script>
    <script>
        new TomSelect("#jabatan", {
            persist: false,
            createOnBlur: true,
            create: true
        });
        new TomSelect("#initial-jabatan", {
            persist: false,
            createOnBlur: true,
            create: true
        });
        new TomSelect("#bidang", {
            persist: false,
            createOnBlur: true,
            create: true
        });
        new TomSelect("#golongan", {
            persist: false,
            createOnBlur: true,
            create: true
        });
        new TomSelect("#pangkat", {
            persist: false,
            createOnBlur: true,
            create: true
        });

        // preview image
        var loadFile = function(event) {
            var output = document.getElementById('foto');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };

        function monthDiff(dateFrom, dateTo) {
            if (dateFrom.getMonth() == dateTo.getMonth()) {
                result = 0;
            } else if (dateFrom.getMonth() < dateTo.getMonth()) {
                var count = (dateTo.getMonth() + 1) - (dateFrom.getMonth() + 1);
                var math1 = 12 - count;
                var result = 12 - math1
            } else {
                var math1 = 12 - (dateTo.getMonth() + 1);
                var math2 = 12 - (dateFrom.getMonth() + 1);
                var result = math1 + math2;
            }
            return result;
        }

        window.onload = function() {
            // menghtiung usia
            $('#birthday').on('change', function() {
                var dob = new Date(this.value);
                var today = new Date();
                var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
                var pensiun = today.getFullYear() + (58 - age);
                $('#umur').val(age);
                $('#pensiun').val(pensiun);
            });

            // menghitung masa jabatan
            $('#masa-kerja').on('change', function() {
                var dob = new Date(this.value);
                var today = new Date();
                var years = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
                var month = monthDiff(dob, today);
                // console.log(monthDiff(dob, today));
                $('#masa_kerja_golongan').val(years + " Tahun, " + month + " Bulan");
            });
        }
    </script>
@endsection

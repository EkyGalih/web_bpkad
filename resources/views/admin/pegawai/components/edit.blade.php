@extends('admin.index')
@section('title', 'Update Pegawai')
@section('db-menu', 'show')
@section('db-pegawai', 'active')
@section('additional-css')
    <link rel="stylesheet" href="{{ asset('server/vendor/tom-select/tom-select.css') }}">
    <style>
        .image_upload>input {
            display: none;
        }
    </style>
@endsection
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <div class="pagetitle">
                <h1>Pegawai</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin-pegawai.index') }}">Pegawai</a></li>
                        <li class="breadcrumb-item active">Ubah Pegawai</li>
                    </ol>
                </nav>
            </div>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Update Data Pegawai</div>
                            <hr />
                            <form action="{{ route('admin-pegawai.update', $pegawai->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h4 style="text-align: center; font-weight: bold; color: #726e6e">DATA PRIBADI</h4>
                                        <hr />
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">NIP</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="nip" class="form-control" value="{{ $pegawai->nip ?? '0' }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Nama Pegawai</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="name" class="form-control" value="{{ $pegawai->name ?? '-' }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Pendidikan</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="pendidikan" class="form-control" value="{{ $pegawai->pendidikan ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Tempat/Tanggal Lahir</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="tempat_lahir" class="form-control" value="{{ $pegawai->tempat_lahir }}">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="date" name="tanggal_lahir" id="birthday" value="{{ $pegawai->tanggal_lahir }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Usia</label>
                                            <div class="col-sm-9">
                                                <input type="text" id="umur" name="umur" class="form-control" value="{{ $pegawai->umur }}"
                                                    readonly style="background-color: rgb(238, 236, 236)">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                            <div class="col-sm-9">
                                                <select name="jenis_kelamin" class="form-control">
                                                    <option value="">--Pilih--</option>
                                                    <option value="pria" {{$pegawai->jenis_kelamin == 'pria' ? 'selected' : ''}}>Pria</option>
                                                    <option value="wanita" {{$pegawai->jenis_kelamin == 'wanita' ? 'selected' : ''}}>Wanita</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Agama</label>
                                            <div class="col-sm-9">
                                                <select name="agama" class="form-control">
                                                    <option value="">--Pilih--</option>
                                                    <option value="islam" {{$pegawai->agama == 'islam' ? 'selected' : ''}}>Islam</option>
                                                    <option value="kristen" {{$pegawai->agama == 'kristen' ? 'selected' : ''}}>Kristen</option>
                                                    <option value="hindu" {{$pegawai->agama == 'hindu' ? 'selected' : ''}}>Hindu</option>
                                                    <option value="budha" {{$pegawai->agama == 'budha' ? 'selected' : ''}}>Budha</option>
                                                    <option value="konghucu" {{$pegawai->agama == 'konghucu' ? 'selected' : ''}}>Konghucu</option>
                                                </select>
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
                                                        onchange="loadFile(event)">
                                                </p>
                                            </div>
                                            <div class="col-sm-8">
                                                <img src="{{ asset($pegawai->foto) ?? asset('uploads/profile/male.jpg') }}" alt="Profile"
                                                    id="foto" style="max-width: 100%; height: 120px;">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Rekening</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="nama_rekening" class="form-control"
                                                    placeholder="Nama Bank" value="{{ $pegawai->nama_rekening ?? '' }}">
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="text" name="no_rekening" class="form-control"
                                                    placeholder="Nomor Rekening" value="{{ $pegawai->no_rekening ?? '' }}">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <h4 style="text-align: center; font-weight: bold; color: #726e6e">DATA PEGAWAI</h4>
                                        <hr />
                                        <div class="row mb-3">
                                            <label for="inputText"
                                                class="col-sm-3 col-form-label">Pangkat/Golongan</label>
                                            <div class="col-sm-5">
                                                <select name="golonganUuid" id="golongan" placeholder="Cari.."
                                                    autocomplete="off">
                                                    <option value="">Cari..</option>
                                                    @foreach ($golongan as $gol)
                                                        <option value="{{ $gol->uuid }}" {{ $pegawai->golonganUuid == $gol->uuid ? 'selected' : '' }}>{{ $gol->nama_golongan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <select name="pangkatUuid" id="pangkat" placeholder="Cari.."
                                                    autocomplete="off">
                                                    <option value="">Cari..</option>
                                                    @foreach ($pangkat as $pang)
                                                        <option value="{{ $pang->uuid }}" {{ $pegawai->pangkatUuid == $pang->uuid ? 'selected' : '' }}>{{ $pang->nama_pangkat }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Inisial
                                                Jabatan/Jabatan</label>
                                            <select class="col-sm-4" name="nama_jabatan" id="jabatan"
                                                autocomplete="off" placeholder="Cari..">
                                                <option value="#">Cari..</option>
                                                @foreach ($NamaJabatan as $nj)
                                                    <option value="{{ $nj['nama_jabatan'] }}" {{ $pegawai->nama_jabatan == $nj['nama_jabatan'] ? 'selected' : '' }}>{{ ucwords($nj['nama_jabatan']) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <select class="col-sm-5" name="initial_jabatan" id="initial-jabatan"
                                                autocomplete="off" placeholder="Cari..">
                                                <option value="#">Cari..</option>
                                                @foreach ($InitialJabatan as $ij)
                                                    <option value="{{ $ij['initial_jabatan'] }}" {{ $pegawai->initial_jabatan == $ij['initial_jabatan'] ? 'selected' : '' }}>
                                                        {{ $ij['initial_jabatan'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Nama jabatan</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="jabatan" class="form-control"
                                                    placeholder="Contoh: Peng administrasi [Fungsional Umum]" value="{{ $pegawai->jabatan ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Tahun/Bulan
                                                Pengangkatan</label>
                                            <div class="col-sm-4">
                                                <input type="date" id="masa-kerja" name="tanggal_sk" class="form-control"
                                                    placeholder="Contoh: Jan, 2000" value="{{ $pegawai->tanggal_sk }}">
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="text" name="masa_kerja_golongan" class="form-control"
                                                    value="{{ $pegawai->masa_kerja_golongan }}" id="masa_kerja_golongan" readonly style="background-color: rgb(238, 236, 236)">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Nomor SK</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="no_sk" class="form-control"
                                                    placeholder="Contoh: 123/2021/PPD/II/01"
                                                    value="{{ $pegawai->no_sk ?? '-' }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Diklat</label>
                                            <div class="col-sm-9">
                                                <textarea name="diklat" class="form-control">{{ $pegawai->diklat }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Promosi <sup data-bs-tooltip="tooltip" data-bs-placement="top"
                                                    title="Tahun Kenaikan pangkat hanya perkiraan berdasarkan tahun pengangkatan, tahun promosi bisa berubah tergantung jabatan yang diduduki"><i
                                                        class="bi bi-info-circle"></i></sup></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="kenaikan_pangkat" class="form-control" value="{{ $pegawai->kenaikan_pangkat }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Pensiun <sup
                                                    data-bs-tooltip="tooltip" data-bs-placement="top"
                                                    title="Tahun pensiun hanya perkiraan berdasarkan tahun lahir, tahun pensiun bisa berubah berdasarkan jabatan terakhir yang diduduki"><i
                                                        class="bi bi-info-circle"></i></sup></label>
                                            <div class="col-sm-9">
                                                <input type="text" id="pensiun" name="pensiun" class="form-control" value="{{ $pegawai->batas_pensiun }}"
                                                    readonly style="background-color: rgb(238, 236, 236)">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Bidang
                                                Penempatan</label>
                                            <div class="col-sm-9">
                                                <select name="bidangUuid" id="bidang" placeholder="Cari.."
                                                    autocomplete="off">
                                                    <option value="">Cari..</option>
                                                    @foreach ($bidang as $bid)
                                                        <option value="{{ $bid->id }}" {{ $pegawai->bidang_id == $bid->id ? 'selected' : '' }}>{{ $bid->nama_bidang }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-12">
                                                <button class="btn btn-warning btn-md" style="float: right;"
                                                    type="reset">
                                                    <i class="bi bi-arrow-clockwise"></i> Reset
                                                </button>
                                                <button class="btn btn-success btn-md"
                                                    style="float: right; margin-right: 2px;" type="submit">
                                                    <i class="bi bi-save-fill"></i> Simpan
                                                </button>
                                            </div>
                                        </div>
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
                $('#umur').val(age + " Tahun");
                $('#pensiun').val("Tahun " + pensiun);
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

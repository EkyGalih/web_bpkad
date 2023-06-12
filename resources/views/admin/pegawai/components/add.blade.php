@extends('admin.index')
@section('title', 'Tambah Pegawai')
@section('db-menu', 'show')
@section('db-pegawai', 'active')
@section('additional-css')
    <link rel="stylesheet" href="{{ asset('server/vendor/tom-select/tom-select.css') }}">
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
                        <li class="breadcrumb-item active">Tambah Pegawai</li>
                    </ol>
                </nav>
            </div>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Tambah Pegawai</div>
                            <hr />
                            <form action="{{ route('admin-pegawai.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">NIK</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="nik" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Nama Pegawai</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Tgl/Tempat Lahir</label>
                                            <div class="col-sm-4">
                                                <input type="date" name="tanggal_lahir" id="birthday"
                                                    class="form-control">
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="text" name="tempat_lahir" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Jabatan/Inisial
                                                Jabatan</label>
                                            <select class="col-sm-4" name="nama_jabatan" id="jabatan" autocomplete="off"
                                                placeholder="Cari..">
                                                <option value="#">Cari..</option>
                                                @foreach ($NamaJabatan as $nj)
                                                    <option value="{{ $nj['nama_jabatan'] }}">{{ $nj['nama_jabatan'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <select class="col-sm-5" name="initial_jabatan" id="initial-jabatan"
                                                autocomplete="off" placeholder="Cari..">
                                                <option value="#">Cari..</option>
                                                @foreach ($InitialJabatan as $ij)
                                                    <option value="{{ $ij['initial_jabatan'] }}">
                                                        {{ $ij['initial_jabatan'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Nama jabatan</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="jabatan" class="form-control"
                                                    placeholder="Contoh: Peng administrasi [Fungsional Umum]">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Tahun/Bulan
                                                Pengangkatan</label>
                                            <div class="col-sm-4">
                                                <input type="date" id="masa-kerja" class="form-control"
                                                    placeholder="Contoh: Jan, 2000">
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="text" name="masa_kerja_golongan" class="form-control"
                                                    id="masa_kerja_golongan" disabled>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Diklat</label>
                                            <div class="col-sm-9">
                                                <textarea name="diklat" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Pendidikan</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="pendidikan" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Rekening</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="nama_rekening" class="form-control"
                                                    placeholder="Nama Bank">
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="text" name="no_rekening" class="form-control"
                                                    placeholder="Nomor Rekening">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label">Usia</label>
                                            <div class="col-sm-9">
                                                <input type="text" id="umur" name="umur" class="form-control"
                                                    disabled>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-12">
                                                <button class="btn btn-outline-warning btn-md" style="float: right;"
                                                    type="reset">
                                                    <i class="bi bi-arrow-clockwise"></i> Reset
                                                </button>
                                                <button class="btn btn-outline-success btn-md"
                                                    style="float: right; margin-right: 2px;" type="submit">
                                                    <i class="bi bi-save"></i> Simpan
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

        function monthDiff(dateFrom, dateTo) {
            if (dateFrom.getMonth() == dateTo.getMonth()) {
                result = 0;
            } else if (dateFrom.getMonth() < dateTo.getMonth()) {
                var count = (dateTo.getMonth()+1) - (dateFrom.getMonth()+1);
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
                $('#umur').val(age + " Tahun");
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

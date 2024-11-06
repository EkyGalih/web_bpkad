@extends('admin.index')
@section('title', 'Tambah Pegawai')
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
                        <li class="breadcrumb-item active">Detail Pegawai</li>
                    </ol>
                </nav>
            </div>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Detail Pegawai</div>
                            <hr />
                            <div class="row">
                                <div class="col-lg-6">
                                    @if ($pegawai->jenis_kelamin == 'pria')
                                        <img src="{{ asset($pegawai->foto ?? 'uploads/profile/male.jpg') }}"
                                            alt="foto pegawai atas nama {{ $pegawai->name }}">
                                    @else
                                        <img src="{{ asset($pegawai->foto ?? 'uploads/profile/female.jpg') }}"
                                            alt=" foto pegawai atas nama {{ $pegawai->name }}">
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    <table class="table table-hover table-striped mb-0">
                                        <tbody>
                                            <tr>
                                                <th class="bg-light text-secondary" style="width: 30%;">Nama</th>
                                                <td>{{ $pegawai->name }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light text-secondary">NIP</th>
                                                <td>{{ $pegawai->nip }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light text-secondary">Jenis Kelamin</th>
                                                <td>{{ ucfirst($pegawai->jenis_kelamin) }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light text-secondary">Agama</th>
                                                <td>{{ ucfirst($pegawai->agama) }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light text-secondary">Tempat Lahir</th>
                                                <td>{{ ucfirst($pegawai->tempat_lahir) }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light text-secondary">Tanggal Lahir</th>
                                                <td>{{ \Carbon\Carbon::parse($pegawai->tanggal_lahir)->format('d-m-Y') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light text-secondary">Alamat</th>
                                                <td>{{ $pegawai->alamat }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light text-secondary">No. Telepon</th>
                                                <td>{{ $pegawai->no_telepon }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light text-secondary">Email</th>
                                                <td>{{ $pegawai->email }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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

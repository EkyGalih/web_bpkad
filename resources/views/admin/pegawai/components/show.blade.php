@extends('admin.index')
@section('title', 'Detail Pegawai')
@section('db-menu', 'show')
@section('db-pegawai', 'active')
@section('additional-css')
    <link rel="stylesheet" href="{{ asset('server/vendor/tom-select/tom-select.css') }}">
    <style>
        .image_upload>input {
            display: none;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 70%;
            transform: translate(-50%, -50%) rotate(-30deg);
            font-size: 7rem;
            /* Increase font size */
            font-weight: bold;
            color: rgba(255, 0, 0, 0.7);
            /* Make color less transparent */
            text-transform: uppercase;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
            /* Add shadow for more visibility */
            pointer-events: none;
            /* Prevents watermark from being clicked */
            z-index: 1;
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
                                    <div class="card" style="width: 25rem;">
                                        <div style="position: relative;">
                                            @if ($pegawai->jenis_kelamin == 'pria')
                                                <img src="{{ asset($pegawai->foto ?? 'uploads/profile/male.jpg') }}" class="card-img-top"
                                                     alt="foto pegawai atas nama {{ $pegawai->name ?? '-' }}" style="height: auto; width: auto; object-fit: fill;">
                                            @else
                                                <img src="{{ asset($pegawai->foto ?? 'uploads/profile/female.jpg') }}" class="card-img-top"
                                                     alt="foto pegawai atas nama {{ $pegawai->name }}" style="height: auto; width: auto; object-fit: fill;">
                                            @endif

                                            <!-- Watermark -->
                                            @if ($pegawai->status_pegawai == 'pensiun')
                                                <div class="watermark">PENSIUN</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <table class="table table-hover table-striped mb-0">
                                        <tbody>
                                            <tr>
                                                <th class="bg-light text-secondary" style="width: 30%;">Nama</th>
                                                <td>{{ $pegawai->name }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light text-secondary" style="width: 30%;">Tempat/ Tanggal Lahir</th>
                                                <td>{{ $pegawai->tempat_lahir . ', ' . $pegawai->tanggal_lahir }} ({{ $pegawai->umur ?? '0' }} Tahun)</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light text-secondary">NIP</th>
                                                <td>{{ $pegawai->nip ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light text-secondary">Pendidikan</th>
                                                <td>{{ $pegawai->pendidikan ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light text-secondary">Diklat Terakhir</th>
                                                <td>{{ $pegawai->diklat ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light text-secondary">Jabatan</th>
                                                <td>{{ $pegawai->nama_jabatan ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light text-secondary">Nama Jabatan</th>
                                                <td>{{ $pegawai->jabatan ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light text-secondary">Tanggal SK</th>
                                                <td>{{ $pegawai->tanggal_sk ?? '-' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light text-secondary">Nomor SK</th>
                                                <td>{{ $pegawai->no_sk ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light text-secondary">Masa Kerja Golongan</th>
                                                <td>{{ ucfirst($pegawai->masa_kerja_golongan) }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light text-secondary">Kenaikan Pangkat berikutnya</th>
                                                <td>{{ $pegawai->kenaikan_pangkat ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light text-secondary">Tahun Pensiun</th>
                                                <td>{{ $pegawai->batas_pensiun }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-end mt-3">
                                        <a href="{{ route('admin-pegawai.index') }}" class="btn btn-light btn-md">
                                            <i class="bi bi-arrow-left"></i> Kembali
                                        </a>
                                    </div>

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

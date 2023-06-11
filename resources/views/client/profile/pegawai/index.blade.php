@extends('client.index')
@section('title', 'Profile | Profile Pejabat')
@section('additional-css')

@endsection
@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="card" style="padding: 1%; margin-right: 5%; margin-left: 5%; margin-top: 1%;">
            <div class="container" style="margin-top: 50px; margin-bottom: 50px;">
                <h2><strong>Data Pegawai BPKAD</strong></h2>
                <p>Untuk menjalankan tugas dan fungsi Badan Pengelolaan Keuangan dan Aset Daerah didukung oleh Sumber Data
                    Manusia Yaitu:</p>

                {{-- tabel pegawai kategori jabatan --}}
                <div class="table-responsive">
                    <p>Tabel 1. Jumlah pegawai yang menduduki jabatan</p>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jabatan</th>
                                <th>Eselon</th>
                                <th colspan="2" style="text-align: center;">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Kepala Badan</td>
                                <td>II</td>
                                <td>{{ Helpers::getPimpinan('count', 'kaban') }}</td>
                                <td>Orang</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Sekretaris</td>
                                <td>III</td>
                                <td>{{ Helpers::getPimpinan('count', 'sekban') }}</td>
                                <td>Orang</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Kepala Bidang/Kepala UPTB</td>
                                <td>III</td>
                                <td>{{ Helpers::getPimpinan('count', 'kabag') }}</td>
                                <td>Orang</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Kepala Sub. Bagian/Sub.Bidang</td>
                                <td>IV</td>
                                <td>{{ Helpers::getPimpinan('count', 'kasubag') }}</td>
                                <td>Orang</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Fungsional Umum</td>
                                <td></td>
                                <td>{{ Helpers::getPegawai('count', 'like', 'pegawai', 'Fungsional Umum') }}</td>
                                <td>Orang</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Fungsional Tertentu</td>
                                <td></td>
                                <td>{{ Helpers::getPegawai('count', 'not', 'pegawai', 'Fungsional Umum') }}</td>
                                <td>Orang</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- tabel pegawai kategori jenjang pendidikan --}}
                <div class="table-responsive">
                    <p>Tabel 2. Jumlah pegawai berdasarkan tingkat pendidikan</p>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenjang Pendidikan</th>
                                <th colspan="2" style="text-align: center;">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Doktor(S3)</td>
                                <td>{{ Helpers::getPegawais('Doctor', 'pendidikan') }}</td>
                                <td>Orang</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Magister/Strata 2 (S2)</td>
                                <td>{{ Helpers::getPegawais('Pasca Sarjana', 'pendidikan') }}</td>
                                <td>Orang</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Sarjana/Strata 1 (S1)</td>
                                <td>{{ Helpers::getPegawais('Sarjana', 'pendidikan') }}</td>
                                <td>Orang</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Ahli Madya/Diploma 3 (D1/D2/D3)</td>
                                <td>{{ Helpers::getPegawais('Diploma', 'pendidikan') }}</td>
                                <td>Orang</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Pendidikan Atas (SMA/SMK)</td>
                                <td>{{ Helpers::getPegawais('SMA', 'pendidikan') }}</td>
                                <td>Orang</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Pendidikan Menengah (SMP/SMPK)</td>
                                <td>{{ Helpers::getPegawais('SMP', 'pendidikan') }}</td>
                                <td>Orang</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Pendidikan Dasar (SD)</td>
                                <td>{{ Helpers::getPegawais('SD', 'pendidikan') }}</td>
                                <td>Orang</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- tabel pegawai kategori golongan --}}
                <div class="table-responsive">
                    <p>Tabel 3. Jumlah pegawai berdasarkan golongan</p>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Golongan</th>
                                <th colspan="2" style="text-align: center;">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Golongan IV</td>
                                <td>{{ Helpers::getPegawais('IV', 'golongan') }}</td>
                                <td>Orang</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Golongan III</td>
                                <td>{{ Helpers::getPegawais('III', 'golongan') }}</td>
                                <td>Orang</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Golongan II</td>
                                <td>{{ Helpers::getPegawais('II', 'golongan') }}</td>
                                <td>Orang</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Golongan I</td>
                                <td>{{ Helpers::getPegawais('I', 'golongan') }}</td>
                                <td>Orang</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>PTT/Kontrak</td>
                                <td>{{ Helpers::getPegawaiKontrak('count') }}</td>
                                <td>Orang</td>
                            </tr>
                        </tbody>
                    </table>
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

@endsection

@extends('client.index')
@section('title', 'Profile | Data Pegawai')
@section('content_home')
<section class="section-frame overflow-hidden">
    <div class="wrapper image-wrapper bg-image bg-overlay bg-overlay-300" data-image-src="{{ asset($settings->header_image) }}">
        <div class="container pt-17 pb-19 pt-md-18 pb-md-17 text-center">
            <div class="row">
                <div class="col-lg-8 col-xl-7 col-xxl-6 mx-auto">
                <div class="post-header">
                    <!-- /.post-category -->
                    <h1 class="display-1 mb-4 text-white">Data Pegawai BPKAD</h1>
                </div>
                <!-- /.post-header -->
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<section class="wrapper bg-light">
    <div class="container py-5 py-md-5">
        <div class="row gx-lg-12 gx-xl-12">
            <div class="col-lg-12">
                <div class="blog single">
                    <div class="card p-10">
                        <h2><strong>Data Pegawai BPKAD</strong></h2>
                        <p>Untuk menjalankan tugas dan fungsi Badan Pengelolaan Keuangan dan Aset Daerah didukung oleh
                            Sumber Data
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
                                    {{-- {{ dd(get_defined_functions()['user']) }} --}}
                                    <tr>
                                        <td>1</td>
                                        <td>Kepala Badan</td>
                                        <td>II</td>
                                        <td>{{ get_pimpinan('count', 'kaban') }}</td>
                                        <td>Orang</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Sekretaris</td>
                                        <td>III</td>
                                        <td>{{ get_pimpinan('count', 'sekban') }}</td>
                                        <td>Orang</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Kepala Bidang/Kepala UPTB</td>
                                        <td>III</td>
                                        <td>{{ get_pimpinan('count', 'kabag') }}</td>
                                        <td>Orang</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Kepala Sub. Bagian/Sub.Bidang</td>
                                        <td>IV</td>
                                        <td>{{ get_pimpinan('count', 'kasubag') }}</td>
                                        <td>Orang</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Fungsional Umum</td>
                                        <td></td>
                                        <td>{{ get_pegawai('count', 'like', 'pegawai', 'Fungsional Umum') }}</td>
                                        <td>Orang</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Fungsional Tertentu</td>
                                        <td></td>
                                        <td>{{ get_pegawai('count', 'not', 'pegawai', 'Fungsional Umum') }}</td>
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
                                        <td>{{ get_pegawais('Doctor', 'pendidikan') }}</td>
                                        <td>Orang</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Magister/Strata 2 (S2)</td>
                                        <td>{{ get_pegawais('Pasca Sarjana', 'pendidikan') }}</td>
                                        <td>Orang</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Sarjana/Strata 1 (S1)</td>
                                        <td>{{ get_pegawais('Sarjana', 'pendidikan') }}</td>
                                        <td>Orang</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Ahli Madya/Diploma 3 (D1/D2/D3)</td>
                                        <td>{{ get_pegawais('Diploma', 'pendidikan') }}</td>
                                        <td>Orang</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Pendidikan Atas (SMA/SMK)</td>
                                        <td>{{ get_pegawais('SMA', 'pendidikan') }}</td>
                                        <td>Orang</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Pendidikan Menengah (SMP/SMPK)</td>
                                        <td>{{ get_pegawais('SMP', 'pendidikan') }}</td>
                                        <td>Orang</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Pendidikan Dasar (SD)</td>
                                        <td>{{ get_pegawais('SD', 'pendidikan') }}</td>
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
                                        <td>{{ get_pegawais('IV', 'golongan') }}</td>
                                        <td>Orang</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Golongan III</td>
                                        <td>{{ get_pegawais('III', 'golongan') }}</td>
                                        <td>Orang</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Golongan II</td>
                                        <td>{{ get_pegawais('II', 'golongan') }}</td>
                                        <td>Orang</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Golongan I</td>
                                        <td>{{ get_pegawais('I', 'golongan') }}</td>
                                        <td>Orang</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>PTT/Kontrak</td>
                                        <td>{{ get_pegawai_kontrak('count') }}</td>
                                        <td>Orang</td>
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
<section id="portfolio" class="portfolio">
    <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

    </div>
</section>
@endsection
@section('additional-js')

@endsection

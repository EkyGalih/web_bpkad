@extends('admin.index')
@section('title', 'Menu')
@section('menu-faq', 'show')
@section('faq-laporan', 'active')
@section('additional-css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('server/vendor/DataTables/DataTables-1.13.1/css/jquery.dataTables.min.css') }}" />
        <style>
            .image_upload>input {
                display: none;
            }
        </style>
@endsection
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>LAPORAN</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('laporan-admin.index') }}">Laporan</a></li>
                    <li class="breadcrumb-item active">Data Laporan Masyarakat</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if (Session::has('warning_ext'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            {{ Session::get('warning_ext') }}
                        </div>
                    @endif
                    @if (Session::has('warning_size'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            {{ Session::get('warning_size') }}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-10">
                                    <h5 class="card-title">Laporan Masyarakat</h5>
                                </div>
                            </div>
                            <table class="table table-hover" id="example">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Pelapor</th>
                                        <th scope="col">Laporan</th>
                                        <th scope="col">No.Hp Pelapor</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Bukti Laporan</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Jawaban</th>
                                        <th scope="col">Jawab Melalui</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($laporan as $lap)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $lap->nama_pelapor }}</td>
                                            <td><button class="btn btn-link" data-bs-tooltip="tooltip"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#ShowLaporan{{ $loop->iteration }}"
                                                    data-bs-placement="top"
                                                    title="Lihat Laporan">{{ $lap->kode_laporan }}</button></td>
                                            @include('admin/faq/laporan/addons/_detail')
                                            <td>{{ $lap->no_pelapor }}</td>
                                            <td>{{ $lap->kategori_laporan }}</td>
                                            <td><button class="btn btn-info btn-sm" data-bs-tooltip="tooltip"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#ShowBerkas{{ $loop->iteration }}"
                                                    data-bs-placement="top" title="Lihat Berkas"><i class="bi bi-eye"></i>
                                                    Bukti</button></td>
                                            <td>{{ $lap->tgl_laporan == null ? 'None' : Helpers::GetDate($lap->tgl_laporan) }}
                                                @include('admin/faq/laporan/addons/_bukti')
                                            </td>
                                            <td>
                                                <button class="btn btn-secondary btn-sm" data-bs-tooltip="tooltip"
                                                    data-bs-toggle="modal" data-bs-tooltip="tooltip" data-bs-placement="top"
                                                    title="Jawab" data-bs-target="#Jawab{{ $loop->iteration }}"><i
                                                        class="bi bi-pencil"></i></button>
                                                @include('admin/faq/laporan/addons/_jawab')
                                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-tooltip="tooltip" data-bs-placement="top" title="Lihat Jawaban"
                                                    data-bs-target="#ShowJawaban{{ $loop->iteration }}"><i
                                                        class="bi bi-eye"></i></button>
                                                @include('admin/faq/laporan/addons/_jawaban')
                                            </td>
                                            <td>{{ $lap->jawaban_dari }}</td>
                                            <td>
                                                <button class="btn btn-danger btn-md" data-bs-toggle="modal"
                                                    data-bs-target="#DeletePages{{ $loop->iteration }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>

                                                @include('admin/faq/laporan/addons/_delete')
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('additional-js')
    <script type="text/javascript" src="{{ asset('server/js/jquery-5.3.1.js') }}"></script>
    <script src="{{ asset('server/vendor/DataTables/DataTables-1.13.1/js/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });

        var loadBerkas = function(event) {
            var berkas = document.getElementById('berkas');
            berkas.src = URL.createObjectURL(event.target.files[0]);
            berkas.onload = function() {
                URL.revokeObjectURL(berkas.src);
            }
        };
    </script>
@endsection

@extends('admin.index')
@section('title', 'PPID | Struktur Organisasi PPID')
@section('ppid-menu', 'show')
@section('ppid-struktur', 'active')
@section('additional-css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('server/vendor/DataTables/DataTables-1.13.1/css/jquery.dataTables.min.css') }}" />
@endsection
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>PPID | Struktur Organisasi PPID</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('ppid-struktur.index') }}">PPID</a></li>
                    <li class="breadcrumb-item active">Struktur Organisasi PPID</li>
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
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-10">
                                    <h5 class="card-title">Struktur Organisasi PPID</h5>
                                </div>
                                <div class="col-lg-2">
                                    <a href="{{ route('ppid-struktur.create') }}" class="btn btn-outline-primary btn-md"
                                        style="margin-top: 10px;">
                                        <i class="bi bi-plus-square"></i> Tambah Data
                                    </a>
                                </div>
                            </div>
                            <table class="table table-hover" id="example">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Pegawai</th>
                                        <th scope="col">Jabatan</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($struktural as $item)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td>{{ $item->Pegawai->name }}</td>
                                            <td>{{ $item->nama_jabatan }}</td>
                                            <td>
                                                <a href="{{ route('ppid-struktur.edit', $item->ppid_id) }}"
                                                    class="btn btn-warning btn-md">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>

                                                <button class="btn btn-danger btn-md" data-bs-toggle="modal"
                                                    data-bs-target="#DeletePejabat{{ $loop->iteration }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>

                                                @include('admin/ppid/struktural/addons/delete')
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
    </script>
@endsection

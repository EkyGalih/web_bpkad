@extends('admin.index')
@section('title', 'Menu')
@section('menu-faq', 'show')
@section('faq-laporan', 'active')
@section('additional-css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('server/vendor/DataTables/DataTables-1.13.1/css/jquery.dataTables.min.css') }}" />
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
                                        <th scope="col">Judul Laporan</th>
                                        <th scope="col">Isi Laporan</th>
                                        <th scope="col">Asal Laporan</th>
                                        <th scope="col">Lokasi</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Bukti Laporan</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($laporan as $lap)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $lap->name }}</td>
                                            <td>{{ Helpers::GetUser($lap->create_by_id) }}</td>
                                            <td>{{ Helpers::GetDate($lap->created_at) }}</td>
                                            <td>{{ $lap->updated_at == null ? 'None' : Helpers::GetDate($lap->updated_at) }}
                                            </td>
                                            <td>
                                                <button type="submit" data-bs-toggle="modal" data-bs-target="#EditMenu{{ $loop->iteration }}"
                                                    class="btn btn-warning btn-md">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>

                                                <div class="modal fade" id="EditMenu{{ $loop->iteration }}" tabindex="-1">
                                                    <div class="modal-dialog modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"><i class="bi bi-pencil-square"></i>
                                                                    Ubah Menu</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('menu-admin.update', $lap->id) }}" method="POST">
                                                                    @csrf
                                                                    <div class="row mb-4">
                                                                        <label for="inputText" class="col-sm-2 col-form-label">Nama
                                                                            Menu</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="text" name="name" value="{{ $lap->name }}" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-4">
                                                                        <label for="inputText"
                                                                            class="col-sm-2 col-form-label">Page</label>
                                                                        <div class="col-sm-10">
                                                                            <select name="order_pos" class="form-control">
                                                                                <option value="">--Page--</option>

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-4">
                                                                        <label for="inputText"
                                                                            class="col-sm-2 col-form-label">Link</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="text" name="url" value="{{ $lap->url }}" class="form-control">
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                                                                        class="bi bi-x-circle"></i>
                                                                    Batal</button>
                                                                <button type="submit" class="btn btn-success">
                                                                    <i class="bi bi-save2"></i> Simpan
                                                                </button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button class="btn btn-danger btn-md" data-bs-toggle="modal"
                                                    data-bs-target="#DeletePages{{ $loop->iteration }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>

                                                <div class="modal fade" id="DeletePages{{ $loop->iteration }}"
                                                    tabindex="-1">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"><i
                                                                        class="bi bi-exclamation-octagon-fill"></i> Hapus
                                                                    Postingan</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Halaman <strong><u>{{ $lap->name }}</u></strong>
                                                                    akan dihapus.<br /> Anda Yakin?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-secondary"
                                                                    data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>
                                                                    Tidak</button>
                                                                <a href="{{ route('menu-admin.destroy', $lap->id) }}"
                                                                    class="btn btn-outline-danger">
                                                                    <i class="bi bi-check-circle"></i> Ya
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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

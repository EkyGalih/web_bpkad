@extends('admin.index')
@section('title', 'PPID | Klasifikasi Informasi Publik')
@section('ppid-menu', 'show')
@section('ppid-ki', 'active')
@section('additional-css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('server/vendor/DataTables/DataTables-1.13.1/css/jquery.dataTables.min.css') }}" />
@endsection
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>PPID | Klasifikasi Informasi Publik</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('post-admin.index') }}">PPID</a></li>
                    <li class="breadcrumb-item active">Klasifikasi Informasi Publik</li>
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
                                    <h5 class="card-title">Klasifikasi Informasi Publik</h5>
                                </div>
                                <div class="col-lg-2">
                                    <a href="{{ route('ppid-kip.create') }}" class="btn btn-outline-primary btn-md"
                                        style="margin-top: 10px;">
                                        <i class="bi bi-plus-square"></i> Tambah Data
                                    </a>
                                    <button data-bs-toggle="modal" data-bs-target="#CacheKIP" data-bs-tooltip="tooltip"
                                        data-bs-placement="top" style="margin-top: 10px;" title="File Sampah"
                                        class="btn btn-danger btn-md">
                                        <i class="bi bi-trash2"></i>
                                    </button>
                                    @include('admin/ppid/kip/addons/_cache')
                                </div>
                            </div>
                            <table class="table table-hover datatables">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Data</th>
                                        <th scope="col">Jenis Informasi</th>
                                        <th scope="col">Jenis File</th>
                                        <th scope="col">Files</th>
                                        <th scope="col">Diupload Oleh</th>
                                        <th scope="col">Buat Pada</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kip as $item)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td style="width: 35%;">{{ $item->nama_informasi }}</td>
                                            <td>
                                                @if ($item->jenis_informasi == 'berkala')
                                                    <span class="badge bg-info"><i class="bi bi-arrow-repeat"></i>
                                                        {{ ucfirst($item->jenis_informasi) }}
                                                    </span>
                                                @elseif ($item->jenis_informasi == 'dikecualikan')
                                                    <span class="badge bg-danger"><i class="bi bi-eye-slash"></i>
                                                        {{ ucfirst($item->jenis_informasi) }}
                                                    </span>
                                                @elseif ($item->jenis_informasi == 'setiap saat')
                                                    <span class="badge bg-warning"><i class="bi bi-stars"></i>
                                                        {{ ucfirst($item->jenis_informasi) }}
                                                    </span>
                                                @elseif ($item->jenis_informasi == 'serta merta')
                                                    <span class="badge bg-secondary"><i class="bi bi-info-circle"></i>
                                                        {{ ucfirst($item->jenis_informasi) }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td><span
                                                    class="badge bg-{{ $item->jenis_file == 'link' ? 'secondary' : 'info' }}"><i
                                                        class="bi bi-{{ $item->jenis_file == 'link' ? 'link' : 'upload' }}"></i>
                                                    {{ ucfirst($item->jenis_file) }}</span></td>
                                            <td>
                                                @if ($item->jenis_file == 'link')
                                                    <a href="{{ $item->files }}" target="_blank"
                                                        class="btn btn-success btn-sm"><i class="bi bi-download"></i>
                                                        Goto</a>
                                                @else
                                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#ShowFile{{ $loop->iteration }}"><i
                                                            class="bi bi-eye"></i> View</button>
                                                    @include('admin.ppid.kip.addons.show_pdf')
                                                @endif
                                            </td>
                                            <td>{{ Helpers::GetUser($item->upload_by) }}</td>
                                            <td>{{ $item->created_at == null ? 'None' : Helpers::GetDate($item->created_at) }}
                                            </td>
                                            <td>
                                                <a href="{{ route('ppid-kip.edit', $item->id) }}"
                                                    class="btn btn-secondary btn-md" data-bs-tooltip="tooltip"
                                                    data-bs-placement="top" title="Ubah Berkas">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <button class="btn btn-warning btn-md" data-bs-toggle="modal"
                                                    data-bs-tooltip="tooltip" data-bs-placement="top"
                                                    title="Hapus Berkas"
                                                    data-bs-target="#DeletePost{{ $loop->iteration }}">
                                                    <i class="bi bi-recycle"></i>
                                                </button>

                                                @include('admin/ppid/kip/delete')
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
@endsection

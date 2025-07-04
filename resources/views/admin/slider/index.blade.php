@extends('admin.index')
@section('title', 'Slider Informasi')
@section('di-menu', 'show')
@section('di-slider', 'active')
@section('additional-css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('server/vendor/DataTables/DataTables-1.13.1/css/jquery.dataTables.min.css') }}" />
@endsection
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Slider & Caraousel</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('slider.index') }}">Slider&Caraousel</a></li>
                    <li class="breadcrumb-item active">Slider&Carousel</li>
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
                                <div class="col-sm-9">
                                    <h5 class="card-title">Slider</h5>
                                </div>
                                <div class="col-sm-3">
                                    <a href="{{ route('slider.create') }}" class="btn btn-outline-primary btn-md"
                                        style="margin-top: 10px; margin-left: 80px;">
                                        <i class="bi bi-plus-square"></i> Tambah Data
                                    </a>
                                    <button type="button" class="btn btn-danger btn-md" data-bs-toggle="modal"
                                        data-bs-target="#CacheSlider" data-bs-tooltip="tooltip" data-bs-placement="top"
                                        title="File Sampah" style="margin-top: 10px;">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    @include('admin/slider/addons/_cache')
                                </div>
                            </div>
                            <table class="table table-hover slider">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama/Katergori</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Jenis Slide</th>
                                        <th scope="col">Buat Pada</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($slider as $item)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $item->title }}</td>
                                            <td style="width: 50%;">{{ $item->keterangan }}</td>
                                            <td>{{ $item->Slide->nama_slide }}</td>
                                            <td>{{ get_date($item->created_at) ?? '-' }}</td>
                                            <td>
                                                <a href="{{ route('slider.edit', $item->id) }}"
                                                    class="btn btn-warning btn-md">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <button class="btn btn-danger btn-md" data-bs-toggle="modal"
                                                    data-bs-target="#DeleteSlider{{ $loop->iteration }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>

                                                @include('admin/slider/addons/delete')
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
            $('.slider').DataTable();
            $('.cache').DataTable();
        });
    </script>
@endsection

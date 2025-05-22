@extends('admin.index')
@section('title', 'Banner Informasi')
@section('di-menu', 'show')
@section('di-banner', 'active')
@section('additional-css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('server/vendor/DataTables/DataTables-1.13.1/css/jquery.dataTables.min.css') }}" />
@endsection
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Banner Informasi</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('slider.index') }}">Banner Informasi</a></li>
                    <li class="breadcrumb-item active">Banner Informasi</li>
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
                                <div class="col-sm-10">
                                    <h5 class="card-title">Slider</h5>
                                </div>
                                <div class="col-sm-2">
                                    <a href="{{ route('slider.create') }}" class="btn btn-outline-primary btn-md"
                                        style="margin-top: 10px;">
                                        <i class="bi bi-plus-square"></i> Tambah Data
                                    </a>
                                </div>
                            </div>
                            <table class="table table-hover slider">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Informasi</th>
                                        <th scope="col">Buat Pada</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banners as $item)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $item->deskripsi }}</td>
                                            <td>{{ Helpers::GetDate($item->created_at) ?? '-' }}</td>
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
        });
    </script>
@endsection

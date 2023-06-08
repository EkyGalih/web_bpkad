@extends('operator.index')
@section('title', 'Link Terkait')
@section('menu-tools', 'show')
@section('tools-link', 'active')
@section('additional-css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('server/vendor/DataTables/DataTables-1.13.1/css/jquery.dataTables.min.css') }}" />
@endsection
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Link Terkait</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('operator') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('tools-link') }}">Tools</a></li>
                    <li class="breadcrumb-item active">Link Terkait</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        {{ Session::get('success') }}
                    </div>
                @endif
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-10">
                                    <h5 class="card-title">{{ $link == null ? 'Tambah' : 'Ubah' }} Link Terkait <br />
                                        <span>{{ $link == null ? 'Tambah' : 'Ubah' }} data link terkait</span>
                                    </h5>
                                </div>
                                <hr />
                            </div>
                            <form
                                action="{{ $link == null ? route('tools-link.store') : route('tools-link.update', $link->id) }}"
                                method="POST">
                                @csrf
                                @if ($link != null)
                                    @method('PUT')
                                @endif
                                <div class="row">
                                    <label for="inputtext">Nama</label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            value="{{ $link->name ?? '' }}" name="name">
                                        @error('name')
                                            <div class="alert alert-danger" style="padding: 8px;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="inputText">Link</label>
                                        <input type="link" class="form-control @error('link') is-invalid @enderror"
                                            name="link" value="{{ $link->link ?? '' }}">
                                        @error('link')
                                            <div class="alert alert-danger" style="padding: 8px;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div><br />
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-success btn-md">
                                            <i class="bi bi-save"></i> Simpan
                                        </button>
                                        @if ($link != null)
                                            <a href="{{ route('tools-link') }}" class="btn btn-primary btn-md">
                                                <i class="bi bi-plus"></i> Tambah
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-9">
                                    <h5 class="card-title"><i class="bi bi-link"></i> Semua Link <br /> <span>Data semua
                                            link terkait</span></h5>
                                </div>
                            </div>
                            <table class="table table-hover" id="table-link">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Link</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($links as $link)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $link->name }}</td>
                                            <td>{{ $link->link }}</td>
                                            <td>
                                                <a href="{{ route('tools-link', $link->id) }}"
                                                    class="btn btn-warning btn-md">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>

                                                <button class="btn btn-danger btn-md" data-bs-toggle="modal"
                                                    data-bs-target="#DeleteLink{{ $loop->iteration }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>

                                                @include('operator/Tools/Links/addons/_delete')
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $links->links() }}
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
            $('#table-link').DataTable();
        });
    </script>
@endsection

@extends('operator.index')
@section('title', 'Sosial Media')
@section('menu-tools', 'show')
@section('tools-social', 'active')
@section('additional-css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('server/vendor/DataTables/DataTables-1.13.1/css/jquery.dataTables.min.css') }}" />
@endsection
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Sosial Media</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('operator') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('tools-op-social') }}">Tools</a></li>
                    <li class="breadcrumb-item active">Sosial Media</li>
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
                                    <h5 class="card-title">Atur Sosial Media <br />
                                        <span>Atur data Sosial Media</span>
                                    </h5>
                                </div>
                                <hr />
                            </div>
                            <form action="{{ route('tools-op-social.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <label for="inputtext"><i class="bi bi-instagram"></i> Social</label>
                                    <div class="col-lg-12">
                                        <select name="social" class="form-control">
                                            <option value="">--- Pilih Jenis ---</option>
                                            <option value="twitter">twitter</option>
                                            <option value="facebook">facebook</option>
                                            <option value="youtube">youtube</option>
                                            <option value="instagram">instagram</option>
                                            <option value="whatsapp">whatsapp</option>
                                        </select>
                                        @error('twitter')
                                            <div class="alert alert-danger" style="padding: 8px;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div><br />
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="inputText"><i class="bi bi-link-45deg"></i> Link</label>
                                        <input type="link" class="form-control @error('link') is-invalid @enderror"
                                            name="link" value="{{ $social->link ?? '' }}">
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
                                        <th>Sosial Media</th>
                                        <th style="text-align: center;">Link</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><i style="font-size: 50px; text-align: center;" class="bi bi-twitter"></i></td>
                                        <td><a href="{{ $social->twitter ?? '-' }}"
                                                target="_blank">{{ $social->twitter ?? '-' }}</a></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><i style="font-size: 50px; text-align: center;" class="bi bi-facebook"></i></td>
                                        <td><a href="{{ $social->facebook ?? '-' }}"
                                                target="_blank">{{ $social->facebook ?? '-' }}</a></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><i style="font-size: 50px; text-align: center;" class="bi bi-youtube"></i></td>
                                        <td><a href="{{ $social->youtube ?? '-' }}"
                                                target="_blank">{{ $social->youtube ?? '-' }}</a></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><i style="font-size: 50px; text-align: center;" class="bi bi-instagram"></i>
                                        </td>
                                        <td><a href="{{ $social->instagram ?? '-' }}"
                                                target="_blank">{{ $social->instagram ?? '-' }}</a></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><i style="font-size: 50px; text-align: center;" class="bi bi-whatsapp"></i></td>
                                        <td><a href="{{ $social->whatsapp ?? '-' }}"
                                                target="_blank">{{ $social->whatsapp ?? '-' }}</a></td>
                                        <td></td>
                                    </tr>
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
            $('#table-link').DataTable();
        });
    </script>
@endsection

@extends('admin.index')
@section('title', 'Alamat kantor')
@section('menu-tools', 'show')
@section('tools-address', 'active')
@section('additional-css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('server/vendor/DataTables/DataTables-1.13.1/css/jquery.dataTables.min.css') }}" />
@endsection
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Alamat Kantor</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('pages-admin.index') }}">Tools</a></li>
                    <li class="breadcrumb-item active">Alamat Kantor</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-6">
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
                                    <h5 class="card-title">Alamat Kantor <br /> <span>Atur alamat kantor (Jalan, Koordinat,
                                            nomor telepon/fax, dan email)</span></h5>
                                </div>
                            </div>
                            <form action="#" method="POST">
                                @csrf
                                <div class="row">
                                    <label for="inputtext">Alamat/Jalan</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" name="address">{{ $address->address }}</textarea>
                                    </div>
                                </div><br/>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="inputText">Latitude</label>
                                        <input type="text" class="form-control" value="{{ $address->lat }}" name="lat">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="inputText">Longitude</label>
                                        <input type="text" class="form-control" value="{{ $address->lng }}" name="lng">
                                    </div>
                                </div><br/>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="inputText">Phone</label>
                                        <input type="text" class="form-control" name="phone" value="{{ $address->phone }}">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="inputText">Fax</label>
                                        <input type="text" class="form-control" name="fax" value="{{ $address->fax }}">
                                    </div>
                                </div><br/>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="inputText">Email</label>
                                        <input type="text" class="form-control" name="email" value="{{ $address->email }}">
                                    </div>
                                </div><br/>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-primary btn-md">
                                            <i class="bi bi-save"></i> Simpan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-10">
                                    <h5 class="card-title">Alamat Kantor <br /> <span>Atur alamat kantor (Koordinat
                                            Kantor)</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@extends('layouts.app')
@section('title', 'Pengguna')
@section('menu-user', 'active')
@section('content')
<section class="breadcrumbs">
    <div class="container">
        
        <div class="d-flex justify-content-between align-items-center">
            <h2>Tabel Manajemen User</h2>
            <ol>
                <a href="{{ route('pengguna') }}" class="btn btn-outline-dark btn-block btn-sm">
                    <i class="icofont-backward"></i> Kembali
                </a>
            </ol>
        </div>
        
    </div>
</section>
<section class="portfolio-details">
    <div class="container">
        
        <div class="portfolio-details-container">
            
            <div class="owl-carousel portfolio-details-carousel">
                @if (isset($users))
                <form action="{{ route('pengguna.update', $users->id) }}" method="POST">
                    @csrf()
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="nama">Nama User <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control" value="{{ $users->nama }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" value="{{ $users->email }}">
                            </div>
                            <div class="form-group">
                                <label for="username">Username <span class="text-danger">*</span></label>
                                <input type="text" name="username" class="form-control" value="{{ $users->username }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6"></div>
                        <div class="col-lg-2">
                            <button type="reset" class="btn btn-outline-danger btn-sm pull-right">
                                <i class="icofont-refresh"></i> Batal
                            </button>
                            <button type="submit" class="btn btn-outline-primary btn-sm pull-right">
                                <i class="icofont-save"></i> Simpan
                            </button>
                        </div>
                    </div>
                </form>
                @else
                <form action="{{ route('pengguna.store') }}" method="POST">
                    @csrf()
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="nama">Nama User <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="@error('nama') is-invalid @enderror form-control">
                                @error('nama')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" class="@error('password') is-invalid @enderror form-control">
                                @error('password')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="@error('email') is-invalid @enderror form-control">
                                @error('email')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="nama_rule">Rule <span class="text-danger">*</span></label>
                                <select name="nama_rule" id="nama_rule" class="@error('nama_rule') is-invalid @enderror form-control">
                                    <option>Pilih Role</option>
                                    <option value="superadmin">Admin</option>
                                    <option value="admin">Operator</option>
                                </select>
                                @error('nama_rule')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="username">Username <span class="text-danger">*</span></label>
                                <input type="text" name="username" class="@error('username') is-invalid @enderror form-control">
                                @error('username')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="aplikasi">Aplikasi <span class="text-danger">*</span></label>
                                <select name="aplikasi" id="aplikasi" class="@error('aplikasi') is-invalid @enderror form-control">
                                    <option>Pilih Aplikasi</option>
                                    <option value="website">Website</option>
                                    <option value="ppid">PPID</option>
                                </select>
                                @error('aplikasi')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-10"></div>
                        <div class="col-lg-2">
                            <button type="reset" class="btn btn-outline-danger btn-sm pull-right">
                                <i class="icofont-refresh"></i> Batal
                            </button>
                            <button type="submit" class="btn btn-outline-primary btn-sm pull-right">
                                <i class="icofont-save"></i> Simpan
                            </button>
                        </div>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</section>
<hr/>
@endsection
@extends('layouts.app')
@section('title', 'Pengguna')
@section('menu-user', 'active')
@section('content')
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2><i class="bx bx-user-plus"></i> Tambah Pengguna</h2>
                <ol>
                    <a href="{{ route('pengguna') }}" class="btn btn-dark btn-block btn-sm">
                        <i class="bx bx-arrow-back"></i> Kembali
                    </a>
                </ol>
            </div>

        </div>
    </section>
    <section class="portfolio-details">
        <div class="container">

            <div class="portfolio-details-container">

                <div class="owl-carousel portfolio-details-carousel">
                    <form action="{{ route('pengguna.store') }}" method="POST">
                        @csrf()
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="nama">Nama User <span class="text-danger">*</span></label>
                                    <input type="text" name="nama"
                                        class="@error('nama') is-invalid @enderror form-control">
                                    @error('nama')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password"
                                        class="@error('password') is-invalid @enderror form-control">
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
                                    <input type="email" name="email"
                                        class="@error('email') is-invalid @enderror form-control">
                                    @error('email')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="nama_rule">Rule <span class="text-danger">*</span></label>
                                    <select name="nama_rule" id="nama_rule"
                                        class="@error('nama_rule') is-invalid @enderror form-control">
                                        <option>Pilih Role</option>
                                        <option value="superadmin">SuperAdmin</option>
                                        <option value="admin">Admin</option>
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
                                    <input type="text" name="username"
                                        class="@error('username') is-invalid @enderror form-control">
                                    @error('username')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="aplikasi">Aplikasi <span class="text-danger">*</span></label><br/>
                                    @foreach ($apps as $app)
                                        <input type="checkbox" name="aplikasi[]" value="{{ $app->id }}">
                                        {{ $app->name }} <br/>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-10"></div>
                            <div class="col-lg-2">
                                <button type="reset" class="btn btn-danger btn-sm pull-right">
                                    <i class="bx bx-undo"></i> Batal
                                </button>
                                <button type="submit" class="btn btn-primary btn-sm pull-right">
                                    <i class="bx bx-save"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <hr />
@endsection

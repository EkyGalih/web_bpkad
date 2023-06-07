@extends('layouts.app')
@section('title', 'Pengguna')
@section('menu-user', 'active')
@section('content')
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2><i class="bx bx-user-pin"></i> Ubah Pengguna</h2>
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
                                    <input type="text" name="username" class="form-control"
                                        value="{{ $users->username }}">
                                </div>
                                <div class="form-group">
                                    <label for="nama_rule">Rule <span class="text-danger">*</span></label>
                                    <select name="nama_rule" id="nama_rule" class="form-control">
                                        <option>Pilih Role</option>
                                        <option value="superadmin" {{ $users->role == 'superadmin' ? 'selected' : '' }}>
                                            SuperAdmin</option>
                                        <option value="admin" {{ $users->role == 'admin' ? 'selected' : '' }}>Admin
                                        </option>
                                        <option value="operator" {{ $users->role == 'operator' ? 'selected' : '' }}>Operator
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="aplikasi">Aplikasi <span class="text-danger">*</span></label><br/>
                                    @foreach ($apps as $key => $app)
                                        <input type="checkbox" name="aplikasi[]" value="{{ $app->id }}" {{ $users->Rule[$key]->apps_id == $app{$key}->id ? 'checked' : '' }}>
                                        {{ $app->name }} <br />
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6"></div>
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

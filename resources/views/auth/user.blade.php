@extends('layouts.app')
@section('title', 'Pengguna')
@section('menu-user', 'active')
@section('content')
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2><i class="bx bx-user"></i> Tabel Manajemen User</h2>
                <ol>
                    <a href="{{ route('pengguna.tambah') }}" class="btn btn-outline-primary btn-block btn-sm">
                        <i class="bx bx-user-plus"></i> Tambah User
                    </a>
                </ol>
            </div>

        </div>
    </section>
    <section class="portfolio-details">
        <div class="container">

            <div class="portfolio-details-container">
                <div class="row">
                    <div class="col-lg-8"></div>
                    <div class="col-lg-4">
                        <form action="{{ route('pengguna') }}" method="GET">
                            <div class="input-group mb-3">
                                @if (isset($search))
                                    <input type="text" class="form-control" id="search" name="search"
                                        value="{{ $search }}">
                                    <div class="input-group-append">
                                        <a href="{{ route('pengguna') }}" class="btn btn-outline-danger btn-xs"
                                            title="Bersihkan Pencarian..">
                                            <i class="bx bx-undo"></i>
                                        </a>
                                        <button type="submit" class="btn btn-outline-primary btn-xs" title="cari..">
                                            <i class="bx bx-search"></i>
                                        </button>
                                    </div>
                                @else
                                    <input type="text" class="form-control" id="search" name="search"
                                        placeholder="Ketikkan username atau email">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-outline-primary btn-xs" title="cari..">
                                            <i class="bx bx-search"></i>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div><br />
                <div class="owl-carousel portfolio-details-carousel">
                    <table class="table table-bordered" style="background-color: #ffffff !important;">
                        <thead class="table-dark">
                            <tr>
                                <th>NO</th>
                                <th>Nama User</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Apps</th>
                                <th>Jml Rule</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->nama }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach ($user->Rule as $item)
                                            <ul>
                                                <li>{{ $item->Apps->name }}</li>
                                            </ul>
                                        @endforeach
                                    </td>
                                    <td>
                                        {{ '(' . $user->Rule->count() . ')' }}
                                    </td>
                                    <td>
                                        @if ($user->active == 1)
                                            <span class="badge badge-success badge-pill">Aktif</span>
                                        @else
                                            <span class="badge badge-danger badge-pill">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('pengguna.ubah', $user->id) }}"
                                                class="btn btn-outline-warning btn-sm"
                                                title="Edit User {{ $user->username }}">
                                                <i class="bx bx-pencil"></i>
                                            </a>
                                            <a href="#" class="btn btn-outline-danger btn-sm"
                                                title="Hapus User {{ $user->username }}">
                                                <i class="bx bx-user-minus"></i>
                                            </a>
                                            <a href="{{ route('pengguna.show', $user->id) }}"
                                                class="btn btn-outline-info btn-sm"
                                                title="Show Detail {{ $user->username }}">
                                                <i class="bx bx-show"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <hr />
@endsection

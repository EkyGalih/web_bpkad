@extends('layouts.app')
@section('title', 'Detail Pengguna')
@section('menu-user', 'active')
@section('additional-css')
<link rel="stylesheet" href="{{ asset('client/assets/css/bpkad.css') }}">
@endsection
@section('content')
<section class="breadcrumbs">
    <div class="container">
        
        <div class="d-flex justify-content-between align-items-center">
            <h2>Detail Manajemen User</h2>
            <ol>
                <a href="{{ route('pengguna') }}" class="btn btn-outline-dark btn-block btn-sm">
                    <i class="icofont-reply"></i> Kembali
                </a>
            </ol>
        </div>
        
    </div>
</section>
<section class="team section-bg">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                <div class="member">
                    <div class="member-img">
                        <img src="{{ asset('client/assets/img/team/team-1.jpg')}}" class="img-fluid" alt="">
                    </div>
                    <div class="member-info" style="text-align: center;">
                        <h4>{{ $users->nama }}</h4>
                        <span>{{ $users->email }}</span>
                        <span>{{ $users->username }}</span><br/>
                        <div class="btn-group">
                            <a href="{{ route('pengguna.ubah', $users->id) }}" class="btn btn-outline-warning btn-sm">Edit</a>
                            <a href="#" class="btn btn-outline-info btn-sm">Reset Password</a>
                            <a href="#" class="btn btn-outline-success btn-sm">
                                @if ($users->active == '1')
                                Aktif
                                @else
                                Tidak Aktif
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9" data-aos="fade-up" data-aos-delay="100">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Aplikasi dan Role</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-list">
                            @foreach ($rules as $rule)
                            <div class="item-list" id="role1" style="border-bottom: 1px solid #EDEFF2">
                                <div class="avatar">
                                    <span class="avatar-title rounded-circle border border-white">{{ $loop->iteration }}</span>
                                </div>
                                <div class="info-user ml-3">
                                    <div class="username">{{ $rule->aplikasi }}</div>
                                    <div class="status">{{ $rule->nama_rule }}</div>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-dark btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Aksi
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item">
                                            <i class="icofont-edit"></i>
                                            Edit Role dan Aplikasi
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <button class="dropdown-item" onclick="deleteRole('1')">
                                            <i class="icofont-trash"></i>
                                            Hapus Role dan Aplikasi
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn-outline-primary btn-sm pull-right">
                            <i class="icofont-plus"></i> Tambah Rule
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
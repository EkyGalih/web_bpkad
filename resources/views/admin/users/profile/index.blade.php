@extends('admin.index')
@section('title', 'Profil')
@section('additional-css')
    <style>
        .image_upload>input {
            display: none;
        }
    </style>
@endsection
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Profil</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item">Pengguna</li>
                    <li class="breadcrumb-item active">Profil</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                            <img src="{{ asset($user->avatar) }}" alt="Profile" class="rounded-circle">
                            <h2>{{ $user->nama }}</h2>
                            <h3>{{ strtoupper($user->role) }}</h3>
                            <div class="social-links mt-2">
                                <a href="{{ $user->Social->twitter ?? '#' }}" class="twitter" target="_blank"><i
                                        class="bi bi-twitter"></i></a>
                                <a href="{{ $user->Social->facebook ?? '#' }}" class="facebook" target="_blank"><i
                                        class="bi bi-facebook"></i></a>
                                <a href="{{ $user->Social->instagram ?? '#' }}" class="instagram" target="_blank"><i
                                        class="bi bi-instagram"></i></a>
                                <a href="{{ $user->Social->youtube ?? '#' }}" class="youtube" target="_blank"><i
                                        class="bi bi-youtube"></i></a>
                                <a href="{{ $user->Social->whatsapp ?? '#' }}" class="whatsapp" target="_blank"><i
                                        class="bi bi-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-xl-8">
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            {{ Session::get('success') }}
                        </div>
                    @elseif (Session::has('fail'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            {{ Session::get('fail') }}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link {{ $active }}" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Ringkasan</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Ubah
                                        Profile</button>
                                </li>

                                {{-- <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#profile-settings">Pengaturan</button>
                                </li> --}}

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#profile-change-password">Ubah Sandi</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade {{ $show . ' ' . $active }} profile-overview"
                                    id="profile-overview">
                                    {{-- <h5 class="card-title">About</h5>
                                    <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores
                                        cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure
                                        rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at
                                        unde.</p> --}}

                                    <h5 class="card-title">Profile Details</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->nama }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Kantor</div>
                                        <div class="col-lg-9 col-md-8">BPKAD PROVINSI NTB</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Jabatan</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->role }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Status</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->active == 1 ? 'Aktif' : 'Non-Aktif' }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Phone</div>
                                        <div class="col-lg-9 col-md-8">{{ Helpers::__phone($user->phone) }} </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                                    </div>

                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                    <!-- Profile Edit Form -->
                                    <form action="{{ route('profile.update', $user->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row mb-3">
                                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Foto
                                                Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <img src="{{ asset($user->avatar) }}" alt="Profile" id="profile"
                                                    style="max-width: 40%; height: 120px;">
                                                <div class="pt-2">
                                                    <p class="image_upload">
                                                        <label for="userImage">
                                                            <a class="btn btn-primary btn-sm" rel="nofollow"><span
                                                                       class='bi bi-upload'></span></a>
                                                        </label>
                                                        <input type="file" name="foto" id="userImage"
                                                            accept="image/*" onchange="loadFile(event)">
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="nama_lengkap" class="col-md-4 col-lg-3 col-form-label">Nama
                                                Lengkap</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="nama" type="text" class="form-control"
                                                    id="nama_lengkap" value="{{ $user->nama }}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="username"
                                                class="col-md-4 col-lg-3 col-form-label">Username</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="text" name="username" value="{{ $user->username }}"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone" type="text" class="form-control" id="Phone"
                                                    value="{{ $user->phone }}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control" id="Email"
                                                    value="{{ $user->email }}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter
                                                Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="twitter" type="text" class="form-control" id="Twitter"
                                                    value="{{ $user->Social->twitter }}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook
                                                Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="facebook" type="text" class="form-control"
                                                    id="Facebook" value="{{ $user->Social->facebook }}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram
                                                Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="instagram" type="text" class="form-control"
                                                    id="Instagram" value="{{ $user->Social->instagram }}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Whatsapp" class="col-md-4 col-lg-3 col-form-label">Whatsapp
                                                Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="whatsapp" type="text" class="form-control"
                                                    id="Whatsapp" value="{{ $user->Social->whatsapp }}">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </form><!-- End Profile Edit Form -->

                                </div>

                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <!-- Change Password Form -->
                                    <form action="{{ route('profile.password', $user->id) }}" method="POST"
                                        onsubmit="return validateForm()">
                                        @csrf
                                        @method('PUT')

                                        <div class="row mb-3">
                                            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Password
                                                Lama</label>
                                            <div class="col-md-8 col-lg-9">
                                                <div class="input-group">
                                                    <input name="password" type="password" class="form-control"
                                                        id="currentPassword" required value="{{ old('password') }}">
                                                    <div class="input-group-prepend">
                                                        <button type="button" onclick="btn1()" class="input-group-text">
                                                            <i id="labelcurrentPassword" class="bi bi-eye"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                @error('password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Password
                                                Baru</label>
                                            <div class="col-md-8 col-lg-9">
                                                <div class="input-group">
                                                    <input name="newpassword" type="password" class="form-control"
                                                        required id="newpassword" value="{{ old('newpassword') }}">
                                                    <div class="input-group-prepend">
                                                        <button type="button" onclick="btn2()" class="input-group-text">
                                                            <i id="labelnewpassword" class="bi bi-eye"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                @error('newpassword')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-Enter
                                                Password Baru</label>
                                            <div class="col-md-8 col-lg-9">
                                                <div class="input-group">
                                                    <input name="renewpassword" type="password" class="form-control"
                                                        required id="renewpassword" value="{{ old('renewpassword') }}">
                                                    <div class="input-group-prepend">
                                                        <button type="button" onclick="btn3()" class="input-group-text">
                                                            <i id="labelrenewpassword" class="bi bi-eye"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                @error('renewpassword')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <p class="text-danger" id="message"></p>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Ubah Password</button>
                                        </div>
                                    </form><!-- End Change Password Form -->

                                </div>

                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
@endsection
@section('additional-js')
    <script>
        function btn1() {
            let attr = $('#currentPassword').attr("type");
            if (attr == 'password') {
                $('#currentPassword').prop('type', 'text');
                $('#labelcurrentPassword').removeClass('bi bi-eye');
                $('#labelcurrentPassword').addClass('bi bi-eye-slash');
            } else if (attr == 'text') {
                $('#currentPassword').prop('type', 'password');
                $('#labelcurrentPassword').removeClass('bi bi-eye-slash');
                $('#labelcurrentPassword').addClass('bi bi-eye');
            }
        }

        function btn2() {
            let attr = $('#newpassword').attr("type");
            if (attr == 'password') {
                $('#newpassword').prop('type', 'text');
                $('#labelnewpassword').removeClass('bi bi-eye');
                $('#labelnewpassword').addClass('bi bi-eye-slash');
            } else if (attr == 'text') {
                $('#newpassword').prop('type', 'password');
                $('#labelnewpassword').removeClass('bi bi-eye-slash');
                $('#labelnewpassword').addClass('bi bi-eye');
            }
        }

        function btn3() {
            let attr = $('#renewpassword').attr("type");
            if (attr == 'password') {
                $('#renewpassword').prop('type', 'text');
                $('#labelrenewpassword').removeClass('bi bi-eye');
                $('#labelrenewpassword').addClass('bi bi-eye-slash');
            } else if (attr == 'text') {
                $('#renewpassword').prop('type', 'password');
                $('#labelrenewpassword').removeClass('bi bi-eye-slash');
                $('#labelrenewpassword').addClass('bi bi-eye');
            }
        }

        // cek sandi baru sama atau tidak
        $('#newpassword, #renewpassword').on('keyup', function() {
            if ($('#newpassword').val() == $('#renewpassword').val()) {
                $("#message").html('');
            } else {
                $("#message").html('Kata sandi tidak sama').css('color', 'red');
            }
        });


        // preview image
        var loadFile = function(event) {
            var output = document.getElementById('profile');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
@endsection

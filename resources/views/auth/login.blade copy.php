<!DOCTYPE html>
<html lang="id">
<!--begin::Head-->

<head>
    <title>{{ ENV('APP_NAME') }} | Login</title>
    <meta charset="utf-8" />
    <meta name="description" content="Sistem Informasi BPKAD Provinsi NTB" />
    <meta name="keywords" content="sistem informasi, bpkad, Provinsi NTB, mataram, bpkad ntb, website" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="id_ID" />
    <meta property="og:type" content="sistem informasi" />
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:url" content="https://bpkad.ntbprov.go.id" />
    <meta property="og:site_name" content="BPKAD" />
    @include('layouts.admin.simpeg.css')
</head>

<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center bgi-no-repeat">
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <style>
            body {
                background-image: url({{ asset('assets/media/auth/bg4.jpg') }});
            }

            [data-bs-theme="dark"] body {
                background-image: url({{ asset('assets/media/auth/bg4-dark.jpg') }});
            }
        </style>
        <div class="d-flex flex-column flex-column-fluid flex-lg-row">
            <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
                <div class="d-flex flex-center flex-lg-start flex-column">
                    <a href="{{ route('login.index') }}" class="d-flex align-items-center mb-7">
                        <img alt="Logo" src="https://storage.ntbprov.go.id/bpkad/uploads/defaults/ntb.png"
                            style="width: 50px; height: 80px;" />
                        <img src="{{ $settings->logo_image }}" class="text-white fw-bold fs-2 ms-5">
                    </a>
                    <h2 class="text-white fw-normal m-0">Badan Pengelolaan Keuangan dan Aset Daerah Provinsi Nusa Tenggara Barat</h2>
                </div>
            </div>
            <div
                class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
                <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
                    <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
                        <form class="form w-100" novalidate="novalidate" method="POST"
                            action="{{ route('login.store') }}">
                            @csrf
                            <div class="text-center mb-11">
                                <h1 class="text-gray-900 fw-bolder mb-3">Masuk</h1>
                            </div>
                            @if (Session::has('failed'))
                                <div class="alert alert-danger" role="alert">
                                    {{ Session::get('failed') }}
                                </div>
                            @endif
                            <div class="fv-row mb-8">
                                <input type="text" placeholder="Email atau Username" name="email"
                                    autocomplete="off"
                                    class="form-control bg-transparent @error('email') is-invalid @enderror" />
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="fv-row mb-3">
                                <input type="password" placeholder="Kata Sandi" name="password" autocomplete="off"
                                    class="form-control bg-transparent @error('password') is-invalid @enderror" />
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                <div></div>
                                {{-- <a href="#" class="link-primary">Forgot Password ?</a> --}}
                            </div>
                            <div class="d-grid mb-10">
                                <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                    <span class="indicator-label">Login</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin.simpeg.js')
</body>

</html>

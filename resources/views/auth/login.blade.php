<!doctype html>

<html lang="en" class="layout-wide customizer-hide" dir="ltr" data-skin="default" data-bs-theme="light"
    data-assets-path="{{ asset('server/assets/') }}" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="robots" content="noindex, nofollow" />
    <title>{{ $settings->title }} - Login</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="https://storage.ntbprov.go.id/bpkad/uploads/defaults/logo_bpkad.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('server/assets/vendor/fonts/iconify-icons.css') }}" />

    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css -->

    <link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/node-waves/node-waves.css') }}" />

    <link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/pickr/pickr-themes.css') }}" />

    <link rel="stylesheet" href="{{ asset('server/assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('server/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->

    <link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- endbuild -->

    <!-- Vendor -->
    <link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/@form-validation/form-validation.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('server/assets/vendor/css/pages/page-auth.css') }}" />
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
</head>

<body>
    <!-- Content -->

    <div class="position-relative">
        <div class="authentication-wrapper authentication-basic container-p-y p-4 p-sm-0">
            <div class="authentication-inner py-6">
                <!-- Login -->
                <div class="card p-md-7 p-1">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mt-5">
                        <a href="index.html" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <img src="https://storage.ntbprov.go.id/bpkad/uploads/defaults/ntb.png"
                                    alt="{{ $settings->title }}"
                                    style="max-width:120px; height:40px; object-fit:contain;">
                            </span>
                            <span class="app-brand-text demo text-heading fw-semibold">
                                <img src="{{ $settings->logo_image }}" alt="{{ $settings->title }}">
                            </span>
                        </a>
                    </div>
                    <!-- /Logo -->

                    <div class="card-body mt-1">
                        @if (Session::has('failed'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('failed') }}
                            </div>
                        @endif
                        <form class="mb-5" action="{{ route('login.store') }}" method="POST">
                            @csrf
                            <div class="form-floating form-floating-outline mb-5 form-control-validation">
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    name="email" placeholder="Enter your email or username"
                                    value="{{ old('email') }}" autofocus />
                                <label for="email">Email atau Username</label>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <div class="form-password-toggle form-control-validation">
                                    <div class="input-group input-group-merge">
                                        <div class="form-floating form-floating-outline">
                                            <input type="password" id="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="password" />
                                            <label for="password">Password</label>
                                        </div>
                                        <span class="input-group-text cursor-pointer toggle-password">
                                            <i class="icon-base ri ri-eye-off-line icon-20px"></i>
                                        </span>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-5 d-flex justify-content-between mt-5">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" id="remember-me"
                                        name="remember_me" />
                                    <label class="form-check-label" for="remember-me"> Ingat saya </label>
                                </div>
                                {{-- <a href="auth-forgot-password-basic.html" class="float-end mb-1 mt-2">
                                    <span>Forgot Password?</span>
                                </a> --}}
                            </div>
                            <div class="mb-5">
                                <button class="btn btn-primary d-grid w-100" type="submit">Masuk</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /Login -->
                <img alt="mask"
                    src="{{ asset('assets/media/auth/bg4.jpg') }}"
                    class="authentication-image d-none d-lg-block"
                    data-app-light-img="{{ asset('assets/media/auth/bg4.jpg') }}"
                    data-app-dark-img="{{ asset('assets/media/auth/bg4-dark.jpg') }}" />
            </div>
        </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->

    <!-- build:js assets/vendor/js/theme.js  -->

    <script src="{{ asset('server/assets/vendor/libs/jquery/jquery.js') }}"></script>

    <script src="{{ asset('server/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('server/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('server/assets/vendor/libs/node-waves/node-waves.js') }}"></script>

    <script src="{{ asset('server/assets/vendor/libs/@algolia/autocomplete-js.js') }}"></script>

    <script src="{{ asset('server/assets/vendor/libs/pickr/pickr.js') }}"></script>

    <script src="{{ asset('server/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('server/assets/vendor/libs/hammer/hammer.js') }}"></script>

    <script src="{{ asset('server/assets/vendor/libs/i18n/i18n.js') }}"></script>

    <script src="{{ asset('server/assets/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('server/assets/vendor/libs/@form-validation/popular.js') }}"></script>
    <script src="{{ asset('server/assets/vendor/libs/@form-validation/bootstrap5.js') }}"></script>
    <script src="{{ asset('server/assets/vendor/libs/@form-validation/auto-focus.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('server/assets/js/pages-auth.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const togglePassword = document.querySelector('.toggle-password');
            const passwordInput = document.getElementById('password');
            const icon = togglePassword.querySelector('i');

            togglePassword.addEventListener('click', function() {
                const isPassword = passwordInput.type === 'password';

                passwordInput.type = isPassword ? 'text' : 'password';

                // Ganti icon
                icon.classList.toggle('ri-eye-line', isPassword);
                icon.classList.toggle('ri-eye-off-line', !isPassword);
            });
        });
    </script>

</body>

</html>

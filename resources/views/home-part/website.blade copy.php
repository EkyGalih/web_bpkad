@section('content_home')
<section id="landingHero" class="section-py landing-hero position-lg-relative">
    <img src="{{ asset('server/assets/img/front-pages/backgrounds/hero-bg-light.png') }}" alt="hero background"
        class="position-absolute top-0 start-0 w-100 h-100 z-n1" data-speed="1"
        data-app-light-img="{{ asset('server/assets/img/front-pages/backgrounds/hero-bg-light.png') }}"
        data-app-dark-img="{{ asset('server/assets/img/front-pages/backgrounds/hero-bg-dark.png') }}" />
    <div class="container">
        <div class="hero-text-box text-center">
            <h2 class="text-primary hero-title mb-4">Daftar Aplikasi</h2>
        </div>
        <div class="row gy-lg-5 gy-12 mt-2">
            <div class="col-lg-3 col-sm-6">
                <div class="card card-hover-border-primary mt-4 mt-lg-0 shadow-none">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-5">Website BPKAD</h5>
                        @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                        <a href="{{ ENV('WEB_BPKAD_ADMIN') }}" class="btn btn-primary btn-block btn-sm mb-3">
                            <i class="icon-base ri ri-login-box-line"></i> Ke Aplikasi
                        </a>
                        @elseif (Auth::user()->role == 'operator')
                        <a href="{{ ENV('WEB_BPKAD_OPERATOR') }}" class="btn btn-primary btn-block btn-sm mb-3">
                            <i class="icon-base ri ri-login-box-line"></i> Ke Aplikasi
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card card-hover-border-danger mt-4 mt-lg-0 shadow-none">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-5">SimPeg</h5>
                        @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                        <a class="btn btn-primary btn-block btn-sm mb-3" href="{{ ENV('SIMPEG_ADMIN') }}">
                            <i class="icon-base ri ri-login-box-line"></i> Ke Aplikasi
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card card-hover-border-success mt-4 mt-lg-0 shadow-none">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-5">LKPD</h5>
                        @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                        <a class="btn btn-primary btn-block btn-sm mb-3" href="{{ ENV('APBD_ADMIN') }}">
                            <i class="icon-base ri ri-login-box-line"></i> Ke Aplikasi
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card card-hover-border-info mt-4 mt-lg-0 shadow-none">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-5">ASET TIK</h5>
                        @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                        <a class="btn btn-primary btn-block btn-sm mb-3" href="{{ env('WEB_BPKAD_ADMIN') }}">
                            <i class="icon-base ri ri-time-line"></i> Ongoing
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
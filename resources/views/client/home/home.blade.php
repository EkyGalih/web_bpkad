@extends('client.index')
@section('menu-home', 'active')
@section('additional-css')
    <!-- Basic stylesheet -->
    <link rel="stylesheet" href="{{ asset('client/plugins/owl-carousel/owl.carousel.css') }}">

    <!-- Default Theme -->
    <link rel="stylesheet" href="{{ asset('client/plugins/owl-carousel/owl.theme.css') }}">
    <style>
        #owl-video .item {
            margin: 3px;
        }

        #owl-video .item img {
            display: block;
            width: 100%;
            height: auto;
        }

        @media screen and (max-width: 50px) {
            .list-group {
                width: 50%;
            }
        }
    </style>
@endsection
@section('content_home')
    <section class="wrapper image-wrapper bg-image bg-overlay bg-overlay-300"
        data-image-src="{{ asset($settings->header_image) }}">
        {{-- client/assets/img/photos/bg3.jpg --}}
        <div class="container pt-17 pb-19 pt-md-18 pb-md-17 text-center">
            <div class="row">
                <div class="col-lg-8 col-xl-7 col-xxl-6 mx-auto" data-cues="slideInDown" data-group="page-title">
                    <h1 class="display-1 text-white fs-60 mb-4 px-md-15 px-lg-0">{{ $settings->subtitle }} <span
                            class="underline-3 style-2 blue">{{ $settings->title }}</span></h1>
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
        <div class="overflow-hidden">
            <div class="divider text-light mx-n2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 60">
                    <path fill="currentColor" d="M0,0V60H1440V0A5771,5771,0,0,1,0,0Z" />
                </svg>
            </div>
        </div>
    </section>
    <section class="wrapper bg-light-dark">
        <div class="container pb-15 pb-md-17">
            <div class="row gx-md-5 gy-5 mt-n19 mb-14 mb-md-17">
                <div class="col-md-6 col-xl-3">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <img src="{{ asset('client/assets/img/icons/solid/clipboard.svg') }}"
                                class="svg-inject icon-svg icon-svg-sm solid-mono text-fuchsia mb-3" alt="" />
                            <h4>Informasi Berkala</h4>
                            <p class="mb-2">Informasi yang diperbarui secara reguler atau periodik.</p>
                            <a href="{{ route('ppid-kip', strtolower(App\Enum\KlasifikasiEnum::BERKALA->name)) }}" class="more hover link-fuchsia">Lihat Daftar</a>
                        </div>
                        <!--/.card-body -->
                    </div>
                    <!--/.card -->
                </div>
                <!--/column -->
                <div class="col-md-6 col-xl-3">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <img src="{{ asset('client/assets/img/icons/solid/clipboard.svg') }}"
                                class="svg-inject icon-svg icon-svg-sm solid-mono text-violet mb-3" alt="" />
                            <h4>Informasi Serta Merta</h4>
                            <p class="mb-2">Informasi yang diperbarui atau disajikan secara instan.</p>
                            <a href="{{ route('ppid-kip', strtolower(App\Enum\KlasifikasiEnum::SERTA_MERTA->name)) }}" class="more hover link-violet">Lihat Daftar</a>
                        </div>
                        <!--/.card-body -->
                    </div>
                    <!--/.card -->
                </div>
                <!--/column -->
                <div class="col-md-6 col-xl-3">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <img src="{{ asset('client/assets/img/icons/solid/clipboard.svg') }}"
                                class="svg-inject icon-svg icon-svg-sm solid-mono text-orange mb-3" alt="" />
                            <h4>Informasi Setiap Saat</h4>
                            <p class="mb-2">Informasi yang diperbarui atau disajikan setiap saat.</p>
                            <a href="{{ route('ppid-kip', strtolower(App\Enum\KlasifikasiEnum::SETIAP_SAAT->name)) }}" class="more hover link-orange">Lihat Daftar</a>
                        </div>
                        <!--/.card-body -->
                    </div>
                    <!--/.card -->
                </div>
                <!--/column -->
                <div class="col-md-6 col-xl-3">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <img src="{{ asset('client/assets/img/icons/solid/clipboard.svg') }}"
                                class="svg-inject icon-svg icon-svg-sm solid-mono text-green mb-3" alt="" />
                            <h4>Informasi Dikecualikan</h4>
                            <p class="mb-2">Informasi yang dikecualikan untuk disediakan ke publik.</p>
                            <a href="{{ route('ppid-kip', strtolower(App\Enum\KlasifikasiEnum::DIKECUALIKAN->name)) }}" class="more hover link-green">Lihat Daftar</a>
                        </div>
                        <!--/.card-body -->
                    </div>
                    <!--/.card -->
                </div>
                <!--/column -->
            </div>
            <!--/.row -->
            <div class="row">
                <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2 mx-auto text-center">
                    <h3 class="display-3 mb-10 px-xl-10 px-xxl-15"><span class="underline-3 style-2 blue">Berita</span></h3>
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
            <ul
                class="nav nav-tabs nav-tabs-bg nav-tabs-shadow-lg d-flex justify-content-between nav-justified flex-lg-row flex-column">
                <li class="nav-item"> <a class="nav-link d-flex flex-row active" data-bs-toggle="tab" href="#tab2-1">
                        <div><img src="{{ asset('client/assets/img/icons/lineal/paper.svg') }}"
                                class="svg-inject icon-svg icon-svg-sm solid-mono text-fuchsia me-4" alt="" /></div>
                        <div>
                            <h4>Berita Terkini</h4>
                            <p>Berita seputar kegiatan BPKAD NTB.</p>
                        </div>
                    </a> </li>
                <li class="nav-item"> <a class="nav-link d-flex flex-row" data-bs-toggle="tab" href="#tab2-2">
                        <div><img src="{{ asset('client/assets/img/icons/lineal/user.svg') }}"
                                class="svg-inject icon-svg icon-svg-sm solid-mono text-violet me-4" alt="" /></div>
                        <div>
                            <h4>Agenda Pimpinan</h4>
                            <p>Berita agenda pimpinan BPKAD NTB.</p>
                        </div>
                    </a> </li>
                <li class="nav-item"> <a class="nav-link d-flex flex-row" data-bs-toggle="tab" href="#tab2-3">
                        <div><img src="{{ asset('client/assets/img/icons/lineal/list.svg') }}"
                                class="svg-inject icon-svg icon-svg-sm solid-mono text-green me-4" alt="" /></div>
                        <div>
                            <h4>Berita NTB</h4>
                            <p>Berita seputar Nusa Tenggara Barat.</p>
                        </div>
                    </a> </li>
            </ul>
            <!-- /.nav-tabs -->
            <div class="tab-content mt-6 mt-lg-8">
                <div class="tab-pane fade show active" id="tab2-1">
                    <div class="projects-tiles">
                        <div class="project grid grid-view">
                            <div class="row gx-md-8 gx-xl-12 gy-10 gy-md-12 isotope">
                                <div class="item col-md-6 mt-md-7 mt-lg-15">
                                    <div
                                        class="project-details d-flex justify-content-center align-self-end flex-column ps-0 pb-0">
                                        <div class="post-header">
                                            <h2 class="display-4 mb-4 pe-xxl-15">Berita Terkini.</h2>
                                            <a href="{{ route('post.index') }}" class="lead fs-lg mb-0">Lihat Semua Berita
                                                Terkini</a>
                                        </div>
                                        <!-- /.post-header -->
                                    </div>
                                    <!-- /.project-details -->
                                </div>
                                <!-- /.item -->
                                @foreach ($new_posts as $post)
                                    <div class="item col-md-6">
                                        <figure class="lift rounded mb-6"><a
                                                href="{{ route('post.show', [PostCategory($post->posts_category_id), $post->slug]) }}">
                                                <img src="{{ asset($post->foto_berita) }}"
                                                    srcset="{{ asset($post->foto_berita) }}"
                                                    alt="{{ substr($post->title, 0, 50) }}" /></a></figure>
                                        <div class="post-category text-line mb-2 text-violet">
                                            {{ PostCategory($post->posts_category_id) }}</div>
                                        <h2 class="post-title h3">{{ substr($post->title, 0, 50) }}...</h2>
                                    </div>
                                @endforeach
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.project -->
                    </div>
                    <!--/.row -->
                </div>
                <!--/.tab-pane -->
                <div class="tab-pane fade" id="tab2-2">
                    <div class="row">
                        <div class="col-lg-10 col-xl-9 col-xxl-8 mx-auto text-center">
                            <h3 class="display-3 mb-10"><span class="underline-3 style-2 yellow">Agenda Pimpinan</span>
                            </h3>
                            <h2 class="fs-16 text-uppercase text-muted mb-3"><a href="#">Lihat Semua</a></h2>
                        </div>
                        <!-- /column -->
                    </div>
                    <!-- /.row -->
                    <div class="swiper-container grid-view" data-margin="30" data-dots="true" data-items-xl="3"
                        data-items-md="2" data-items-xs="1">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                @foreach ($agendas as $agenda)
                                    <div class="swiper-slide">
                                        <figure class="rounded mb-6"><img src="{{ $agenda->foto_berita }}"
                                                srcset="{{ $agenda->foto_berita }}" alt="{{ $agenda->title }}"
                                                style="max-width: 500px; max-height: 700px;" /><a class="item-link"
                                                href="{{ $agenda->foto_berita }}" data-glightbox
                                                data-gallery="projects-group"><i class="uil uil-focus-add"></i></a>
                                        </figure>
                                        <div class="project-details d-flex justify-content-center flex-column">
                                            <div class="post-header">
                                                <h2 class="post-title h3"><a
                                                        href="{{ route('post.show', [PostCategory($agenda->posts_category_id), $agenda->slug]) }}"
                                                        class="link-dark">{{ $agenda->title }}</a></h2>
                                                <div class="post-category text-ash">
                                                    {{ PostCategory($agenda->posts_category_id) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!--/.tab-pane -->
                <div class="tab-pane fade" id="tab2-3">
                    <div class="row gx-lg-8 gx-xl-12 gy-10 align-items-center">
                        <div class="row mb-5">
                            <div class="col-md-10 col-xl-8 col-xxl-7 mx-auto text-center">
                                <img src="{{ asset('client/assets/img/icons/lineal/list.svg') }}"
                                    class="svg-inject icon-svg icon-svg-md mb-4" alt="" />
                                <h2 class="display-4 mb-4 px-lg-14">Berita NTB</h2>
                            </div>
                            <!-- /column -->
                        </div>
                        <div class="position-relative">
                            <div class="shape bg-dot primary rellax w-17 h-20" data-rellax-speed="1"
                                style="top: 0; left: -1.7rem;"></div>
                            <div class="swiper-container dots-closer blog grid-view mb-6" data-margin="0"
                                data-dots="true" data-items-xl="3" data-items-md="2" data-items-xs="1">
                                <div class="swiper">
                                    <div class="swiper-wrapper">
                                        @foreach (array_slice($data, 0, 6) as $item)
                                            <div class="swiper-slide">
                                                <div class="item-inner">
                                                    <article>
                                                        <div class="card">
                                                            <figure class="card-img-top overlay overlay-1 hover-scale"><a
                                                                    href="https://ntbprov.go.id/post/{{ $item->seotitle }}">
                                                                    <img src="{{ $item->thumbnail }}"
                                                                        alt="{{ $item->desc == null ? $item->seotitle : $item->desc->title }}" /></a>
                                                                <figcaption>
                                                                    <h5 class="from-top mb-0">Read More</h5>
                                                                </figcaption>
                                                            </figure>
                                                            <div class="card-body">
                                                                <div class="post-header">
                                                                    <h2 class="post-title h3 mt-1 mb-3"><a
                                                                            class="link-dark"
                                                                            href="https://ntbprov.go.id/post/{{ $item->seotitle }}">
                                                                            {{ $item->desc->title }}</a></h2>
                                                                </div>
                                                                <!-- /.post-header -->
                                                                <div class="post-content">
                                                                    <p>{!! $item->desc == null ? $item->picture_description : substr($item->desc->content, 0, 100) . '...' !!}</p>
                                                                </div>
                                                                <!-- /.post-content -->
                                                            </div>
                                                            <!--/.card-body -->
                                                            <div class="card-footer">
                                                                <ul class="post-meta d-flex mb-0">
                                                                    <li class="post-date"><i
                                                                            class="uil uil-calendar-alt"></i><span>{{ \Carbon\Carbon::parse($item->publishdate)->locale('id')->translatedFormat('l,
                                                                                                                                                d F Y') }}</span>
                                                                    </li>
                                                                    <li class="post-comments"><a href="#"><i
                                                                                class="uil uil-file-alt fs-15"></i>{{ $item->author->name }}</a>
                                                                    </li>
                                                                </ul>
                                                                <!-- /.post-meta -->
                                                            </div>
                                                            <!-- /.card-footer -->
                                                        </div>
                                                        <!-- /.card -->
                                                    </article>
                                                    <!-- /article -->
                                                </div>
                                                <!-- /.item-inner -->
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="wrapper bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2 mt-5 mx-auto text-center">
                    <h3 class="display-3 mb-10 px-xl-10 px-xxl-15"><span class="underline-3 style-2 blue">Struktur
                            PPID</span></h3>
                </div>
                <!-- /column -->
            </div>
            @php
                $atasan = getPejabatPPID('atasan');
                $ketua = getPejabatPPID('ketua');

                $kepala_pengelola = getPejabatPPID('kepala_pengelola');
                $kepala_pengaduan = getPejabatPPID('kepala_pengaduan');
                $kepala_pelayanan = getPejabatPPID('kepala_pelayanan');
            @endphp
            <div class="card bg-soft-primary rounded-4 mb-14 mb-md-18">
                <div class="card-body p-md-10 mt-8 py-xxl-16 position-relative">
                    <div class="position-absolute d-none d-lg-block" style="bottom:30%; left:10%; width: 28%; z-index:2">
                        <figure class="card-img-top overflow-hidden" style="width: 300px; height: 300px; margin: auto;">
                            <img class="w-100 h-100 object-fit-cover"
                                src="{{ asset($atasan->foto ?? ($atasan->jenis_kelamin == 'pria' ? 'static/images/male.jpg' : 'static/images/female.jpg')) }}"
                                alt="{{ $atasan->name }}" />
                        </figure>
                    </div>
                    <div class="row gx-md-0 gx-xl-12 text-center">
                        <div class="col-lg-7 offset-lg-5 col-xl-6">
                            <blockquote class="border-0 fs-lg mb-0">
                                <p>“Keterbukaan informasi publik merupakan wujud nyata dari tata kelola pemerintahan yang
                                    transparan, partisipatif, dan akuntabel. Kami berkomitmen untuk memberikan akses
                                    informasi yang cepat, tepat, dan mudah bagi seluruh masyarakat”</p>
                                <div class="blockquote-details justify-content-center text-center">
                                    <div class="info p-0">
                                        <h5 class="mb-1">{{ $atasan->name }}</h5>
                                        <div class="meta mb-0">{{ strtoupper($atasan->nama_jabatan) }}</div>
                                    </div>
                                </div>
                            </blockquote>
                        </div>
                        <!-- /column -->
                    </div>
                    <!-- /.row -->
                </div>
                <!--/.card-body -->
            </div>
            <!--/.card -->
            <div class="row gx-lg-8 gx-xl-12 gy-10 gy-lg-0 mb-11">
                <!-- /column -->
                <div class="col-lg-12 mt-lg-2">
                    <div class="row align-items-center counter-wrapper gy-6 text-center">
                        <div class="col-md-3">
                            <img src="{{ asset('client/assets/img/icons/lineal/user.svg') }}"
                                class="svg-inject icon-svg icon-svg-md text-primary mb-3" alt="" />
                            <h3 class="counter">{{ get_pegawais('IV', 'golongan') }}</h3>
                            <p>Pegawai Eselon</p>
                        </div>
                        <!--/column -->
                        <div class="col-md-3">
                            <img src="{{ asset('client/assets/img/icons/lineal/user.svg') }}"
                                class="svg-inject icon-svg icon-svg-md text-primary mb-3" alt="" />
                            <h3 class="counter">{{ get_pegawais('III', 'golongan') }}</h3>
                            <p>Pegawai Golongan III</p>
                        </div>
                        <!--/column -->
                        <div class="col-md-3">
                            <img src="{{ asset('client/assets/img/icons/lineal/user.svg') }}"
                                class="svg-inject icon-svg icon-svg-md text-primary mb-3" alt="" />
                            <h3 class="counter">{{ get_pegawais('II', 'golongan') }}</h3>
                            <p>Pegawai Golongan II</p>
                        </div>
                        <div class="col-md-3">
                            <img src="{{ asset('client/assets/img/icons/lineal/user.svg') }}"
                                class="svg-inject icon-svg icon-svg-md text-primary mb-3" alt="" />
                            <h3 class="counter">{{ get_pegawais('I', 'golongan') }}</h3>
                            <p>Pegawai Golongan I</p>
                        </div>
                        <!--/column -->
                    </div>
                    <!--/.row -->
                </div>
                <!-- /column -->
            </div>
            <div class="row grid-view gx-md-8 gx-xl-10 gy-8 gy-lg-0 mb-16 mb-md-19">
                <div class="col-md-6 col-lg-3 mt-5">
                    <div class="position-relative">
                        <div class="shape rounded bg-soft-primary rellax d-md-block" data-rellax-speed="0"
                            style="bottom: -0.75rem; right: -0.75rem; width: 98%; height: 98%; z-index:0"></div>
                        <div class="card shadow-lg">
                            <figure class="card-img-top overflow-hidden" style="width: auto; height: auto; margin: auto;">
                                <img class="w-100 h-100 object-fit-cover"
                                    src="{{ asset($ketua->foto ?? ($ketua->jenis_kelamin == 'pria' ? 'static/images/male.jpg' : 'static/images/female.jpg')) }}"
                                    alt="{{ $ketua->name }}" />
                            </figure>
                            <div class="card-body px-6 py-5">
                                <p class="mb-1 fw-bold">{{ $ketua->name }}</p>
                                <p class="mb-0 fs-12">{{ strtoupper($ketua->nama_jabatan) }}</p>
                            </div>
                            <!--/.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /div -->
                </div>
                <div class="col-md-6 col-lg-3 mt-5">
                    <div class="position-relative">
                        <div class="shape rounded bg-soft-primary rellax d-md-block" data-rellax-speed="0"
                            style="bottom: -0.75rem; right: -0.75rem; width: 98%; height: 98%; z-index:0"></div>
                        <div class="card shadow-lg">
                            <figure class="card-img-top overflow-hidden" style="width: auto; height: auto; margin: auto;">
                                <img class="w-100 h-100 object-fit-cover"
                                    src="{{ asset($kepala_pengelola->foto ?? ($kepala_pengelola->jenis_kelamin == 'pria' ? 'static/images/male.jpg' : 'static/images/female.jpg')) }}"
                                    alt="{{ $kepala_pengelola->name }}" />

                            </figure>
                            <div class="card-body px-6 py-5">
                                <p class="mb-1 fw-bold">{{ $kepala_pengelola->name }}</p>
                                <p class="mb-0 fs-12">{{ strtoupper($kepala_pengelola->nama_jabatan) }}</p>
                            </div>
                            <!--/.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /div -->
                </div>
                <div class="col-md-6 col-lg-3 mt-5">
                    <div class="position-relative">
                        <div class="shape rounded bg-soft-primary rellax d-md-block" data-rellax-speed="0"
                            style="bottom: -0.75rem; right: -0.75rem; width: 98%; height: 98%; z-index:0"></div>
                        <div class="card shadow-lg">
                            <figure class="card-img-top overflow-hidden" style="width: auto; height: auto; margin: auto;">
                                <img class="w-100 h-100 object-fit-cover"
                                    src="{{ asset($kepala_pengaduan->foto ?? ($kepala_pengaduan->jenis_kelamin == 'pria' ? 'static/images/male.jpg' : 'static/images/female.jpg')) }}"
                                    alt="{{ $kepala_pengaduan->name }}" />
                            </figure>
                            <div class="card-body px-6 py-5">
                                <p class="mb-1 fw-bold">{{ $kepala_pengaduan->name }}</p>
                                <p class="mb-0 fs-12">{{ strtoupper($kepala_pengaduan->nama_jabatan) }}</p>
                            </div>
                            <!--/.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /div -->
                </div>
                <div class="col-md-6 col-lg-3 mt-5">
                    <div class="position-relative">
                        <div class="shape rounded bg-soft-primary rellax d-md-block" data-rellax-speed="0"
                            style="bottom: -0.75rem; right: -0.75rem; width: 98%; height: 98%; z-index:0"></div>
                        <div class="card shadow-lg">
                            <figure class="card-img-top overflow-hidden" style="width: auto; height: auto; margin: auto;">
                                <img class="w-100 h-100 object-fit-cover"
                                    src="{{ asset($kepala_pelayanan->foto ?? ($kepala_pelayanan->jenis_kelamin == 'pria' ? 'static/images/male.jpg' : 'static/images/female.jpg')) }}"
                                    alt="{{ $kepala_pelayanan->name }}" />
                            </figure>
                            <div class="card-body px-6 py-5">
                                <p class="mb-1 fw-bold">{{ $kepala_pelayanan->name }}</p>
                                <p class="mb-0 fs-12">{{ strtoupper($kepala_pelayanan->nama_jabatan) }}</p>
                            </div>
                            <!--/.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /div -->
                </div>
            </div>
        </div>
    </section>
@endsection
@section('additional-js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var swiperAgenda = new Swiper('[data-items-xl="3"]:nth-of-type(1) .swiper', {
                slidesPerView: 3,
                spaceBetween: 30,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    992: {
                        slidesPerView: 3
                    },
                    768: {
                        slidesPerView: 2
                    },
                    0: {
                        slidesPerView: 1
                    }
                }
            });

            var swiperBeritaNTB = new Swiper('[data-items-xl="3"]:nth-of-type(2) .swiper', {
                slidesPerView: 3,
                spaceBetween: 30,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    992: {
                        slidesPerView: 3
                    },
                    768: {
                        slidesPerView: 2
                    },
                    0: {
                        slidesPerView: 1
                    }
                }
            });

            document.querySelectorAll('a[data-bs-toggle="tab"]').forEach(function(tab) {
                tab.addEventListener('shown.bs.tab', function(event) {
                    swiperAgenda.update();
                    swiperBeritaNTB.update();
                });
            });
        });
    </script>
@endsection

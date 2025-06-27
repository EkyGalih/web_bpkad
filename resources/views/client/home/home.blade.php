@extends('client.index')
@section('additional-css')
    <style>
        .marquee-fixed {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 1050;
            /* cukup tinggi agar tidak tertimpa */
            overflow: hidden;
        }

        .marquee-content {
            display: inline-block;
            white-space: nowrap;
            animation: scroll-left 55s linear infinite;
            padding-left: 100%;
        }

        .marquee-content:hover {
            animation-play-state: paused;
        }

        @keyframes scroll-left {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-100%);
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
    <section class="wrapper bg-light">
        <div class="container pb-15 pb-md-17">
            <div class="row gx-md-5 gy-5 mt-n12 mb-8 mb-md-12">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 mb-4 mb-xl-0">
                            <div class="card shadow-lg h-100">
                                <div class="card-body">
                                    <img src="{{ asset('client/assets/img/icons/solid/calendar.svg') }}"
                                        class="svg-inject icon-svg icon-svg-sm solid-mono text-fuchsia mb-3"
                                        alt="" />
                                    <h4>Events</h4>
                                    <a href="#" class="more hover link-fuchsia">Lihat</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow-lg h-100">
                                <div class="card-body">
                                    <img src="{{ asset('client/assets/img/icons/solid/images.svg') }}"
                                        class="svg-inject icon-svg icon-svg-sm solid-mono text-violet mb-3"
                                        alt="" />
                                    <h4>Galery</h4>
                                    <a href="{{ route('foto') }}" class="more hover link-primary">Lihat</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                                class="svg-inject icon-svg icon-svg-sm solid-mono text-info me-4" alt="" /></div>
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
                                            <h3 class="display-3 mb-2"><span class="underline-3 style-2 blue">Berita</span>
                                            </h3>
                                            <h2 class="fs-16 text-uppercase text-muted mb-3"><a
                                                    href="{{ route('post.index') }}">Lihat Semua</a></h2>
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
                                        <div class="post-category text-line mb-2 text-info">
                                            {{ PostCategory($post->posts_category_id) }}</div>
                                        @if (strlen($post->title) <= 100)
                                            <h2 class="post-title h3">
                                                <a class="text-decoration-none text-dark"
                                                    href="{{ route('post.show', [PostCategory($post->posts_category_id), $post->slug]) }}">{{ $post->title }}</a>
                                            </h2>
                                        @else
                                            <h2 class="post-title h3"><a class="text-decoration-none text-dark"
                                                    href="{{ route('post.show', [PostCategory($post->posts_category_id), $post->slug]) }}">
                                                    {{ substr($post->title, 0, 100) . '...' }}
                                                </a>
                                            </h2>
                                        @endif
                                        <span
                                            class="fw-semibold">{{ \Carbon\Carbon::parse($post->created_at)->locale('id')->translatedFormat('l, d F Y') }}
                                            - <span class="badge bg-primary">{{ $post->users->nama }}</span></span>
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
                            <h2 class="fs-16 text-uppercase text-muted mb-3"><a href="{{ route('ppid.agenda') }}">Lihat
                                    Semua</a></h2>
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
                                                <h2 class="post-title h3">
                                                    <a href="{{ route('post.show', [PostCategory($agenda->posts_category_id), $agenda->slug]) }}"
                                                        class="link-dark">{{ \Illuminate\Support\Str::limit($agenda->title, 60) }}</a>
                                                </h2>
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
                        <div class="row">
                            <div class="col-lg-10 col-xl-9 col-xxl-8 mx-auto text-center">
                                <h3 class="display-3 mb-10"><span class="underline-3 style-2 primary">Berita NTB</span>
                                </h3>
                                <h2 class="fs-16 text-uppercase text-muted mb-3"><a href="https://ntbprov.go.id">Lihat
                                        Semua</a></h2>
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
                                                            <figure class="card-img-top overlay overlay-1 hover-scale"
                                                                style="height: 250px; overflow: hidden;">
                                                                <a
                                                                    href="https://ntbprov.go.id/post/{{ $item->seotitle }}">
                                                                    <img src="{{ $item->thumbnail }}"
                                                                        alt="{{ $item->desc == null ? $item->seotitle : $item->desc->title }}"
                                                                        style="height: 100%; width: 100%; object-fit: cover;" />
                                                                </a>
                                                                <figcaption>
                                                                    <h5 class="from-top mb-0">Read More</h5>
                                                                </figcaption>
                                                            </figure>
                                                            <div class="card-body">
                                                                <div class="post-header">
                                                                    <h2 class="post-title h3 mt-1 mb-3">
                                                                        <a class="link-dark"
                                                                            href="https://ntbprov.go.id/post/{{ $item->seotitle }}">
                                                                            {{ \Illuminate\Support\Str::limit($item->desc->title, 60) }}
                                                                        </a>
                                                                    </h2>
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
                                                                    <li class="post-date">
                                                                        <i class="uil uil-calendar-alt"></i>
                                                                        <span>{{ \Carbon\Carbon::parse($item->publishdate)->locale('id')->translatedFormat('l, d F Y') }}</span>
                                                                    </li>
                                                                    <li class="post-comments">
                                                                        <a href="#"><i
                                                                                class="uil uil-file-alt fs-15"></i>{{ $item->author->name }}</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </article>
                                                </div>
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
    <section class="wrapper bg-gray">
        <div class="container pb-10 pb-md-10">
            <div class="row gx-md-4 gy-5 mt-5 mb-md-5">
                <div class="col-md-6 col-xl-3">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <img src="{{ asset('client/assets/img/icons/solid/clipboard.svg') }}"
                                class="svg-inject icon-svg icon-svg-sm solid-mono text-fuchsia mb-3" alt="" />
                            <h4>Informasi Berkala</h4>
                            <p class="mb-2">Informasi yang diperbarui secara reguler atau periodik.</p>
                            <a href="{{ route('ppid-kip', strtolower(App\Enum\KlasifikasiEnum::BERKALA->name)) }}"
                                class="more hover link-fuchsia">Lihat Daftar</a>
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
                            <a href="{{ route('ppid-kip', strtolower(App\Enum\KlasifikasiEnum::SERTA_MERTA->name)) }}"
                                class="more hover link-violet">Lihat Daftar</a>
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
                            <a href="{{ route('ppid-kip', strtolower(App\Enum\KlasifikasiEnum::SETIAP_SAAT->name)) }}"
                                class="more hover link-orange">Lihat Daftar</a>
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
                            <a href="{{ route('ppid-kip', strtolower(App\Enum\KlasifikasiEnum::DIKECUALIKAN->name)) }}"
                                class="more hover link-green">Lihat Daftar</a>
                        </div>
                        <!--/.card-body -->
                    </div>
                    <!--/.card -->
                </div>
                <!--/column -->
            </div>
        </div>
    </section>
    <section class="wrapper bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2 mt-5 mx-auto text-center">
                    <h3 class="display-3 mb-10 px-xl-10 px-xxl-15"><span class="underline-3 style-2 blue">Struktur
                            Organisasi BPKAD</span></h3>
                </div>
                <!-- /column -->
            </div>
            @php
                $kaban = get_pimpinan('select', strtolower(App\Enum\JabatanEnum::KABAN->name));
                $sekban = get_pimpinan('select', strtolower(App\Enum\JabatanEnum::SEKBAN->name));
                $kabag = getKabag(
                    'select',
                    strtolower(App\Enum\JabatanEnum::KABID->name),
                    strtolower(App\Enum\JabatanEnum::KEPALA->name),
                );
                $kasubag = getKasubag('select', strtolower(App\Enum\JabatanEnum::KASUBID->name), 'Kepala Sub Bidang');
            @endphp
            <div class="card bg-gray rounded-4 mb-5 mb-md-18">
                <div class="container pt-16 pb-14 pb-md-0">
                    <div class="row gx-lg-8 gx-xl-0 align-items-center">
                        <div
                            class="col-md-5 col-lg-5 col-xl-4 offset-xl-1 d-none d-md-flex position-relative align-self-end">
                            <div class="shape rounded-circle bg-pale-primary rellax w-21 h-21 d-md-none d-lg-block"
                                data-rellax-speed="1" style="top: 7rem; left: 1rem"></div>
                            <figure><img src="{{ asset($kaban->foto) }}" srcset="{{ asset($kaban->foto) }}"
                                    alt="{{ $kaban->name }}">
                            </figure>
                        </div>
                        <div class="col-md-7 col-lg-6 col-xl-6 col-xxl-5 offset-xl-1">
                            <div class="swiper-container dots-start dots-closer mt-md-10 mb-md-15" data-margin="30"
                                data-dots="true">
                                <div class="swiper">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="blockquote-details">
                                                <div class="info ps-0">
                                                    <h5 class="mb-1">{{ $kaban->name }}</h5>
                                                    <p class="mb-0">{{ strtoupper($kaban->initial_jabatan) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
            <div class="row grid-view gx-md-8 gx-xl-10 gy-8 gy-lg-0">
                <div class="container py-14 py-md-16">
                    <div class="row mb-3">
                        <div class="col-md-10 col-xl-9 col-xxl-7 mx-auto text-center">
                            <img src="{{ asset('client/assets/img/icons/lineal/team.svg') }}"
                                class="svg-inject icon-svg icon-svg-md mb-4" alt="" />
                            <h2 class="display-4 mb-3 px-lg-14">Jajaran Pimpinan & Pejabat BPKAD NTB</h2>
                        </div>
                    </div>
                    <div class="position-relative">
                        <div class="shape rounded-circle bg-soft-yellow rellax w-16 h-16" data-rellax-speed="1"
                            style="bottom: 0.5rem; right: -1.7rem;"></div>
                        <div class="shape rounded-circle bg-line red rellax w-16 h-16" data-rellax-speed="1"
                            style="top: 0.5rem; left: -1.7rem;"></div>
                        <div class="swiper-container dots-closer mb-6" data-margin="0" data-dots="true"
                            data-items-xxl="4" data-items-lg="3" data-items-md="2" data-items-xs="1">
                            <div class="swiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="item-inner">
                                            <div class="card">
                                                <div class="card-body">
                                                    <img class="img-thumbnail w-35 mb-4" src="{{ asset($sekban->foto) }}"
                                                        srcset="{{ asset($sekban->foto) }}" alt="{{ $sekban->name }}" />
                                                    <p class="fw-bold text-black fs-16 mb-1">{{ $sekban->name }}</p>
                                                    <div class="meta fs-14 mb-2">{{ $sekban->nama_jabatan }}</div>
                                                    <p class="fs-14 mb-2">{{ $sekban->initial_jabatan }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach ($kabag as $item)
                                        <div class="swiper-slide">
                                            <div class="item-inner">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <img class="img-thumbnail w-35 mb-4"
                                                            src="{{ asset($item->foto) }}"
                                                            srcset="{{ asset($item->foto) }}"
                                                            alt="{{ $item->name }}" />
                                                        <p class="fw-bold text-black fs-16 mb-1">{{ $item->name }}</p>
                                                        <div class="meta fs-14 mb-2">{{ $item->nama_jabatan }}</div>
                                                        <p class="fs-14 mb-2">{{ $item->jabatan }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    @foreach ($kasubag as $item)
                                        <div class="swiper-slide">
                                            <div class="item-inner">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <img class="img-thumbnail w-35 mb-4"
                                                            src="{{ asset($item->foto) }}"
                                                            srcset="{{ asset($item->foto) }}"
                                                            alt="{{ $item->name }}" />
                                                        <p class="fw-bold text-black fs-16 mb-1">{{ $item->name }}</p>
                                                        <div class="meta fs-14 mb-2">{{ $item->nama_jabatan }}</div>
                                                        <p class="fs-14 mb-2">{{ $item->jabatan }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="wrapper bg-gray">
        <div class="container py-5 pb-md-5">
            <div class="card image-wrapper bg-full bg-image bg-overlay bg-overlay-300 mb-4"
                data-image-src="{{ asset('client/assets/img/photo/bg18.png') }}"
                style="background-image: url('{{ asset('client/assets/img/photo/bg18.png') }}');">
                <div class="card-body p-10 p-xl-12">
                    <div class="row text-center">
                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center">
                            <div class="mb-4 mb-md-0 me-md-5">
                                <img class="img-thumbnail" style="width: 220px; height: 220px; object-fit: contain;"
                                    src="{{ $settings->simaskot_qrcode_image }}" alt="{{ $settings->simaskot_link }}">
                            </div>
                            <div class="col-xl-11 col-xxl-9 mx-auto">
                                <h3 class="display-3 mb-8 px-lg-8 text-white">Scan Qrcode atau klik <span
                                        class="underline-3 style-2 yellow">simaskot</span> untuk mengisi Survei Kepuasan
                                    Masyarakat</h3>
                            </div>
                        </div>
                        <!-- /column -->
                    </div>
                    <!-- /.row -->
                    <div class="d-flex justify-content-center">
                        <span><a href="{{ $settings->simaskot_link }}"
                                class="btn btn-outline-warning rounded">SIMASKOT</a></span>
                    </div>
                </div>
                <!--/.card-body -->
            </div>
        </div>
    </section>
@endsection
@section('additional-js')
    More actions
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

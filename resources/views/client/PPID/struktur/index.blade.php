@extends('client.index')
@section('title', 'PPID | Struktur Organisasi PPID')
@section('content_home')
    @include('layouts.client._header', [
        'title' => 'PPID',
        'keterangan' => 'Struktur Organisasi PPID',
    ])
    @php
        $atasan = getPejabatPPID('atasan');
        $ketua = getPejabatPPID('ketua');

        $kepala_pengelola = getPejabatPPID('kepala_pengelola');
        $kepala_pengaduan = getPejabatPPID('kepala_pengaduan');
        $kepala_pelayanan = getPejabatPPID('kepala_pelayanan');
    @endphp
    <section class="wrapper bg-soft-primary">
        <div class="container pt-16 pb-14 pb-md-0">
            <div class="row gx-lg-8 gx-xl-0 align-items-center">
                <div class="col-md-5 col-lg-5 col-xl-4 offset-xl-1 d-none d-md-flex position-relative align-self-end">
                    <div class="shape rounded-circle bg-pale-primary rellax w-21 h-21 d-md-none d-lg-block"
                        data-rellax-speed="1" style="top: 7rem; left: 1rem"></div>
                    <figure><img src="{{ asset($atasan->foto) }}" srcset="{{ asset($atasan->foto) }}"
                            alt="{{ $atasan->name }}">
                    </figure>
                </div>
                <div class="col-md-7 col-lg-6 col-xl-6 col-xxl-5 offset-xl-1">
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
            </div>
        </div>
    </section>
    <section class="wrapper bg-light">
        <div class="container py-14 py-md-16">
            <div class="row mb-3">
                <div class="col-md-10 col-xl-9 col-xxl-7 mx-auto text-center">
                    <img src="{{ asset('client/assets/img/icons/lineal/team.svg') }}"
                        class="svg-inject icon-svg icon-svg-md mb-4" alt="" />
                    <h2 class="display-4 mb-3 px-lg-14">Jajaran Pengurus PPID BPKAD NTB</h2>
                </div>
            </div>
            <div class="position-relative">
                <div class="shape rounded-circle bg-soft-yellow rellax w-16 h-16" data-rellax-speed="1"
                    style="bottom: 0.5rem; right: -1.7rem;"></div>
                <div class="shape rounded-circle bg-line red rellax w-16 h-16" data-rellax-speed="1"
                    style="top: 0.5rem; left: -1.7rem;"></div>
                <div class="swiper-container dots-closer mb-6" data-margin="0" data-dots="true" data-items-xxl="4"
                    data-items-lg="3" data-items-md="2" data-items-xs="1">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="item-inner">
                                    <div class="card">
                                        <div class="card-body">
                                            <img class="img-thumbnail w-35 mb-4" src="{{ asset($ketua->foto) }}"
                                                srcset="{{ asset($ketua->foto) }}" alt="{{ $ketua->name }}" />
                                            <p class="fw-bold text-black fs-16 mb-1">{{ $ketua->name }}</p>
                                            <div class="meta fs-14 mb-2">{{ $ketua->jabatan }}</div>
                                            <p class="fs-14 mb-2">{{ $ketua->nama_jabatan }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="item-inner">
                                    <div class="card">
                                        <div class="card-body">
                                            <img class="img-thumbnail w-35 mb-4" src="{{ asset($kepala_pengelola->foto) }}"
                                                srcset="{{ asset($kepala_pengelola->foto) }}"
                                                alt="{{ $kepala_pengelola->name }}" />
                                            <p class="fw-bold text-black fs-16 mb-1">{{ $kepala_pengelola->name }}</p>
                                            <div class="meta fs-14 mb-2">KEPALA</div>
                                            <p class="fs-14 mb-2">{{ $kepala_pengelola->nama_jabatan }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="item-inner">
                                    <div class="card">
                                        <div class="card-body">
                                            <img class="img-thumbnail w-35 mb-4" src="{{ asset($kepala_pengaduan->foto) }}"
                                                srcset="{{ asset($kepala_pengaduan->foto) }}"
                                                alt="{{ $kepala_pengaduan->name }}" />
                                            <p class="fw-bold text-black fs-16 mb-1">{{ $kepala_pengaduan->name }}</p>
                                            <div class="meta fs-14 mb-2">KEPALA</div>
                                            <p class="fs-14 mb-2">{{ $kepala_pengaduan->nama_jabatan }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="item-inner">
                                    <div class="card">
                                        <div class="card-body">
                                            <img class="img-thumbnail w-35 mb-4" src="{{ asset($kepala_pelayanan->foto) }}"
                                                srcset="{{ asset($kepala_pelayanan->foto) }}"
                                                alt="{{ $kepala_pelayanan->name }}" />
                                            <p class="fw-bold text-black fs-16 mb-1">{{ $kepala_pelayanan->name }}</p>
                                            <div class="meta fs-14 mb-2">KEPALA</div>
                                            <p class="fs-14 mb-2">{{ $kepala_pelayanan->nama_jabatan }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

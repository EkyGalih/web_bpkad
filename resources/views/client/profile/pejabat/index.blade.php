@extends('client.index')
@section('title', 'Profile | Profile Pejabat')
@section('content_home')
<section class="wrapper image-wrapper bg-image bg-overlay text-white"
    data-image-src="{{  asset('client/assets/img/photos/bg3.jpg') }}">
    <div class="container pt-18 pb-15 pt-md-20 pb-md-19 text-center">
        <div class="row">
            <div class="col-md-10 col-xl-8 mx-auto">
                <div class="post-header">
                    <h1 class="display-1 mb-4 text-white">Data Pejabat BPKAD</h1>
                </div>
            </div>
        </div>
    </div>
</section>
@php
$kaban = get_pimpinan('select', 'kaban');
$sekban = get_pimpinan('select', 'sekban');
$kabag = getKabag('select', 'kabid', 'kepala');
@endphp
<section class="wrapper bg-soft-primary">
    <div class="container pt-16 pb-14 pb-md-0">
        <div class="row gx-lg-8 gx-xl-0 align-items-center">
            <div class="col-md-5 col-lg-5 col-xl-4 offset-xl-1 d-none d-md-flex position-relative align-self-end">
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
</section>
<section class="wrapper bg-light">
    <div class="container py-14 py-md-16">
        <div class="row mb-3">
            <div class="col-md-10 col-xl-9 col-xxl-7 mx-auto text-center">
                <img src="{{ asset('client/assets/img/icons/lineal/team.svg') }}"
                    class="svg-inject icon-svg icon-svg-md mb-4" alt="" />
                <h2 class="display-4 mb-3 px-lg-14">Jajaran Pimpinan BPKAD NTB</h2>
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
                                        <img class="img-thumbnail w-35 mb-4" src="{{ asset($item->foto) }}"
                                            srcset="{{ asset($item->foto) }}" alt="{{ $item->name }}" />
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
</section>
@endsection
@extends('layouts.admin.inventaris.app')
@section('title', 'Detail Aset TIK')
@section('aset-tik', 'active')
@section('header')
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Aset TIK
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="index.html" class="text-muted text-hover-primary">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Inventaris</li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Aset TIK</li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Detail Aset</li>
            </ul>
        </div>
    </div>
@endsection
@section('content')
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="d-flex align-items-center justify-content-end mb-5">
            <a href="{{ route('inventaris.aset.index') }}" class="btn btn-light-secondary">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>
        </div>
        <form id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row" data-kt-redirect="#">
            <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                <div class="card card-flush py-4">
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Aset</h2>
                        </div>
                    </div>
                    <div class="card-body text-center pt-0">
                        <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3"
                            data-kt-image-input="true">
                            <div class="image-input-wrapper w-150px h-150px"
                                style="background-image: url({{ $aset->gambar }})"></div>
                        </div>
                    </div>
                </div>
                <div class="card card-flush py-4">
                    <div class="card-header">
                        <div class="card-title">
                            <h4>Pemegang Aset</h4>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        @php
                            $pemegang = LokasiAset::getPegawaiByAsetId($aset->id);
                        @endphp
                        <ul class="list-group list-group-flush">
                            @foreach ($pemegang as $item)
                                <li class="list-group-item d-flex align-items-start justify-content-between">
                                    <ul>
                                        <li>
                                            <a href="#" class="fw-bold">{{ $item->pegawai->bidang->nama_bidang }}</a>
                                        </li>
                                        <div class="d-flex align-items-start">
                                            <p class="fw-semibold">{{ $item->pegawai->name }}
                                                <small class="text-muted">{{ $item->pegawai->nip ?? '-' }}</small>
                                            </p>
                                        </div>
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                <div class="card card-flush py-4">
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Detail Aset</h2>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="mb-2 fv-row">
                            <h2>{{ $aset->nama_aset }} (<span
                                    class="badge badge-light-secondary fw-light fa-5x">{{ $aset->kode_aset }}</span>)</h2>
                            <ul>
                                <li>
                                    <p class="fw-semibold">Merek: <span class="fw-bold">{{ $aset->merek }}</span></p>
                                </li>
                                <li>
                                    <p class="fw-semibold">Model: <span class="fw-bold">{{ $aset->model }}</span></p>
                                </li>
                                <li>
                                    <p class="fw-semibold">Serial Number: <span
                                            class="fw-bold">{{ $aset->serial_number }}</span></p>
                                </li>
                                <li>
                                    <p class="fw-semibold">Tanggal Perolehan: <span
                                            class="fw-bold">{{ \Carbon\Carbon::parse($aset->tanggal_perolehan)->format('d F Y') }}</span>
                                    </p>
                                </li>
                                <li>
                                    <p class="fw-semibold">Kondisi: <span
                                            class="fw-bold">{{ ucfirst($aset->status) }}</span></p>
                                </li>
                                <li>
                                    <p class="fw-semibold">Nilai Aset: <span class="fw-bold">Rp.
                                            {{ number_format($aset->nilai) }}</span></p>
                                </li>
                                <li>
                                    <p class="fw-semibold">Jumlah Aset: <span class="fw-bold">{{ $aset->jumlah }}
                                            Unit</span></p>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <label class="form-label">Keterangan</label>
                            <div id="kt_ecommerce_add_product_description" name="kt_ecommerce_add_product_description"
                                class="min-h-200px">{!! $aset->keterangan ?? '-' !!}</div>
                        </div>
                    </div>
                </div>
                <div class="card card-flush ">
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Deksripsi</h2>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="d-flex align-items-start">
                            <div class="d-flex flex-column flex-grow-1 me-7">
                                <div id="kt_ecommerce_add_product_description" name="kt_ecommerce_add_product_description"
                                    class="min-h-200px mb-2">{!! $aset->deskripsi !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

@endsection

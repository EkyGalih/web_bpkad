@extends('layouts.admin.inventaris.app')
@section('title', 'Daftar Lokasi Aset')
@section('lokasi', 'active')
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
                <li class="breadcrumb-item text-muted">Lokasi Aset</li>
            </ul>
        </div>
    </div>
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="row g-6 mb-6 g-xl-9 mb-xl-9">
                @foreach ($lokasiAset as $item)
                    <div class="col-md-6 col-xxl-4">
                        <div class="card">
                            <div class="card-body d-flex flex-center flex-column py-9 px-5">
                                <div class="symbol symbol-65px symbol-fixed mb-5">
                                    <img src="{{ asset('uploads/pegawai/'.$item->pegawai->foto) }}" class="rounded img-thumbnail h-150px w-100px" alt="image">
                                    {{-- <div
                                        class="bg-success position-absolute rounded img-thumbnail translate-middle start-100 top-100 border border-4 border-body h-25px w-15px ms-n3 mt-n3">
                                    </div> --}}
                                </div>
                                <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0">{{ $item->pegawai->name }}</a>
                                <div class="fw-semibold text-gray-500 mb-6">{{ $item->pegawai->nip ?? '-' }}</div>
                                @php
                                    $asets = LokasiAset::getAsetByPegawaiId($item->pegawai->id);
                                @endphp
                                <div class="d-flex flex-center flex-wrap mb-5">
                                <h5 class="mb-5">Aset yang dilokasikan :</h5>
                                    @foreach ($asets as $aset)
                                    <ul class="list-group list-group-flush fw-bold">
                                        <li class="list-group-item bg-transparent border-0 py-3 px-0">
                                            <div class="d-flex align-items-center">
                                                <div class="fs-6 text-gray-700 me-3">
                                                    <a href="{{ route('inventaris.aset.detail', $aset->asetTIK->id) }}"
                                                        class="text-gray-800 text-hover-primary">{{ $aset->asetTIK->nama_aset }}</a>
                                                </div>
                                                <div class="fw-normal text-gray-500 ms-auto">{{ $aset->asetTIK->kode_aset }}</div>
                                            </div>
                                        </li>
                                    </ul>
                                    @endforeach
                                </div>
                                <button class="btn btn-sm btn-light-primary btn-flex btn-center" data-kt-follow-btn="true">
                                    <i class="ki-duotone ki-pencil fs-3">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                    <span class="indicator-label">Edit</span>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

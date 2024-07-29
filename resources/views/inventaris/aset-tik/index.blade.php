@extends('layouts.admin.inventaris.app')
@section('title', 'Aset TIK')
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
            </ul>
        </div>
    </div>
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="row g-5 align-items-center mb-5">
                <div class="col-auto">
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input type="text" data-kt-ecommerce-category-filter="search"
                            class="form-control form-control-solid w-250px ps-12" placeholder="Cari Aset" />
                    </div>
                </div>
                <div class="col-auto ms-auto">
                    <a href="{{ route('inventaris.aset.create') }}" class="btn btn-md btn-primary">
                        <i class="ki-duotone ki-plus fs-3"></i>
                        Tambah Aset
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                @foreach ($asets as $aset)
                    <div class="card mb-6">
                        <div class="card-body pt-9 pb-0">
                            <div class="d-flex flex-wrap flex-sm-nowrap">
                                <div class="me-7 mb-4">
                                    <a href="{{ route('inventaris.aset.detail', $aset->id) }}"
                                        class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative image-placeholder kt-spinner kt-spinner--sm kt-spinner--brand">
                                        <img src="{{ $aset->gambar }}" alt="{{ $aset->nama_aset }}" class="lazy"
                                            loading="lazy" />
                                    </a>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                        <div class="d-flex flex-column">
                                            <div class="d-flex align-items-center mb-2">
                                                <a href="{{ route('inventaris.aset.detail', $aset->id) }}"
                                                    class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $aset->nama_aset }}</a>
                                                <a href="#">
                                                    ({{ $aset->kode_aset }})
                                                </a>
                                            </div>
                                            <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                                <span
                                                    class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                                    <i class="ki-duotone ki-price-tag fs-4 me-1">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i> {{ $aset->merek }}
                                                </span>
                                                <span
                                                    class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                                    <i class="ki-duotone ki-lots-shopping fs-4 me-1">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                        <span class="path5"></span>
                                                        <span class="path6"></span>
                                                        <span class="path7"></span>
                                                        <span class="path8"></span>
                                                    </i> {{ $aset->model }}
                                                </span>
                                                <span
                                                    class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                                    <i class="ki-duotone ki-barcode fs-4 me-1">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                        <span class="path5"></span>
                                                        <span class="path6"></span>
                                                        <span class="path7"></span>
                                                        <span class="path8"></span>
                                                    </i> {{ $aset->serial_number }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="d-flex my-4">
                                            <div class="me-0">
                                                <a href="#" class="btn btn-sm btn-primary me-3" data-bs-toggle="modal"
                                                    data-bs-target="#kt_modal_offer_a_deal">Distribusi</a>
                                                <button class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary"
                                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                    <i class="ki-solid ki-dots-horizontal fs-2x"></i>
                                                </button>
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3"
                                                    data-kt-menu="true">
                                                    <div class="menu-item px-3">
                                                        <a href="{{ route('inventaris.aset.edit', $aset->id ?? '') }}"
                                                            class="menu-link px-3">
                                                            Edit
                                                        </a>
                                                        <a href="{{ route('inventaris.aset.destroy', $aset->id ?? '') }}"
                                                            class="menu-link px-3">
                                                            Hapus
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-wrap flex-stack">
                                        <div class="d-flex flex-column flex-grow-1 pe-8">
                                            <div class="d-flex flex-wrap">
                                                <div
                                                    class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="fs-2 fw-bold" data-kt-countup="true"
                                                            data-kt-countup-value="{{ $aset->nilai }}"
                                                            data-kt-countup-prefix="Rp. ">0
                                                        </div>
                                                    </div>
                                                    <div class="fw-semibold fs-6 text-gray-500">Nilai</div>
                                                </div>
                                                <div
                                                    class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="fs-2 fw-bold" data-kt-countup="true"
                                                            data-kt-countup-value="{{ $aset->jumlah }}">0
                                                        </div>
                                                    </div>
                                                    <div class="fw-semibold fs-6 text-gray-500">Jumlah</div>
                                                </div>
                                                <div
                                                    class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="fs-2 fw-bold" data-kt-countup="true"
                                                            data-kt-countup-value="{{ number_format($aset->nilai * $aset->jumlah) }}"
                                                            data-kt-countup-prefix="RP. ">0</div>
                                                    </div>
                                                    <div class="fw-semibold fs-6 text-gray-500">Total Nilai Aset</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                                            <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                                <span class="fw-semibold fs-6 text-gray-500">Profile Compleation</span>
                                                <span class="fw-bold fs-6">50%</span>
                                            </div>
                                            <div class="h-5px mx-3 w-100 bg-light mb-3">
                                                <div class="bg-success rounded h-5px" role="progressbar"
                                                    style="width: 50%;" aria-valuenow="50" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                                <li class="nav-item mt-2">
                                    <a class="nav-link text-active-primary ms-0 me-10 py-5" href="#">Lokasi Aset</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endforeach
                {{ $asets->links() }}
            </div>
        </div>
    </div>
@endsection

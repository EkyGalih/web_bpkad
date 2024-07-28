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
            <div class="card card-flush">
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-ecommerce-category-filter="search"
                                class="form-control form-control-solid w-250px ps-12" placeholder="Cari Aset" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <!-- Button trigger modal -->
                        <a href="{{ route('inventaris.aset.create') }}" class="btn btn-md btn-primary">
                            <i class="ki-duotone ki-plus fs-3"></i>
                            Tambah Aset
                        </a>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_category_table">
                            <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th>#</th>
                                    <th>Aset</th>
                                    <th>Jenis Aset</th>
                                    <th>Spesifikasi Aset</th>
                                    <th>Tahun Perolehan</th>
                                    <th>Status Aset</th>
                                    <th>Jumlah</th>
                                    <th>Nilai per Unit</th>
                                    <th class="text-end min-w-70px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($asets->isEmpty())
                                    <tr>
                                        <td class="text-center" colspan="10">Data Tidak Tersedia <i
                                                class="ki-duotone ki-arrow-down fs-2"></td>
                                    </tr>
                                @else
                                    @foreach ($asets as $aset)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="#" class="symbol symbol-50px">
                                                        <span class="symbol-label" style="background-image:url({{ $aset->gambar }});"></span>
                                                    </a>
                                                    <div class="ms-5 fw-bold">
                                                        <a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1" data-kt-ecommerce-category-filter="category_name">{{ $aset->nama_aset }}</a>
                                                        <div class="text-muted fs-7 fw-bold">[{{ $aset->kode_aset }}]</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $aset->kategori->nama_kategori }}
                                            </td>
                                            <td class="w-125">
                                                <div class="fw-bold">
                                                    Tipe : {{ $aset->type }}, Model : {{ $aset->model }}, Serial Number : {{ $aset->serial_number }}
                                                </div>
                                            </td>
                                            <td>
                                                {{ date('M Y', strtotime($aset->tanggal_perolehan)) }}
                                            </td>
                                            <td>
                                                {{ $aset->status }}
                                            </td>
                                            <td>{{ $aset->jumlah }}</td>
                                            <td>Rp. {{ number_format($aset->nilai) }}</td>
                                            <td class="text-end">
                                                <a href="#"
                                                    class="btn btn-sm btn-light btn-active-light-primary btn-flex btn-center"
                                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                    data-kt-menu="true">
                                                    <div class="menu-item px-3">
                                                        <a href="{{ route('inventaris.aset.edit', $aset->id) }}"
                                                            class="menu-link px-3">Edit</a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3"
                                                            data-kt-ecommerce-category-filter="delete_row">Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        {{ $asets->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

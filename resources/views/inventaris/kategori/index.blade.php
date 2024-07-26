@extends('layouts.admin.inventaris.app')
@section('title', 'Kategori')
@section('header')
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Kategori
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
                <li class="breadcrumb-item text-muted">Kategori</li>
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
                                class="form-control form-control-solid w-250px ps-12" placeholder="Cari Kategori" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-md btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addCategory">
                            <i class="ki-duotone ki-plus fs-3"></i>
                            Tambah Kategori
                        </button>

                        <!-- Modal -->
                        @include('inventaris.kategori.partials.add')
                    </div>
                </div>
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_category_table">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-250px">Kategori</th>
                                <th class="min-w-150px">Jumlah Aset</th>
                                <th class="text-end min-w-70px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @if ($kategories->isEmpty())
                            <tr>
                                <td class="text-center" colspan="3">Data Tidak Tersedia <i class="ki-duotone ki-arrow-down fs-2"></td>
                            </tr>
                            @else
                                @foreach ($kategories as $kategori)
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <div class="ms-5">
                                                    {{ $kategori->nama_kategori }}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="badge badge-light-success">Automated</div>
                                        </td>
                                        <td class="text-end">
                                            <a href="#"
                                                class="btn btn-sm btn-light btn-active-light-primary btn-flex btn-center"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                data-kt-menu="true">
                                                <div class="menu-item px-3">
                                                    <a href="apps/ecommerce/catalog/add-category.html"
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
                    {{ $kategories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

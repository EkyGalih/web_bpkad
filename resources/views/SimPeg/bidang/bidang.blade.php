@extends('SimPeg.index')
@section('title', 'Bidang')
@section('title_page', 'Bidang')
@section('bidang', 'here show')
@section('header')
    <div class="d-flex flex-stack justify-content-end flex-row-fluid" id="kt_app_navbar_wrapper">
        <div class="app-page-entry d-flex align-items-center flex-row-fluid gap-3">
            <div class="d-flex flex-column">
                <h1 class="text-gray-900 fs-2 fw-bold mb-0">Bidang</h1>
            </div>
        </div>
    </div>
    <div class="float-end p-7">
        <button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#addBidang">
            <i class="ki-duotone ki-plus-square fs-4">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
            </i> Tambah Bidang
        </button>
    </div>
@endsection
@section('content')
    <div class="row g-6 g-xl-9 mb-6 mb-xl-9">
        @foreach ($bidang as $item)
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="card h-100 position-relative">
                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                        <a href="{{ route('bidang.getPegawai', $item->id) }}" class="text-gray-800 text-hover-primary d-flex flex-column">
                            <div class="symbol symbol-75px mb-5">
                                <img src="{{ asset('assets/media/svg/files/folder-document.svg') }}"
                                    class="theme-light-show" alt="">
                                <img src="{{ asset('assets/media/svg/files/folder-document-dark.svg') }}"
                                    class="theme-dark-show" alt="">
                            </div>
                            <div class="fs-5 fw-bold mb-2">{{ $item->nama_bidang }}</div>
                        </a>
                        <div class="fs-7 fw-semibold text-gray-500">{{ \App\Models\Bidang::countPegawai($item->id) }}
                            Pegawai</div>
                        <button type="button"
                            class="btn btn-icon btn-sm btn-warning btn-active-light-warning position-absolute top-0 end-0 m-3"
                            data-bs-toggle="modal" data-bs-target="#editBidang{{ $item->id }}">
                            <i class="ki-duotone ki-pencil fs-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </button>
                    </div>
                </div>
            </div>
            {{-- MODAL EDIT BIDANG --}}
            <div class="modal fade" id="editBidang{{ $item->id }}" tabindex="-1" aria-labelledby="editBidangLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editBidangLabel">Perbaharui Data Bidang</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('bidang.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="nama_bidang" class="form-label">Nama Bidang</label>
                                    <input type="text" class="form-control" id="nama_bidang" name="nama_bidang" value="{{ $item->nama_bidang }}">
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="ki-duotone ki-abstract-11 fs-4">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                Close
                            </button>
                            <button type="submit" class="btn btn-success">
                                <i class="ki-duotone ki-send fs-4">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                Simpan
                            </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- MODAL TAMBAH BIDANG --}}
    <div class="modal fade" id="addBidang" tabindex="-1" aria-labelledby="addBidangLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBidangLabel">Tambah Bidang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('bidang.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_bidang" class="form-label">Nama Bidang</label>
                            <input type="text" class="form-control" id="nama_bidang" name="nama_bidang">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-abstract-11 fs-4">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="ki-duotone ki-plus-square fs-4">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                        Tambah
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

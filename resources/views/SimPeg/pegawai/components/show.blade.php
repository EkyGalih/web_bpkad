@extends('SimPeg.index')
@section('title', 'Rincian Pegawai')
@section('pegawai', 'here show')
@section('styles')
    <link rel="stylesheet" href="{{ asset('server/vendor/tom-select/tom-select.css') }}">
    <style>
        .image_upload>input {
            display: none;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 70%;
            transform: translate(-50%, -50%) rotate(-30deg);
            font-size: 7rem;
            /* Increase font size */
            font-weight: bold;
            color: rgba(255, 0, 0, 0.7);
            /* Make color less transparent */
            text-transform: uppercase;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
            /* Add shadow for more visibility */
            pointer-events: none;
            /* Prevents watermark from being clicked */
            z-index: 1;
        }
    </style>
@section('header')
    <div class="d-flex flex-stack justify-content-end flex-row-fluid" id="kt_app_navbar_wrapper">
        <div class="app-page-entry d-flex align-items-center flex-row-fluid gap-3">
            <div class="d-flex flex-column">
                <h1 class="text-gray-900 fs-2 fw-bold mb-0 ki-text-underline">Rincian Pegawai {{ $pegawai->name }}</h1>
            </div>
        </div>
    </div>
    <div class="float-end p-7">
        <a href="{{ route('pegawai.index') }}" class="btn btn-secondary btn-sm">
            <i class="ki-duotone ki-double-left-arrow fs-4">
                <span class="path1"></span>
                <span class="path2"></span>
            </i> Kembali
        </a>
    </div>
@endsection
@endsection
@section('content')
<div class="card mb-6">
    <div class="card-body pt-9 pb-0">
        <div class="d-flex flex-wrap flex-sm-nowrap">
            <div class="me-7 mb-4">
                <div class="symbol symbol-150px symbol-lg-200px symbol-fixed position-relative">
                    <img src="{{ Storage::url($pegawai->foto) }}" alt="{{ $pegawai->name }}" />
                    @if ($pegawai->status_pegawai == 'pensiun')
                        <div class="watermark">PENSIUN</div>
                    @elseif($pegawai->status_pegawai == 'pindah')
                        <div class="watermark">PINDAH</div>
                    @endif
                </div>
            </div>
            <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                    <div class="d-flex flex-column">
                        <div class="d-flex align-items-center mb-2">
                            <a href="{{ route('pegawai.show', $pegawai->id) }}"
                                class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $pegawai->name }}</a>
                            <a href="#">
                                @if ($pegawai->jenis_pegawai == 'asn')
                                    <i class="ki-outline ki-verify fs-1 text-primary"></i>
                                @endif
                            </a>
                        </div>
                        <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                            <a href="#"
                                class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                <i class="ki-duotone ki-profile-user fs-4 me-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>{{ strtoupper($pegawai->jenis_kelamin) ?? '-' }}</a>
                            <a href="#"
                                class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                <i class="ki-outline ki-barcode fs-4 me-1"></i>{{ $pegawai->nip ?? '-' }}</a>
                            <a href="{{ route('bidang.getPegawai', $pegawai->bidang->id) }}"
                                class="d-flex align-items-center text-gray-500 text-hover-primary mb-2">
                                <i class="ki-duotone ki-office-bag fs-4 me-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>{{ $pegawai->bidang->nama_bidang }}</a>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-wrap flex-stack">
                    <div class="d-flex flex-column flex-grow-1 pe-8">
                        <div class="d-flex flex-wrap">
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="ki-outline ki-medal-star fs-3 me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                    <div class="fs-2 fw-bold">{{ $pegawai->pangkat->nama_pangkat ?? '-' }}</div>
                                </div>
                                <div class="fw-semibold fs-6 text-gray-500">
                                    {{ $pegawai->golongan->nama_golongan ?? '-' }}</div>
                            </div>
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="ki-duotone ki-calendar-2 fs-3 me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>
                                    <div class="fs-2 fw-bold">{{ $pegawai->umur }}</div>
                                </div>
                                <div class="fw-semibold fs-6 text-gray-500">Tahun</div>
                            </div>
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="ki-duotone ki-star fs-3 text-warning me-2"></i>
                                    <div class="fs-2 fw-bold">{{ strtoupper($pegawai->jenis_pegawai) }}</div>
                                </div>
                                <div class="fw-semibold fs-6 text-gray-500">{{ $pegawai->status_pegawai }}</div>
                            </div>
                        </div>
                    </div>
                    @if ($pegawai->kenaikan_pangkat != null)
                        <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                            <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                <span class="fw-semibold fs-6 text-gray-500">Kenaikan Pangkat</span>
                                <span
                                    class="fw-bold fs-6">{{ Helpers::progressBarPangkat($pegawai->kenaikan_pangkat) }}%</span>
                            </div>
                            <div class="h-5px mx-3 w-100 bg-light mb-3">
                                <div class="bg-success rounded h-5px" role="progressbar"
                                    style="width: {{ Helpers::progressBarPangkat($pegawai->kenaikan_pangkat) }}%;"
                                    aria-valuenow="{{ Helpers::progressBarPangkat($pegawai->kenaikan_pangkat) }}"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
    <div class="card-header cursor-pointer">
        <div class="card-title m-0">
            <h3 class="fw-bold m-0">Rincian Profile Pegawai</h3>
        </div>
        <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="btn btn-sm btn-primary align-self-center">Edit
            Profile</a>
    </div>
    <div class="card-body p-9">
        <div class="row mb-7">
            <label class="col-lg-2 fw-semibold text-muted">Nama Lengkap</label>
            <div class="col-lg-8">
                <span class="fw-bold fs-6 text-gray-800">{{ $pegawai->name }}</span>
            </div>
        </div>
        <div class="row mb-7">
            <label class="col-lg-2 fw-semibold text-muted">Tempat/Tanggal Lahir</label>
            <div class="col-lg-8 fv-row">
                <span
                    class="fw-semibold text-gray-800 fs-6">{{ \Carbon\Carbon::parse($pegawai->tanggal_lahir)->locale('id_ID')->translatedFormat('l, d F Y') }}</span>
                ({{ Helpers::USIA($pegawai->tanggal_lahir)->umur . ' Tahun' }},
                {{ Helpers::USIA($pegawai->tanggal_lahir)->hari . ' Hari' }})</span>
            </div>
        </div>
        <div class="row mb-7">
            <label class="col-lg-2 fw-semibold text-muted">Pendidikan</label>
            <div class="col-lg-8 fv-row">
                {{ $pegawai->pendidikan ?? '-' }}
            </div>
        </div>
        <div class="row mb-7">
            <label class="col-lg-2 fw-semibold text-muted">Diklat Terakhir</label>
            <div class="col-lg-8 fv-row">
                {{ $pegawai->diklat ?? '-' }}
            </div>
        </div>
        <div class="row mb-7">
            <label class="col-lg-2 fw-semibold text-muted">Jabatan</label>
            <div class="col-lg-8 fv-row">
                <span class="fw-bold fs-6 text-gray-800">{{ strtoupper($pegawai->nama_jabatan) }} -
                    {{ $pegawai->jabatan }}</span>
            </div>
        </div>
        <div class="row mb-10">
            <label class="col-lg-2 fw-semibold text-muted">Tanggal/Nomor SK</label>
            <div class="col-lg-8">
                <span
                    class="fw-semibold fs-6 text-gray-800">{{ \Carbon\Carbon::parse($pegawai->tanggal_sk)->locale('id_ID')->translatedFormat('l, d F Y') ?? '-' }}
                    / {{ $pegawai->no_sk ?? '-' }}</span>
            </div>
        </div>
        @if ($pegawai->jenis_pegawai == 'asn')
            <div class="row mb-10">
                <label class="col-lg-2 fw-semibold text-muted">Masa Kerja Golongan</label>
                <div class="col-lg-8">
                    <span class="fw-semibold fs-6 text-gray-800">{{ $pegawai->masa_kerja_golongan ?? '-' }}</span>
                </div>
            </div>
            <div class="row mb-10">
                <label class="col-lg-2 fw-semibold text-muted">Kenaikan Pangkat Berikutnya</label>
                <div class="col-lg-8">
                    <span
                        class="fw-semibold fs-6 text-gray-800">{{ \Carbon\Carbon::parse($pegawai->kenaikan_pangkat)->locale('id_ID')->translatedFormat('l, d F Y') ?? '-' }}</span>
                </div>
            </div>
            <div class="row mb-10">
                <label class="col-lg-2 fw-semibold text-muted">Tahun Pensiun</label>
                <div class="col-lg-8">
                    <span class="fw-semibold fs-6 text-gray-800">Tahun {{ $pegawai->batas_pensiun }}</span>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

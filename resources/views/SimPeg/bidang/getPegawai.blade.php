@extends('SimPeg.index')
@section('title', 'Pegawai Bidang')
@section('bidang', 'here show')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/simpeg.css') }}">
@endsection
@section('header')
    <div class="d-flex flex-stack justify-content-end flex-row-fluid" id="kt_app_navbar_wrapper">
        <div class="app-page-entry d-flex align-items-center flex-row-fluid gap-3">
            <div class="d-flex flex-column">
                <h1 class="text-gray-900 fs-2 fw-bold mb-0">Pegawai Bidang {{ $nama_bidang }}</h1>
            </div>
        </div>
    </div>
    <div class="float-end p-7">
        <a href="{{ route('bidang.index') }}" class="btn btn-secondary btn-sm">
            <i class="ki-duotone ki-double-left-arrow fs-4">
                <span class="path1"></span>
                <span class="path2"></span>
            </i> Kembali
        </a>
    </div>
@endsection
@section('content')
    @if ($pegawai->isEmpty())
        <div class="d-flex flex-column align-items-center py-10">
            <img src="{{ asset('assets/media/illustrations/sketchy-1/1.png') }}" alt="" class="mw-100 mh-300px" />
            <h2 class="fw-bold fs-3hx text-gray-800">Tidak Ada Data Pegawai</h2>
        </div>
    @else
        <div class="dropdown">
            <input type="text" id="search" placeholder="Cari pegawai..." autocomplete="off">
            <ul class="dropdown-menu" id="results"></ul>
        </div>
        @foreach ($pegawai as $item)
            <div class="card mb-6">
                <div class="card-body pt-9 pb-0">
                    <div class="d-flex flex-wrap flex-sm-nowrap">
                        <div class="me-7 mb-4">
                            <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                <img src="{{ $item->foto }}" alt="{{ $item->name }}" />
                                @if ($item->status_pegawai == 'pensiun')
                                    <div class="watermark">PENSIUN</div>
                                @elseif($item->status_pegawai == 'pindah')
                                    <div class="watermark">PINDAH</div>
                                @endif
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center mb-2">
                                        <a href="{{ route('pegawai.show', $item->id) }}"
                                            class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $item->name }}</a>
                                        <a href="#">
                                            @if ($item->jenis_pegawai == 'asn')
                                                <i class="ki-outline ki-verify fs-1 text-primary"></i>
                                            @endif
                                        </a>
                                    </div>
                                    <!--end::Name-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                        <a href="#"
                                            class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                            <i class="ki-duotone ki-profile-user fs-4 me-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                            </i>{{ strtoupper($item->jenis_kelamin) ?? '-' }}</a>
                                        <a href="{{ route('pegawai.show', $item->id) }}"
                                            class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                            <i class="ki-outline ki-barcode fs-4 me-1"></i>{{ $item->nip ?? '-' }}</a>
                                        <a href="{{ route('bidang.getPegawai', $item->bidang->id) }}"
                                            class="d-flex align-items-center text-gray-500 text-hover-primary mb-2">
                                            <i class="ki-duotone ki-office-bag fs-4 me-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                            </i>{{ $item->bidang->nama_bidang }}</a>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::User-->
                                <!--begin::Actions-->
                                <div class="d-flex my-4">
                                    <a href="{{ route('pegawai.edit', $item->id) }}" class="btn btn-sm btn-warning me-2"
                                        id="kt_user_follow_button">
                                        <i class="ki-outline ki-check fs-3 d-none"></i>
                                        <!--begin::Indicator label-->
                                        <span class="indicator-label">Edit</span>
                                        <!--end::Indicator label-->
                                    </a>
                                    <a href="#" class="btn btn-sm btn-danger me-3" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_offer_a_deal">Hapus</a>
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Title-->
                            <!--begin::Stats-->
                            <div class="d-flex flex-wrap flex-stack">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column flex-grow-1 pe-8">
                                    <!--begin::Stats-->
                                    <div class="d-flex flex-wrap">
                                        <!--begin::Stat-->
                                        <div
                                            class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                            <!--begin::Number-->
                                            <div class="d-flex align-items-center">
                                                <i class="ki-outline ki-medal-star fs-3 me-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                </i>
                                                <div class="fs-2 fw-bold">{{ $item->pangkat->nama_pangkat ?? '-' }}</div>
                                            </div>
                                            <!--end::Number-->
                                            <!--begin::Label-->
                                            <div class="fw-semibold fs-6 text-gray-500">
                                                {{ $item->golongan->nama_golongan ?? '-' }}</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Stat-->
                                        <!--begin::Stat-->
                                        <div
                                            class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                            <!--begin::Number-->
                                            <div class="d-flex align-items-center">
                                                <i class="ki-duotone ki-calendar-2 fs-3 me-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                    <span class="path5"></span>
                                                </i>
                                                <div class="fs-2 fw-bold">{{ $item->umur }}</div>
                                            </div>
                                            <!--end::Number-->
                                            <!--begin::Label-->
                                            <div class="fw-semibold fs-6 text-gray-500">Tahun</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Stat-->
                                        <!--begin::Stat-->
                                        <div
                                            class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                            <!--begin::Number-->
                                            <div class="d-flex align-items-center">
                                                <i class="ki-duotone ki-star fs-3 text-warning me-2"></i>
                                                <div class="fs-2 fw-bold">{{ strtoupper($item->jenis_pegawai) }}</div>
                                            </div>
                                            <!--end::Number-->
                                            <!--begin::Label-->
                                            <div class="fw-semibold fs-6 text-gray-500">{{ $item->status_pegawai }}</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Stat-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Progress-->
                                @if ($item->kenaikan_pangkat != null)
                                    <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                                        <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                            <span class="fw-semibold fs-6 text-gray-500">Kenaikan Pangkat</span>
                                            <span
                                                class="fw-bold fs-6">{{ progressBarPangkat($item->kenaikan_pangkat) }}%</span>
                                        </div>
                                        <div class="h-5px mx-3 w-100 bg-light mb-3">
                                            <div class="bg-success rounded h-5px" role="progressbar"
                                                style="width: {{ progressBarPangkat($item->kenaikan_pangkat) }}%;"
                                                aria-valuenow="{{ progressBarPangkat($item->kenaikan_pangkat) }}"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                @endif
                                <!--end::Progress-->
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Details-->
                </div>
            </div>
        @endforeach
        {{ $pegawai->links() }}
    @endif
@endsection
@section('scripts')
    <script>
        window.route_pegawai_search = '{{ route('pegawai.search') }}';
        window.route_pegawai_show_base = '{{ route('pegawai.show', '') }}';
    </script>
    <script src="{{ asset('js/simpeg-search.js') }}"></script>
@endsection

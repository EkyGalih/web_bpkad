@extends('SimPeg.index')
@section('title', env('APP_NAME') . ' - SIMPEG')
@section('content')
    @foreach ($pegawai as $item)
        <div class="card mb-6">
            <div class="card-body pt-9 pb-0">
                <div class="d-flex flex-wrap flex-sm-nowrap">
                    <div class="me-7 mb-4">
                        <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                            <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->name }}" />
                            <div
                                class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px">
                            </div>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                            <div class="d-flex flex-column">
                                <div class="d-flex align-items-center mb-2">
                                    <a href="#"
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
                                    <a href="#"
                                        class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                        <i class="ki-outline ki-barcode fs-4 me-1"></i>{{ $item->nip ?? '-' }}</a>
                                    <a href="#"
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
                                <a href="#" class="btn btn-sm btn-light me-2" id="kt_user_follow_button">
                                    <i class="ki-outline ki-check fs-3 d-none"></i>
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">Follow</span>
                                    <!--end::Indicator label-->
                                    <!--begin::Indicator progress-->
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    <!--end::Indicator progress-->
                                </a>
                                <a href="#" class="btn btn-sm btn-primary me-3" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_offer_a_deal">Hire Me</a>
                                <!--begin::Menu-->
                                <div class="me-0">
                                    <button class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary"
                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <i class="ki-solid ki-dots-horizontal fs-2x me-1"></i>
                                    </button>
                                    <!--begin::Menu 3-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3"
                                        data-kt-menu="true">
                                        <!--begin::Heading-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Payments
                                            </div>
                                        </div>
                                        <!--end::Heading-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">Create Invoice</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link flex-stack px-3">Create Payment
                                                <span class="ms-2" data-bs-toggle="tooltip"
                                                    title="Specify a target name for future usage and reference">
                                                    <i class="ki-outline ki-information fs-6"></i>
                                                </span></a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">Generate Bill</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                            data-kt-menu-placement="right-end">
                                            <a href="#" class="menu-link px-3">
                                                <span class="menu-title">Subscription</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <!--begin::Menu sub-->
                                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Plans</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Billing</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Statements</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu separator-->
                                                <div class="separator my-2"></div>
                                                <!--end::Menu separator-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <div class="menu-content px-3">
                                                        <!--begin::Switch-->
                                                        <label
                                                            class="form-check form-switch form-check-custom form-check-solid">
                                                            <!--begin::Input-->
                                                            <input class="form-check-input w-30px h-20px" type="checkbox"
                                                                value="1" checked="checked" name="notifications" />
                                                            <!--end::Input-->
                                                            <!--end::Label-->
                                                            <span class="form-check-label text-muted fs-6">Recuring</span>
                                                            <!--end::Label-->
                                                        </label>
                                                        <!--end::Switch-->
                                                    </div>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu sub-->
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3 my-1">
                                            <a href="#" class="menu-link px-3">Settings</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu 3-->
                                </div>
                                <!--end::Menu-->
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
                            <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                                <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                    <span class="fw-semibold fs-6 text-gray-500">Kenaikan Pangkat</span>
                                    <span class="fw-bold fs-6">50%</span>
                                </div>
                                <div class="h-5px mx-3 w-100 bg-light mb-3">
                                    <div class="bg-success rounded h-5px" role="progressbar" style="width: 50%;"
                                        aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
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
@endsection

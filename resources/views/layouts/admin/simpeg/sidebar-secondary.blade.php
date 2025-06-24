<div class="app-sidebar-secondary">
    <div class="d-flex flex-column gap-8 flew-grow-1 p-4 p-lg-6" id="kt_sidebar_secondary_wrapper">
        <div id="kt_sidebar_secondary_project_select">
            <button type="button" data-kt-element="selected"
                class="btn btn-outline btn-outline-dashed h-60px d-flex text-start flex-stack w-100 ps-4 pe-8"
                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-offset="0px, -1px">
                <span class="d-none d-md-flex flex-column pt-2" data-kt-element="title">
                    <span class="fs-6 fw-bold lh-1 mb-1">Daftar Aplikasi</span>
                    @if (request()->path() == 'admin/web')
                        <span class="text-primary fs-7">Web
                            <span class="text-gray-500">sistem informasi</span>
                        </span>
                    @elseif (request()->path() == 'admin/simpeg')
                        <span class="text-primary fs-7">SimPeg
                            <span class="text-gray-500">sistem informasi pegawai</span>
                        </span>
                    @endif
                </span>
                <span class="d-flex flex-column me-n4">
                    <i class="ki-outline ki-down fs-5 text-gray-500"></i>
                </span>
            </button>
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-state-bg menu-rounded w-200px ps-3"
                data-kt-menu="true">
                <div class="hover-scroll-y mh-200px my-3 pe-3 me-n1">
                    <div class="menu-item my-0 py-1">
                        <a href="{{ ENV('APP_URL') }}/admin/web" class="menu-link px-3 py-2" data-kt-element="project">
                            <span class="d-flex flex-column align-items-start">
                                <span class="fs-7 fw-semibold text-primary" data-kt-element="title">Web
                                    <span class="text-gray-500">sistem informasi</span></span>
                            </span>
                        </a>
                    </div>
                    <div class="menu-item my-0 py-1">
                        <a href="{{ ENV('APP_URL') }}/admin/simpeg" class="menu-link px-3 py-2"
                            data-kt-element="project">
                            <span class="d-flex flex-column align-items-start">
                                <span class="fs-7 fw-semibold text-primary" data-kt-element="title">Simpeg
                                    <span class="text-gray-500">sistem informasi pegawai</span></span>
                            </span>
                        </a>
                    </div>
                    <div class="menu-item my-0 py-1">
                        <a href="{{ ENV('APP_URL') }}/bpkad/home" class="menu-link px-3 py-2" data-kt-element="project">
                            <span class="d-flex flex-column align-items-start">
                                <span class="fs-7 fw-semibold text-primary" data-kt-element="title">Landing Page
                                    <span class="text-gray-500">Landing Page</span>
                                </span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="position-relative" id="kt_sidebar_secondary_search">
            <div class="d-flex align-items-center position-absolute translate-middle-y top-50 start-0 ms-3">
                <i class="ki-outline ki-magnifier text-gray-600 fs-3"></i>
            </div>
            <input type="text" class="form-control form-control-solid border ps-10" minlength="3" maxlength="4"
                placeholder="Search Projects..." name="project" />
        </div>
        <div>
            @php
                $kaban = get_pimpinan('select', strtolower(App\Enum\JabatanEnum::KABAN->name));
                $sekban = get_pimpinan('select', strtolower(App\Enum\JabatanEnum::SEKBAN->name));
                $kabid = getKabag(
                    'select',
                    strtolower(App\Enum\JabatanEnum::KABID->name),
                    strtolower(App\Enum\JabatanEnum::KEPALA->name),
                );
                $kasubid = getKasubag('select', strtolower(App\Enum\JabatanEnum::KASUBID->name), 'Kepala Sub Bidang');
            @endphp
            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x d-flex mb-5 fs-6 fw-semibold"
                id="kt_sidebar_secondary_tabs">
                <li class="nav-item flex-fill">
                    <a class="nav-link text-center text-gray-600 text-active-gray-800 py-2 px-2 mx-0 active"
                        data-bs-toggle="tab" href="#kt_projects_active">Eselon II & III
                        <span class="text-gray-500">({{ 1 + 1 + count($kabid) }})</span></a>
                </li>
                <li class="nav-item flex-fill">
                    <a class="nav-link text-center text-gray-600 text-active-gray-800 py-2 px-2 mx-0"
                        data-bs-toggle="tab" href="#kt_projects_completed">Eselon IV
                        <span class="text-gray-500">({{ count($kasubid) }})</span></a>
                </li>
            </ul>
            <div class="hover-scroll-y" data-kt-scroll="true" data-kt-scroll-height="auto"
                data-kt-scroll-dependencies="#kt_app_footer, #kt_sidebar_secondary_search, #kt_sidebar_secondary_project_select, #kt_sidebar_secondary_tabs"
                data-kt-scroll-wrappers="#kt_sidebar_secondary_wrapper" data-kt-scroll-offset="0px">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="kt_projects_active" role="tabpanel">
                        <div class="d-flex flex-column flex-grow-1 gap-1">
                            <a href="{{ route('pegawai.show', $kaban->id) }}"
                                class="d-flex align-items-center p-3 gap-2 border border-transparent bg-hover-light-primary border-hover-primary-clarity rounded">
                                <img src="{{ $kaban->foto }}" class="h-40px rounded" />
                                <div class="d-flex flex-column">
                                    <div class="text-gray-900 fs-6 fw-semibold">{{ Str::limit($kaban->name, 17) }}</div>
                                    <div class="text-gray-600 fs-7">{{ $kaban->nip ?? '-' }}</div>
                                    <div class="fw-bold text-primary">{{ strtoupper($kaban->initial_jabatan) }}</div>
                                </div>
                            </a>
                            <a href="{{ route('pegawai.show', $sekban->id) }}"
                                class="d-flex align-items-center p-3 gap-2 border border-transparent bg-hover-light-primary border-hover-primary-clarity rounded">
                                <img src="{{ $sekban->foto }}" class="h-40px rounded" />
                                <div class="d-flex flex-column">
                                    <div class="text-gray-900 fs-6 fw-semibold">{{ Str::limit($sekban->name, 17) }}
                                    </div>
                                    <div class="text-gray-600 fs-7">{{ $sekban->nip ?? '-' }}</div>
                                    <div class="fw-bold text-primary">{{ strtoupper($sekban->initial_jabatan) }}</div>
                                </div>
                            </a>
                            @foreach ($kabid as $items)
                                <a href="{{ route('pegawai.show', $items->id) }}"
                                    class="d-flex align-items-center p-3 gap-2 border border-transparent bg-hover-light-primary border-hover-primary-clarity rounded">
                                    <img src="{{ $items->foto }}" class="h-40px rounded" />
                                    <div class="d-flex flex-column">
                                        <div class="text-gray-900 fs-6 fw-semibold">{{ Str::limit($items->name, 17) }}
                                        </div>
                                        <div class="text-gray-600 fs-7">{{ $items->nip ?? '-' }}</div>
                                        <div class="fw-bold text-primary">
                                            {{ strtoupper($items->nama_jabatan . ' ' . $items->jabatan) }}
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="kt_projects_completed" role="tabpanel">
                        <div class="d-flex flex-column flex-grow-1 gap-1">
                            @foreach ($kasubid as $item)
                                <a href="{{ route('pegawai.show', $item->id) }}"
                                    class="d-flex align-items-center p-3 gap-2 border border-transparent bg-hover-light-primary border-hover-primary-clarity rounded">
                                    <img src="{{ $item->foto }}" class="h-40px rounded" />
                                    <div class="d-flex flex-column">
                                        <div class="text-gray-900 fs-6 fw-semibold">{{ Str::limit($item->name, 17) }}
                                        </div>
                                        <div class="text-gray-600 fs-7">{{ $item->nip ?? '-' }}</div>
                                        <div class="fw-bold text-primary">
                                            {{ strtoupper($item->nama_jabatan . ' ' . $item->jabatan) }}
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

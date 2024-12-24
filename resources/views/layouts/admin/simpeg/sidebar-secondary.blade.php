<div class="app-sidebar-secondary">
    <div class="d-flex flex-column gap-8 flew-grow-1 p-4 p-lg-6" id="kt_sidebar_secondary_wrapper">
        <!--begin::Categories-->
        <div id="kt_sidebar_secondary_project_select">
            <!--begin::Toggle-->
            <button type="button" data-kt-element="selected" class="btn btn-outline btn-outline-dashed h-50px d-flex text-start flex-stack w-100 ps-4 pe-8" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-offset="0px, -1px">
                <!--begin::Title-->
                <span class="d-none d-md-flex flex-column pt-2" data-kt-element="title">
                    <span class="fs-6 fw-bold lh-1 mb-1">Daftar Aplikasi</span>
                    <span class="text-primary fs-7">KeenThemes
                    <span class="text-gray-500">space</span></span>
                </span>
                <!--end::Title-->
                <!--begin::Arrows-->
                <span class="d-flex flex-column me-n4">
                    <i class="ki-outline ki-down fs-5 text-gray-500"></i>
                </span>
                <!--end::Arrows-->
            </button>
            <!--end::Toggle-->
            <!--begin::Menu-->
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-state-bg menu-rounded w-200px ps-3" data-kt-menu="true">
                <!--begin::Menu wrapper-->
                <div class="hover-scroll-y mh-200px my-3 pe-3 me-n1">
                    <!--begin::Menu item-->
                    <div class="menu-item my-0 py-1">
                        <!--begin::Menu link-->
                        <a href="#" class="menu-link px-3 py-2" data-kt-element="project">
                            <!--begin::Info-->
                            <span class="d-flex flex-column align-items-start">
                                <span class="fs-7 fw-semibold text-primary" data-kt-element="title">Web
                                <span class="text-gray-500">site</span></span>
                            </span>
                            <!--end::Info-->
                        </a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item my-0 py-1">
                        <!--begin::Menu link-->
                        <a href="#" class="menu-link px-3 py-2" data-kt-element="project">
                            <!--begin::Info-->
                            <span class="d-flex flex-column align-items-start">
                                <span class="fs-7 fw-semibold text-primary" data-kt-element="title">Sim
                                <span class="text-gray-500">peg</span></span>
                            </span>
                            <!--end::Info-->
                        </a>
                    </div>
                    <!--end::Menu item-->
                </div>
                <!--end::Menu wrapper-->
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Categories-->
        <div class="position-relative" id="kt_sidebar_secondary_search">
            <div class="d-flex align-items-center position-absolute translate-middle-y top-50 start-0 ms-3">
                <i class="ki-outline ki-magnifier text-gray-600 fs-3"></i>
            </div>
            <input type="text" class="form-control form-control-solid border ps-10" minlength="3" maxlength="4" placeholder="Search Projects..." name="project" />
        </div>
        <div>
            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x d-flex mb-5 fs-6 fw-semibold" id="kt_sidebar_secondary_tabs">
                <li class="nav-item flex-fill">
                    <a class="nav-link text-center text-gray-600 text-active-gray-800 py-2 px-2 mx-0 active" data-bs-toggle="tab" href="#kt_projects_active">Active
                    <span class="text-gray-500">(37)</span></a>
                </li>
                <li class="nav-item flex-fill">
                    <a class="nav-link text-center text-gray-600 text-active-gray-800 py-2 px-2 mx-0" data-bs-toggle="tab" href="#kt_projects_completed">Done
                    <span class="text-gray-500">(37)</span></a>
                </li>
            </ul>
            <div class="hover-scroll-y" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_footer, #kt_sidebar_secondary_search, #kt_sidebar_secondary_project_select, #kt_sidebar_secondary_tabs" data-kt-scroll-wrappers="#kt_sidebar_secondary_wrapper" data-kt-scroll-offset="0px">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="kt_projects_active" role="tabpanel">
                        <div class="d-flex flex-column flex-grow-1 gap-1">
                            <a href="#" class="d-flex align-items-center p-3 gap-2 border border-transparent bg-hover-light-primary border-hover-primary-clarity rounded">
                                <img src="{{ asset('assets/media//stock/600x600/img-29.jpg') }}" class="h-40px rounded" />
                                <div class="d-flex flex-column">
                                    <div class="text-gray-900 fs-6 fw-semibold">Operation Apex</div>
                                    <div class="text-gray-600 fs-7">Due: 02 Jan, 2024</div>
                                </div>
                            </a>
                            <a href="#" class="d-flex align-items-center p-3 gap-2 border border-transparent bg-hover-light-primary border-hover-primary-clarity rounded">
                                <img src="{{ asset('assets/media//stock/600x600/img-87.jpg') }}" class="h-40px rounded" />
                                <div class="d-flex flex-column">
                                    <div class="text-gray-900 fs-6 fw-semibold">Project Nebula</div>
                                    <div class="text-gray-600 fs-7">Due: 19 Feb, 2024</div>
                                </div>
                            </a>
                            <a href="#" class="d-flex align-items-center p-3 gap-2 border border-transparent bg-hover-light-primary border-hover-primary-clarity rounded">
                                <img src="{{ asset('assets/media//stock/600x600/img-26.jpg') }}" class="h-40px rounded" />
                                <div class="d-flex flex-column">
                                    <div class="text-gray-900 fs-6 fw-semibold">Task Infinity</div>
                                    <div class="text-gray-600 fs-7">Due: 16 Mar, 2024</div>
                                </div>
                            </a>
                            <a href="#" class="d-flex align-items-center p-3 gap-2 border border-transparent bg-hover-light-primary border-hover-primary-clarity rounded">
                                <img src="{{ asset('assets/media//stock/600x600/img-32.jpg') }}" class="h-40px rounded" />
                                <div class="d-flex flex-column">
                                    <div class="text-gray-900 fs-6 fw-semibold">Quantum</div>
                                    <div class="text-gray-600 fs-7">Due: 28 May, 2024</div>
                                </div>
                            </a>
                            <a href="#" class="d-flex align-items-center p-3 gap-2 border border-transparent bg-hover-light-primary border-hover-primary-clarity rounded">
                                <img src="{{ asset('assets/media//stock/600x600/img-16.jpg') }}" class="h-40px rounded" />
                                <div class="d-flex flex-column">
                                    <div class="text-gray-900 fs-6 fw-semibold">Phoenix</div>
                                    <div class="text-gray-600 fs-7">Due: 30 May, 2024</div>
                                </div>
                            </a>
                            <a href="#" class="d-flex align-items-center p-3 gap-2 border border-transparent bg-hover-light-primary border-hover-primary-clarity rounded">
                                <img src="{{ asset('assets/media//stock/600x600/img-3.jpg') }}" class="h-40px rounded" />
                                <div class="d-flex flex-column">
                                    <div class="text-gray-900 fs-6 fw-semibold">Task Infinity</div>
                                    <div class="text-gray-600 fs-7">Due: 10 June, 2024</div>
                                </div>
                            </a>
                            <a href="#" class="d-flex align-items-center p-3 gap-2 border border-transparent bg-hover-light-primary border-hover-primary-clarity rounded">
                                <img src="{{ asset('assets/media//stock/600x600/img-36.jpg') }}" class="h-40px rounded" />
                                <div class="d-flex flex-column">
                                    <div class="text-gray-900 fs-6 fw-semibold">Unity Harbor</div>
                                    <div class="text-gray-600 fs-7">Due: 10 Aug, 2024</div>
                                </div>
                            </a>
                            <a href="#" class="d-flex align-items-center p-3 gap-2 border border-transparent bg-hover-light-primary border-hover-primary-clarity rounded">
                                <img src="{{ asset('assets/media//stock/600x600/img-35.jpg') }}" class="h-40px rounded" />
                                <div class="d-flex flex-column">
                                    <div class="text-gray-900 fs-6 fw-semibold">Nexus</div>
                                    <div class="text-gray-600 fs-7">Due: 25 Sep, 2024</div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="kt_projects_completed" role="tabpanel">
                        <div class="d-flex flex-column flex-grow-1 gap-1">
                            <a href="#" class="d-flex align-items-center p-3 gap-2 border border-transparent bg-hover-light-primary border-hover-primary-clarity rounded">
                                <img src="{{ asset('assets/media//stock/600x600/img-10.jpg') }}" class="h-40px rounded" />
                                <div class="d-flex flex-column">
                                    <div class="text-gray-900 fs-6 fw-semibold">Stock App</div>
                                    <div class="text-gray-600 fs-7">Due: 02 Jan, 2024</div>
                                </div>
                            </a>
                            <a href="#" class="d-flex align-items-center p-3 gap-2 border border-transparent bg-hover-light-primary border-hover-primary-clarity rounded">
                                <img src="{{ asset('assets/media//stock/600x600/img-87.jpg') }}" class="h-40px rounded" />
                                <div class="d-flex flex-column">
                                    <div class="text-gray-900 fs-6 fw-semibold">Project Nebula</div>
                                    <div class="text-gray-600 fs-7">Due: 19 Feb, 2024</div>
                                </div>
                            </a>
                            <a href="#" class="d-flex align-items-center p-3 gap-2 border border-transparent bg-hover-light-primary border-hover-primary-clarity rounded">
                                <img src="{{ asset('assets/media//stock/600x600/img-26.jpg') }}" class="h-40px rounded" />
                                <div class="d-flex flex-column">
                                    <div class="text-gray-900 fs-6 fw-semibold">Task Infinity</div>
                                    <div class="text-gray-600 fs-7">Due: 16 Mar, 2024</div>
                                </div>
                            </a>
                            <a href="#" class="d-flex align-items-center p-3 gap-2 border border-transparent bg-hover-light-primary border-hover-primary-clarity rounded">
                                <img src="{{ asset('assets/media//stock/600x600/img-32.jpg') }}" class="h-40px rounded" />
                                <div class="d-flex flex-column">
                                    <div class="text-gray-900 fs-6 fw-semibold">Quantum</div>
                                    <div class="text-gray-600 fs-7">Due: 28 May, 2024</div>
                                </div>
                            </a>
                            <a href="#" class="d-flex align-items-center p-3 gap-2 border border-transparent bg-hover-light-primary border-hover-primary-clarity rounded">
                                <img src="{{ asset('assets/media//stock/600x600/img-16.jpg') }}" class="h-40px rounded" />
                                <div class="d-flex flex-column">
                                    <div class="text-gray-900 fs-6 fw-semibold">Phoenix</div>
                                    <div class="text-gray-600 fs-7">Due: 30 May, 2024</div>
                                </div>
                            </a>
                            <a href="#" class="d-flex align-items-center p-3 gap-2 border border-transparent bg-hover-light-primary border-hover-primary-clarity rounded">
                                <img src="{{ asset('assets/media//stock/600x600/img-38.jpg') }}" class="h-40px rounded" />
                                <div class="d-flex flex-column">
                                    <div class="text-gray-900 fs-6 fw-semibold">UI/UX Rewamp</div>
                                    <div class="text-gray-600 fs-7">Due: 25 Sep, 2024</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

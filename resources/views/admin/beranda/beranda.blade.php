@extends('admin.index')
@section('title', 'Beranda')
@section('menu-dashboard', 'active')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row g-6">
        <div class="col-md-12 col-xxl-12">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-md-6 order-2 order-md-1">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Selamat Datang <span class="fw-bold">{{ Auth::user()->nama
                                    }}</span></h4>
                            <p class="mb-0">Apa yang akan kamu lakukan hari ini? 😎 </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activity Timeline -->
        <div class="col-6 col-xxl-4">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h5 class="mb-0">Activity Today</h5>
                    </div>
                </div>
                <div class="card-body pt-4">
                    <ul class="timeline card-timeline mb-0">
                        @foreach ($recents as $recent)
                        <li class="timeline-item timeline-item-transparent">
                            <span class="timeline-point timeline-point-secondary"></span>
                            <div class="timeline-event">
                                <div class="timeline-header mb-3">
                                    <h6 class="mb-0">{{ GetUser($recent->user_id) }}</h6>
                                    <small class="text-body-secondary">{{ RangeTime($recent->created_at) }}</small>
                                </div>
                                <p class="mb-2">{{ $recent->activity }}</p>
                            </div>
                        </li>
                        @endforeach
                        @if ($recents->isEmpty())
                        <p class="text-muted" style="text-align:center;">Tidak Ada Aktivitas</p>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <!-- Activity Timeline -->

        <!-- Performance Chart -->
        {{-- <div class="col-12 col-xxl-4 col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h5 class="mb-1">Performance</h5>
                        <div class="dropdown">
                            <button class="btn btn-text-secondary rounded-pill text-body-secondary border-0 p-1"
                                type="button" id="performanceDropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="icon-base ri ri-more-2-line"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="performanceDropdown">
                                <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="performanceChart"></div>
                </div>
            </div>
        </div> --}}
        <!--/ Performance Chart -->

        <!-- Project Statistics -->
        <div class="col-md-6 col-xxl-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">Berita & Postingan</h5>
                    <div class="dropdown">
                        <button class="btn btn-text-secondary rounded-pill text-body-secondary border-0 p-1"
                            type="button" id="projectStatus" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="icon-base ri ri-more-2-line"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="projectStatus">
                            <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                            <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                            <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between p-4 border-bottom"></div>
                <div class="card-body">
                    <ul class="p-0 m-0">
                        @foreach ($posts as $berita)
                        <li class="d-flex align-items-center mb-6">
                            <div class="avatar avatar-md flex-shrink-0 me-4">
                                <div class="avatar-initial bg-lightest rounded-3">
                                    <div>
                                        <img src="{{ $berita->foto_berita }}" alt="{{ $berita->title }}" class="h-25" />
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-1">
                                        <a class="text-black fw-bold"
                                            href="{{ route('post.show', [GetCategoryContent($berita->posts_category_id), $berita->slug]) }}">
                                            {{ substr($berita->title, 0, 50) }}...
                                        </a>
                                    </h6>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <!--/ Project Statistics -->

        <!-- Multiple widgets -->
        <div class="col-md-6 col-xxl-4">
            <div class="row g-4">
                <!-- Total Revenue chart -->
                <div class="col-md-6 col-sm-6">
                    <div class="card h-100">
                        <div class="card-header pb-xl-8">
                            <div class="d-flex align-items-center mb-1 flex-wrap">
                                <h5 class="mb-0 me-1">{{ $post }}</h5>
                            </div>
                            <span class="d-block card-subtitle">Total Posting</span>
                        </div>
                        <div class="card-body">
                            <div id="totalRevenue"></div>
                        </div>
                    </div>
                </div>
                <!--/ Total Revenue chart -->

                <div class="col-md-6 col-sm-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                                <div class="avatar">
                                    <div class="avatar-initial bg-label-warning rounded-3">
                                        <i class="icon-base ri ri-alarm-warning-fill icon-24px"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="card-info mt-5 mt-xl-8">
                                <h5 class="mb-1">{{ $laporan }}</h5>
                                <p>Total Laporan</p>
                                <div class="badge bg-label-secondary rounded-pill">Laporan</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                                <div class="avatar">
                                    <div class="avatar-initial bg-label-info rounded-3">
                                        <i class="icon-base ri ri-links-line icon-24px"></i>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <p class="mb-0 text-success me-1">+62%</p>
                                    <i class="icon-base ri ri-arrow-up-s-line text-success"></i>
                                </div>
                            </div>
                            <div class="card-info mt-5 mt-xl-8">
                                <h5 class="mb-1">142.8k</h5>
                                <p>Total Impression</p>
                                <div class="badge bg-label-secondary rounded-pill">Last One Year</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- overview Radial chart -->
                <div class="col-md-6 col-sm-6">
                    <div class="card h-100">
                        <div class="card-header pb-xl-7">
                            <div class="d-flex align-items-center mb-1 flex-wrap">
                                <h5 class="mb-0 me-1">$67.1k</h5>
                                <p class="mb-0 text-success">+49%</p>
                            </div>
                            <span class="d-block card-subtitle">Overview</span>
                        </div>
                        <div class="card-body pb-xl-8">
                            <div id="overviewChart" class="d-flex align-items-center"></div>
                        </div>
                    </div>
                </div>
                <!--/ overview Radial chart -->
            </div>
        </div>
        <!--/ Multiple widgets -->

        <!-- Sales Country Chart -->
        <div class="col-12 col-xxl-4 col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h5 class="mb-1">Sales Country</h5>
                        <div class="dropdown">
                            <button class="btn btn-text-secondary rounded-pill text-body-secondary border-0 p-1"
                                type="button" id="salesCountryDropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="icon-base ri ri-more-2-line"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="salesCountryDropdown">
                                <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                            </div>
                        </div>
                    </div>
                    <p class="mb-0 card-subtitle">Total $42,580 Sales</p>
                </div>
                <div class="card-body pb-1 px-0">
                    <div id="salesCountryChart"></div>
                </div>
            </div>
        </div>
        <!--/ Sales Country Chart -->

        <!-- Top Referral Source  -->
        <div class="col-12 col-xxl-8">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <h5 class="card-title mb-1">Top Referral Sources</h5>
                        <p class="card-subtitle mb-0">Number of Sales</p>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-text-secondary rounded-pill text-body-secondary border-0 p-1"
                            type="button" id="earningReportsTabsId" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="icon-base ri ri-more-2-line"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="earningReportsTabsId">
                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                        </div>
                    </div>
                </div>
                <div class="card-body pb-0">
                    <ul class="nav nav-tabs nav-tabs-widget pb-6 gap-4 mx-1 d-flex flex-nowrap" role="tablist">
                        <li class="nav-item">
                            <a href="javascript:void(0);"
                                class="nav-link btn active d-flex flex-column align-items-center justify-content-center"
                                role="tab" data-bs-toggle="tab" data-bs-target="#navs-orders-id"
                                aria-controls="navs-orders-id" aria-selected="true">
                                <div class="avatar avatar-sm">
                                    <img src="../../assets/img/icons/brands/google.png" alt="User" />
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0);"
                                class="nav-link btn d-flex flex-column align-items-center justify-content-center"
                                role="tab" data-bs-toggle="tab" data-bs-target="#navs-sales-id"
                                aria-controls="navs-sales-id" aria-selected="false">
                                <div class="avatar avatar-sm">
                                    <img src="../../assets/img/icons/brands/facebook-rounded.png" alt="User" />
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0);"
                                class="nav-link btn d-flex flex-column align-items-center justify-content-center"
                                role="tab" data-bs-toggle="tab" data-bs-target="#navs-profit-id"
                                aria-controls="navs-profit-id" aria-selected="false">
                                <div class="avatar avatar-sm">
                                    <img src="../../assets/img/icons/brands/instagram-rounded.png" alt="User" />
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0);"
                                class="nav-link btn d-flex flex-column align-items-center justify-content-center"
                                role="tab" data-bs-toggle="tab" data-bs-target="#navs-income-id"
                                aria-controls="navs-income-id" aria-selected="false">
                                <div class="avatar avatar-sm">
                                    <img src="../../assets/img/icons/brands/reddit-rounded.png" alt="User" />
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0);"
                                class="nav-link btn d-flex align-items-center justify-content-center disabled"
                                role="tab" data-bs-toggle="tab" aria-selected="false">
                                <div class="avatar avatar-sm">
                                    <div class="avatar-initial bg-label-secondary text-body rounded">
                                        <i class="icon-base ri ri-add-line icon-22px"></i>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content p-0">
                    <div class="tab-pane fade show active" id="navs-orders-id" role="tabpanel">
                        <div class="table-responsive text-nowrap">
                            <table class="table border-top">
                                <thead>
                                    <tr>
                                        <th class="bg-transparent border-bottom">Product Name</th>
                                        <th class="bg-transparent border-bottom">STATUS</th>
                                        <th class="text-end bg-transparent border-bottom">Profit</th>
                                        <th class="text-end bg-transparent border-bottom">REVENUE</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td>Email Marketing Campaign</td>
                                        <td>
                                            <div class="badge bg-label-primary rounded-pill">Active</div>
                                        </td>
                                        <td class="text-success fw-medium text-end">+24%</td>
                                        <td class="text-end fw-medium">$42,857</td>
                                    </tr>
                                    <tr>
                                        <td>Google Workspace</td>
                                        <td>
                                            <div class="badge bg-label-success rounded-pill">Completed</div>
                                        </td>
                                        <td class="text-danger fw-medium text-end">-12%</td>
                                        <td class="text-end fw-medium">$850</td>
                                    </tr>
                                    <tr>
                                        <td>Affiliation Program</td>
                                        <td>
                                            <div class="badge bg-label-primary rounded-pill">Active</div>
                                        </td>
                                        <td class="text-success fw-medium text-end">+24%</td>
                                        <td class="text-end fw-medium">$5,576</td>
                                    </tr>
                                    <tr>
                                        <td>Google Adsense</td>
                                        <td>
                                            <div class="badge bg-label-info rounded-pill">In Draft</div>
                                        </td>
                                        <td class="text-success fw-medium text-end">+0%</td>
                                        <td class="text-end fw-medium">0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-sales-id" role="tabpanel">
                        <div class="table-responsive text-nowrap">
                            <table class="table border-top">
                                <thead>
                                    <tr>
                                        <th class="bg-transparent border-bottom">Product Name</th>
                                        <th class="bg-transparent border-bottom">STATUS</th>
                                        <th class="text-end bg-transparent border-bottom">Profit</th>
                                        <th class="text-end bg-transparent border-bottom">REVENUE</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td>facebook Adsense</td>
                                        <td>
                                            <div class="badge bg-label-info rounded-pill">In Draft</div>
                                        </td>
                                        <td class="text-success fw-medium text-end">+5%</td>
                                        <td class="text-end fw-medium">$5</td>
                                    </tr>
                                    <tr>
                                        <td>Affiliation Program</td>
                                        <td>
                                            <div class="badge bg-label-primary rounded-pill">Active</div>
                                        </td>
                                        <td class="text-danger fw-medium text-end">-24%</td>
                                        <td class="text-end fw-medium">$5,576</td>
                                    </tr>
                                    <tr>
                                        <td>Email Marketing Campaign</td>
                                        <td>
                                            <div class="badge bg-label-warning rounded-pill">warning</div>
                                        </td>
                                        <td class="text-success fw-medium text-end">+5%</td>
                                        <td class="text-end fw-medium">$2,857</td>
                                    </tr>
                                    <tr>
                                        <td>facebook Workspace</td>
                                        <td>
                                            <div class="badge bg-label-success rounded-pill">Completed</div>
                                        </td>
                                        <td class="text-danger fw-medium text-end">-12%</td>
                                        <td class="text-end fw-medium">$850</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-profit-id" role="tabpanel">
                        <div class="table-responsive text-nowrap">
                            <table class="table border-top">
                                <thead>
                                    <tr>
                                        <th class="bg-transparent border-bottom">Product Name</th>
                                        <th class="bg-transparent border-bottom">STATUS</th>
                                        <th class="text-end bg-transparent border-bottom">Profit</th>
                                        <th class="text-end bg-transparent border-bottom">REVENUE</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td>Affiliation Program</td>
                                        <td>
                                            <div class="badge bg-label-primary rounded-pill">Active</div>
                                        </td>
                                        <td class="text-danger fw-medium text-end">-24%</td>
                                        <td class="text-end fw-medium">$5,576</td>
                                    </tr>
                                    <tr>
                                        <td>instagram Adsense</td>
                                        <td>
                                            <div class="badge bg-label-info rounded-pill">In Draft</div>
                                        </td>
                                        <td class="text-success fw-medium text-end">+5%</td>
                                        <td class="text-end fw-medium">$5</td>
                                    </tr>
                                    <tr>
                                        <td>instagram Workspace</td>
                                        <td>
                                            <div class="badge bg-label-success rounded-pill">Completed</div>
                                        </td>
                                        <td class="text-danger fw-medium text-end">-12%</td>
                                        <td class="text-end fw-medium">$850</td>
                                    </tr>
                                    <tr>
                                        <td>Email Marketing Campaign</td>
                                        <td>
                                            <div class="badge bg-label-danger rounded-pill">warning</div>
                                        </td>
                                        <td class="text-danger fw-medium text-end">-5%</td>
                                        <td class="text-end fw-medium">$857</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-income-id" role="tabpanel">
                        <div class="table-responsive text-nowrap">
                            <table class="table border-top">
                                <thead>
                                    <tr>
                                        <th class="bg-transparent border-bottom">Product Name</th>
                                        <th class="bg-transparent border-bottom">STATUS</th>
                                        <th class="text-end bg-transparent border-bottom">Profit</th>
                                        <th class="text-end bg-transparent border-bottom">REVENUE</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td>reddit Workspace</td>
                                        <td>
                                            <div class="badge bg-label-warning rounded-pill">process</div>
                                        </td>
                                        <td class="text-danger fw-medium text-end">-12%</td>
                                        <td class="text-end fw-medium">$850</td>
                                    </tr>
                                    <tr>
                                        <td>Affiliation Program</td>
                                        <td>
                                            <div class="badge bg-label-primary rounded-pill">Active</div>
                                        </td>
                                        <td class="text-danger fw-medium text-end">-24%</td>
                                        <td class="text-end fw-medium">$5,576</td>
                                    </tr>
                                    <tr>
                                        <td>reddit Adsense</td>
                                        <td>
                                            <div class="badge bg-label-info rounded-pill">In Draft</div>
                                        </td>
                                        <td class="text-success fw-medium text-end">+5%</td>
                                        <td class="text-end fw-medium">$5</td>
                                    </tr>
                                    <tr>
                                        <td>Email Marketing Campaign</td>
                                        <td>
                                            <div class="badge bg-label-success rounded-pill">Completed</div>
                                        </td>
                                        <td class="text-success fw-medium text-end">+50%</td>
                                        <td class="text-end fw-medium">$857</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Top Referral Source  -->

    </div>
</div>
<!-- / Content -->

<div class="content-backdrop fade"></div>
@endsection

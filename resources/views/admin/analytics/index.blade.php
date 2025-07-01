@extends('admin.index')
@section('title', 'Statistik Website')
@section('styles')
    <link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('server/assets/vendor/css/pages/cards-statistics.css') }}" />
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row gy-6">
            <h4 class="mb-0">Statistik Website</h4>
            <!-- visits By Day Chart-->
            <div class="col-12 col-xl-4 col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-1">Pengunjung Harian</h5>
                            <div class="dropdown">
                                <button class="btn btn-text-secondary rounded-pill text-body-secondary border-0 p-1"
                                    type="button" id="visitsByDayDropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="icon-base ri ri-more-2-line"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="visitsByDayDropdown">
                                    <a class="dropdown-item range-selector" data-range="7days" href="javascript:void(0);">7
                                        Hari Terakhir</a>
                                    <a class="dropdown-item range-selector" data-range="28days"
                                        href="javascript:void(0);">28 Hari Terakhir</a>
                                    <a class="dropdown-item range-selector" data-range="lastmonth"
                                        href="javascript:void(0);">Bulan Lalu</a>
                                    <a class="dropdown-item range-selector" data-range="lastyear"
                                        href="javascript:void(0);">Tahun Lalu</a>
                                </div>
                            </div>
                        </div>
                        <p class="mb-0 card-subtitle total-visit-value">Loading...</p>

                    </div>
                    <div class="card-body pt-xl-5">
                        <div id="visitsByDayChart"></div>
                        <div class="d-flex justify-content-between mt-6">
                            <div>
                                <h6 class="mb-0">Pengunjung Terbanyak dalam 1 hari</h6>
                                <p class="mb-0 small most-visited-day">Loading...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ visits By Day Chart-->

            <!-- Asal Pengunjung -->
            <div class="col-12 col-xl-8 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-1">Asal Pengunjung</h5>
                        </div>
                        <p class="mb-0 card-subtitle total-visitor">Total 0 Visitor</p>
                    </div>
                    <div class="card-body pb-1 px-0">
                        <div id="salesCountryChart"></div>
                    </div>
                </div>
            </div>
            <!--/ Asal Pengunjung -->

            <!-- Top Page View -->
            <div class="col-12 col-lg-8 col-xl-8">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Halaman Paling Banyak Dikunjungi</h5>
                    </div>
                    <div class="card-body row g-3">
                        <div class="col-md-6">
                            <div id="horizontalBarChart"></div>
                        </div>
                        <div class="col-md-6 d-flex justify-content-around align-items-center">
                            {{-- di isi di javascripts --}}
                        </div>
                    </div>
                </div>
            </div>
            <!--  Top Page View  End-->

            <!-- Top Browser & Devices-->
            <div class="col-12 col-xl-4">
                <div class="card h-100">
                    <div class="row">
                        <div class="col-md-6 col-12 border-start">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-1">Top Browser</h5>
                                </div>
                                <p class="mb-0 card-subtitle" id="browserSubtitle">Memuat data...</p>
                            </div>
                            <div class="card-body pt-4" id="browserList">
                                {{-- di isi di javascripts --}}
                            </div>
                        </div>
                        <div class="col-md-6 col-12 border-start">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-1">Top Device</h5>
                                </div>
                                <p class="mb-0 card-subtitle" id="deviceSubtitle">Memuat data...</p>
                            </div>
                            <div class="card-body pt-4" id="deviceList">
                                {{-- di isi di javascript --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Top Browser & Devices-->
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('server/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('server/assets/js/google-analytics.js') }}"></script>
@endsection

@extends('admin.index')
@section('title', 'Statistik Website')
@section('styles')
    <link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('server/assets/vendor/css/pages/cards-statistics.css') }}" />
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">Analisa Web BPKAD</h4>
                </div>
            </div>
            <div class="card-datatable table-responsive text-nowrap">
                <div class="row">
                    <div class="col-12">
                        <div class="row p-5">
                            <div class="fw-bold fs-3 text-center mb-4 text-hover-primary">Pengunjung dan Halaman
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">No.</th>
                                        <th style="width: 65%">Page</th>
                                        <th style="width: 15%">Active Users</th>
                                        <th style="width: 15%">Page views</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($visitorsAndPageViews as $key => $data)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $data['pageTitle'] }}</td>
                                            <td>{{ number_format($data['activeUsers'], 0, ',', '.') }}</td>
                                            <td>{{ number_format($data['screenPageViews'], 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12">
                            <div class="row p-5">
                                <div class="fw-bold fs-3 text-center mb-4 text-hover-primary">Pengunjung Harian
                                </div>
                                <p class="mb-0 text-center total-visit-value">Loading...</p>
                                <div id="visitsByDayChart"></div>
                                <div class="d-flex justify-content-between mt-6">
                                    <div>
                                        <h6 class="mb-0">Pengunjung Terbanyak dalam 1 hari</h6>
                                        <p class="mb-0 small most-visited-day">Loading...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2 class="card-label">
                                        Most Visited Pages
                                    </h2>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">No.</th>
                                                <th style="width: 45%">Page</th>
                                                <th style="width: 35%">URL</th>
                                                <th style="width: 15%">Page views</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($mostVisitedPages as $key => $data)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $data['pageTitle'] }}</td>
                                                    <td>{{ $data['fullPageUrl'] }}</td>
                                                    <td>{{ number_format($data['screenPageViews'], 0, ',', '.') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2 class="card-label">
                                        Top Referrers
                                    </h2>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">No.</th>
                                                <th style="width: 65%">Page Referrer</th>
                                                <th style="width: 30%">Page views</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($topReferrers as $key => $data)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $data['pageReferrer'] }}</td>
                                                    <td>{{ number_format($data['screenPageViews'], 0, ',', '.') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2 class="card-label">
                                        User Types
                                    </h2>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">No.</th>
                                                <th style="width: 65%">Type</th>
                                                <th style="width: 30%">Active Users</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($userTypes as $key => $data)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $data['newVsReturning'] }}</td>
                                                    <td>{{ number_format($data['activeUsers'], 0, ',', '.') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2 class="card-label">
                                        Top Browsers
                                    </h2>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">No.</th>
                                                <th style="width: 65%">Browser</th>
                                                <th style="width: 30%">Page Views</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($topBrowsers as $key => $data)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $data['browser'] }}</td>
                                                    <td>{{ number_format($data['screenPageViews'], 0, ',', '.') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('server/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('server/assets/js/google-analytics.js') }}"></script>
@endsection

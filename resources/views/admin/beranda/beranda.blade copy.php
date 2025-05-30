@extends('admin.index')
@section('title', 'Beranda')
@section('menu-dashboard', 'active')
@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Post <span>| Bulan Ini</span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-file-earmark-post"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $post }}</h6>
                                        {{-- <span class="text-success small pt-1 fw-bold">0%</span> --}}
                                        <span class="text-muted small pt-2 ps-1">Postingan</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card customers-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Laporan <span>| Bulan Ini</span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-info-square-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $laporan }}</h6>
                                        <span class="text-success small pt-1 fw-bold">0%</span> <span
                                            class="text-muted small pt-2 ps-1">Laporan</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-12">

                        <div class="card info-card revenue-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Permohonan <span>| Bulan Ini</span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-journal-text"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $permohonan }}</h6>
                                        <span class="text-danger small pt-1 fw-bold">0%</span> <span
                                            class="text-muted small pt-2 ps-1">Permohonan</span>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div><!-- End Customers Card -->

                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Postingan <span>/Triwulan</span></h5>

                                <!-- Line Chart -->
                                <div id="reportsChart"></div>
                                @php
                                $_post = _PostMonth(date('Y-m'));
                                $data = implode(',', $_post);
                                $month1 = NameMonth(date('m'));
                                $month2 = NameMonth(date('m') - 1);
                                $month3 = NameMonth(date('m') - 2);
                                @endphp

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                            new ApexCharts(document.querySelector("#reportsChart"), {
                                                series: [{
                                                    name: 'Postingan',
                                                    data: [
                                                        {{ $data }}
                                                    ],
                                                }],
                                                chart: {
                                                    height: 350,
                                                    type: 'area',
                                                    toolbar: {
                                                        show: false
                                                    },
                                                },
                                                markers: {
                                                    size: 4
                                                },
                                                colors: ['#4154f1'],
                                                fill: {
                                                    type: "gradient",
                                                    gradient: {
                                                        shadeIntensity: 1,
                                                        opacityFrom: 0.3,
                                                        opacityTo: 0.4,
                                                        stops: [0, 90, 100]
                                                    }
                                                },
                                                dataLabels: {
                                                    enabled: false
                                                },
                                                stroke: {
                                                    curve: 'smooth',
                                                    width: 2
                                                },
                                                xaxis: {
                                                    type: 'years',
                                                    categories: ["{{ $month1 }}", "{{ $month2 }}", "{{ $month3 }}"]
                                                },
                                                tooltip: {
                                                    x: {
                                                        format: 'dd/MM/yy HH:mm'
                                                    },
                                                }
                                            }).render();
                                        });
                                </script>
                                <!-- End Line Chart -->

                            </div>

                        </div>
                    </div><!-- End Reports -->

                    <!-- Top Selling -->
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body pb-0">
                                <h5 class="card-title">Laporan <span>| Bulan</span></h5>

                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">Kode Laporan</th>
                                            <th scope="col">Laporan</th>
                                            <th scope="col">Nama Pelapor</th>
                                            <th scope="col">Jawaban</th>
                                            <th scope="col">Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lap as $report)
                                        <tr>
                                            <td scope="row"><a href="#">{{ $report->kode_laporan }}</a>
                                            </td>
                                            <td>{{ $report->judul_laporan }}</td>
                                            <td>{{ $report->nama_pelapor }}</td>
                                            <td class="fw-bold">
                                                {{ $report->jawaban_dari != null ? 'Terjawab' : '-' }}</td>
                                            <td>{{ GetDate($report->created_at) }}</td>
                                        </tr>
                                        @endforeach
                                        @if ($lap->isEmpty())
                                        <tr>
                                            <td colspan="5" style="text-align: center;">Tidak Ada Catatan
                                                Laporan</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Top Selling -->

                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">

                <!-- Recent Activity -->
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Aktivitas <span>| Hari Ini</span></h5>

                        <div class="activity">
                            @foreach ($recents as $recent)
                            <div class="activity-item d-flex">
                                <div class="activite-label">{{ RangeTime($recent->created_at) }}</div>
                                @if ($recent->jenis == 'post')
                                @php $badge = 'primary' @endphp
                                @elseif ($recent->jenis == 'users')
                                @php $badge = 'info' @endphp
                                @elseif ($recent->jenis == 'slider')
                                @php $badge = 'dark' @endphp
                                @elseif ($recent->jenis == 'slider')
                                @php $badge = 'warning' @endphp
                                @elseif ($recent->jenis == 'galery')
                                @php $badge = 'secondary' @endphp
                                @elseif ($recent->jenis == 'pages')
                                @php $badge = 'success' @endphp
                                @elseif ($recent->jenis == 'sub_pages')
                                @php $badge = 'secondary' @endphp
                                @elseif ($recent->jenis == 'ppid_struktur')
                                @php $badge = 'info' @endphp
                                @elseif ($recent->jenis == 'pegawai')
                                @php $badge = 'success' @endphp
                                @elseif ($recent->jenis == 'kip')
                                @php $badge = 'info' @endphp
                                @endif
                                <i class='bi bi-circle-fill activity-badge text-{{ $badge }} align-self-start'></i>
                                <div class="activity-content">
                                    <strong>{{ GetUser($recent->user_id) }}</strong>
                                    {{ $recent->activity }} <a href="#" class="fw-bold text-dark">{{
                                        _recentShow($recent->jenis, $recent->uuid_activity) }}</a>
                                </div>
                            </div><!-- End activity item-->
                            @endforeach
                            @if ($recents->isEmpty())
                            <p class="title" style="text-align:center;">Tidak Ada Aktivitas</p>
                            @endif

                        </div>

                    </div>
                </div><!-- End Recent Activity -->

                <!-- News & Updates Traffic -->
                <div class="card">

                    <div class="card-body pb-0">
                        <h5 class="card-title">News &amp; Post</h5>

                        <div class="news">
                            @foreach ($posts as $berita)
                            <div class="post-item clearfix">
                                <img src="{{ $berita->foto_berita }}" alt="">
                                <h4><a href="{{ route('post.show', [GetCategoryContent($berita->posts_category_id), $berita->slug]) }}"
                                        target="_blank">{{ substr($berita->title, 0, 50) }}...Selengkapnya</a>
                                </h4>
                                <p>{{ get_date($berita->created_at) }}</p>
                            </div>
                            @endforeach

                        </div><!-- End sidebar recent posts-->

                    </div>
                </div><!-- End News & Updates -->

            </div><!-- End Right side columns -->

        </div>
    </section>
</main>
@endsection
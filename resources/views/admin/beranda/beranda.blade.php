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
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
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
                                <h5 class="card-title">Sales <span>| Today</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>145</h6>
                                        <span class="text-success small pt-1 fw-bold">12%</span> <span
                                            class="text-muted small pt-2 ps-1">increase</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
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
                                <h5 class="card-title">Revenue <span>| This Month</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>$3,264</h6>
                                        <span class="text-success small pt-1 fw-bold">8%</span> <span
                                            class="text-muted small pt-2 ps-1">increase</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-12">

                        <div class="card info-card customers-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
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
                                <h5 class="card-title">Customers <span>| This Year</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>1244</h6>
                                        <span class="text-danger small pt-1 fw-bold">12%</span> <span
                                            class="text-muted small pt-2 ps-1">decrease</span>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div><!-- End Customers Card -->

                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
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
                                <h5 class="card-title">Reports <span>/Today</span></h5>

                                <!-- Line Chart -->
                                <div id="reportsChart"></div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#reportsChart"), {
                                            series: [{
                                                name: 'Sales',
                                                data: [31, 40, 28, 51, 42, 82, 56],
                                            }, {
                                                name: 'Revenue',
                                                data: [11, 32, 45, 32, 34, 52, 41]
                                            }, {
                                                name: 'Customers',
                                                data: [15, 11, 32, 18, 9, 24, 11]
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
                                            colors: ['#4154f1', '#2eca6a', '#ff771d'],
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
                                                type: 'datetime',
                                                categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z",
                                                    "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z",
                                                    "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z",
                                                    "2018-09-19T06:30:00.000Z"
                                                ]
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

                    <!-- Recent Sales -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
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
                                <h5 class="card-title">Recent Sales <span>| Today</span></h5>

                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Customer</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row"><a href="#">#2457</a></th>
                                            <td>Brandon Jacob</td>
                                            <td><a href="#" class="text-primary">At praesentium minu</a></td>
                                            <td>$64</td>
                                            <td><span class="badge bg-success">Approved</span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><a href="#">#2147</a></th>
                                            <td>Bridie Kessler</td>
                                            <td><a href="#" class="text-primary">Blanditiis dolor omnis
                                                    similique</a></td>
                                            <td>$47</td>
                                            <td><span class="badge bg-warning">Pending</span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><a href="#">#2049</a></th>
                                            <td>Ashleigh Langosh</td>
                                            <td><a href="#" class="text-primary">At recusandae consectetur</a></td>
                                            <td>$147</td>
                                            <td><span class="badge bg-success">Approved</span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><a href="#">#2644</a></th>
                                            <td>Angus Grady</td>
                                            <td><a href="#" class="text-primar">Ut voluptatem id earum et</a></td>
                                            <td>$67</td>
                                            <td><span class="badge bg-danger">Rejected</span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><a href="#">#2644</a></th>
                                            <td>Raheem Lehner</td>
                                            <td><a href="#" class="text-primary">Sunt similique distinctio</a></td>
                                            <td>$165</td>
                                            <td><span class="badge bg-success">Approved</span></td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Recent Sales -->

                    <!-- Top Selling -->
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
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
                                <h5 class="card-title">Top Selling <span>| Today</span></h5>

                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">Preview</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Sold</th>
                                            <th scope="col">Revenue</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row"><a href="#"><img src="assets/img/product-1.jpg"
                                                        alt=""></a></th>
                                            <td><a href="#" class="text-primary fw-bold">Ut inventore ipsa voluptas
                                                    nulla</a></td>
                                            <td>$64</td>
                                            <td class="fw-bold">124</td>
                                            <td>$5,828</td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><a href="#"><img src="assets/img/product-2.jpg"
                                                        alt=""></a></th>
                                            <td><a href="#" class="text-primary fw-bold">Exercitationem similique
                                                    doloremque</a></td>
                                            <td>$46</td>
                                            <td class="fw-bold">98</td>
                                            <td>$4,508</td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><a href="#"><img src="assets/img/product-3.jpg"
                                                        alt=""></a></th>
                                            <td><a href="#" class="text-primary fw-bold">Doloribus nisi
                                                    exercitationem</a></td>
                                            <td>$59</td>
                                            <td class="fw-bold">74</td>
                                            <td>$4,366</td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><a href="#"><img src="assets/img/product-4.jpg"
                                                        alt=""></a></th>
                                            <td><a href="#" class="text-primary fw-bold">Officiis quaerat sint rerum
                                                    error</a></td>
                                            <td>$32</td>
                                            <td class="fw-bold">63</td>
                                            <td>$2,016</td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><a href="#"><img src="assets/img/product-5.jpg"
                                                        alt=""></a></th>
                                            <td><a href="#" class="text-primary fw-bold">Sit unde debitis delectus
                                                    repellendus</a></td>
                                            <td>$79</td>
                                            <td class="fw-bold">41</td>
                                            <td>$3,239</td>
                                        </tr>
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
                        <h5 class="card-title">Recent Activity <span>| Today</span></h5>

                        <div class="activity">

                            <div class="activity-item d-flex">
                                <div class="activite-label">32 min</div>
                                <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                <div class="activity-content">
                                    Quia quae rerum <a href="#" class="fw-bold text-dark">explicabo officiis</a>
                                    beatae
                                </div>
                            </div><!-- End activity item-->

                            <div class="activity-item d-flex">
                                <div class="activite-label">56 min</div>
                                <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                                <div class="activity-content">
                                    Voluptatem blanditiis blanditiis eveniet
                                </div>
                            </div><!-- End activity item-->

                            <div class="activity-item d-flex">
                                <div class="activite-label">2 hrs</div>
                                <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                                <div class="activity-content">
                                    Voluptates corrupti molestias voluptatem
                                </div>
                            </div><!-- End activity item-->

                            <div class="activity-item d-flex">
                                <div class="activite-label">1 day</div>
                                <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
                                <div class="activity-content">
                                    Tempore autem saepe <a href="#" class="fw-bold text-dark">occaecati
                                        voluptatem</a> tempore
                                </div>
                            </div><!-- End activity item-->

                            <div class="activity-item d-flex">
                                <div class="activite-label">2 days</div>
                                <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
                                <div class="activity-content">
                                    Est sit eum reiciendis exercitationem
                                </div>
                            </div><!-- End activity item-->

                            <div class="activity-item d-flex">
                                <div class="activite-label">4 weeks</div>
                                <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
                                <div class="activity-content">
                                    Dicta dolorem harum nulla eius. Ut quidem quidem sit quas
                                </div>
                            </div><!-- End activity item-->

                        </div>

                    </div>
                </div><!-- End Recent Activity -->

                <!-- Budget Report -->
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

                    <div class="card-body pb-0">
                        <h5 class="card-title">Budget Report <span>| This Month</span></h5>

                        <div id="budgetChart" style="min-height: 400px;" class="echart"></div>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({
                                    legend: {
                                        data: ['Allocated Budget', 'Actual Spending']
                                    },
                                    radar: {
                                        // shape: 'circle',
                                        indicator: [{
                                                name: 'Sales',
                                                max: 6500
                                            },
                                            {
                                                name: 'Administration',
                                                max: 16000
                                            },
                                            {
                                                name: 'Information Technology',
                                                max: 30000
                                            },
                                            {
                                                name: 'Customer Support',
                                                max: 38000
                                            },
                                            {
                                                name: 'Development',
                                                max: 52000
                                            },
                                            {
                                                name: 'Marketing',
                                                max: 25000
                                            }
                                        ]
                                    },
                                    series: [{
                                        name: 'Budget vs spending',
                                        type: 'radar',
                                        data: [{
                                                value: [4200, 3000, 20000, 35000, 50000, 18000],
                                                name: 'Allocated Budget'
                                            },
                                            {
                                                value: [5000, 14000, 28000, 26000, 42000, 21000],
                                                name: 'Actual Spending'
                                            }
                                        ]
                                    }]
                                });
                            });
                        </script>

                    </div>
                </div><!-- End Budget Report -->

                <!-- Website Traffic -->
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

                    <div class="card-body pb-0">
                        <h5 class="card-title">Website Traffic <span>| Today</span></h5>

                        <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                echarts.init(document.querySelector("#trafficChart")).setOption({
                                    tooltip: {
                                        trigger: 'item'
                                    },
                                    legend: {
                                        top: '5%',
                                        left: 'center'
                                    },
                                    series: [{
                                        name: 'Access From',
                                        type: 'pie',
                                        radius: ['40%', '70%'],
                                        avoidLabelOverlap: false,
                                        label: {
                                            show: false,
                                            position: 'center'
                                        },
                                        emphasis: {
                                            label: {
                                                show: true,
                                                fontSize: '18',
                                                fontWeight: 'bold'
                                            }
                                        },
                                        labelLine: {
                                            show: false
                                        },
                                        data: [{
                                                value: 1048,
                                                name: 'Search Engine'
                                            },
                                            {
                                                value: 735,
                                                name: 'Direct'
                                            },
                                            {
                                                value: 580,
                                                name: 'Email'
                                            },
                                            {
                                                value: 484,
                                                name: 'Union Ads'
                                            },
                                            {
                                                value: 300,
                                                name: 'Video Ads'
                                            }
                                        ]
                                    }]
                                });
                            });
                        </script>

                    </div>
                </div><!-- End Website Traffic -->

                <!-- News & Updates Traffic -->
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

                    <div class="card-body pb-0">
                        <h5 class="card-title">News &amp; Updates <span>| Today</span></h5>

                        <div class="news">
                            <div class="post-item clearfix">
                                <img src="assets/img/news-1.jpg" alt="">
                                <h4><a href="#">Nihil blanditiis at in nihil autem</a></h4>
                                <p>Sit recusandae non aspernatur laboriosam. Quia enim eligendi sed ut harum...</p>
                            </div>

                            <div class="post-item clearfix">
                                <img src="assets/img/news-2.jpg" alt="">
                                <h4><a href="#">Quidem autem et impedit</a></h4>
                                <p>Illo nemo neque maiores vitae officiis cum eum turos elan dries werona nande...</p>
                            </div>

                            <div class="post-item clearfix">
                                <img src="assets/img/news-3.jpg" alt="">
                                <h4><a href="#">Id quia et et ut maxime similique occaecati ut</a></h4>
                                <p>Fugiat voluptas vero eaque accusantium eos. Consequuntur sed ipsam et totam...</p>
                            </div>

                            <div class="post-item clearfix">
                                <img src="assets/img/news-4.jpg" alt="">
                                <h4><a href="#">Laborum corporis quo dara net para</a></h4>
                                <p>Qui enim quia optio. Eligendi aut asperiores enim repellendusvel rerum cuder...</p>
                            </div>

                            <div class="post-item clearfix">
                                <img src="assets/img/news-5.jpg" alt="">
                                <h4><a href="#">Et dolores corrupti quae illo quod dolor</a></h4>
                                <p>Odit ut eveniet modi reiciendis. Atque cupiditate libero beatae dignissimos eius...</p>
                            </div>

                        </div><!-- End sidebar recent posts-->

                    </div>
                </div><!-- End News & Updates -->

            </div><!-- End Right side columns -->

        </div>
    </section>
    <div class="col-lg-9 main-chart">
        <!--CUSTOM CHART START -->
        <div class="border-head">
            <h3>USER VISITS</h3>
        </div>
        <div class="custom-bar-chart">
            <ul class="y-axis">
                <li><span>10.000</span></li>
                <li><span>8.000</span></li>
                <li><span>6.000</span></li>
                <li><span>4.000</span></li>
                <li><span>2.000</span></li>
                <li><span>0</span></li>
            </ul>
            <div class="bar">
                <div class="title">JAN</div>
                <div class="value tooltips" data-original-title="8.500" data-toggle="tooltip" data-placement="top">85%
                </div>
            </div>
            <div class="bar ">
                <div class="title">FEB</div>
                <div class="value tooltips" data-original-title="5.000" data-toggle="tooltip" data-placement="top">50%
                </div>
            </div>
            <div class="bar ">
                <div class="title">MAR</div>
                <div class="value tooltips" data-original-title="6.000" data-toggle="tooltip" data-placement="top">60%
                </div>
            </div>
            <div class="bar ">
                <div class="title">APR</div>
                <div class="value tooltips" data-original-title="4.500" data-toggle="tooltip" data-placement="top">45%
                </div>
            </div>
            <div class="bar">
                <div class="title">MAY</div>
                <div class="value tooltips" data-original-title="3.200" data-toggle="tooltip" data-placement="top">32%
                </div>
            </div>
            <div class="bar ">
                <div class="title">JUN</div>
                <div class="value tooltips" data-original-title="6.200" data-toggle="tooltip" data-placement="top">62%
                </div>
            </div>
            <div class="bar">
                <div class="title">JUL</div>
                <div class="value tooltips" data-original-title="7.500" data-toggle="tooltip" data-placement="top">75%
                </div>
            </div>
        </div>
        <!--custom chart end-->
        <div class="row mt">
            <!-- SERVER STATUS PANELS -->
            <div class="col-md-4 col-sm-4 mb">
                <div class="grey-panel pn donut-chart">
                    <div class="grey-header">
                        <h5>SERVER LOAD</h5>
                    </div>
                    <canvas id="serverstatus01" height="120" width="120"></canvas>
                    <script>
                        var doughnutData = [{
                                value: 70,
                                color: "#FF6B6B"
                            },
                            {
                                value: 30,
                                color: "#fdfdfd"
                            }
                        ];
                        var myDoughnut = new Chart(document.getElementById("serverstatus01").getContext("2d")).Doughnut(doughnutData);
                    </script>
                    <div class="row">
                        <div class="col-sm-6 col-xs-6 goleft">
                            <p>Usage<br />Increase:</p>
                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <h2>21%</h2>
                        </div>
                    </div>
                </div>
                <!-- /grey-panel -->
            </div>
            <!-- /col-md-4-->
            <div class="col-md-4 col-sm-4 mb">
                <div class="darkblue-panel pn">
                    <div class="darkblue-header">
                        <h5>DROPBOX STATICS</h5>
                    </div>
                    <canvas id="serverstatus02" height="120" width="120"></canvas>
                    <script>
                        var doughnutData = [{
                                value: 60,
                                color: "#1c9ca7"
                            },
                            {
                                value: 40,
                                color: "#f68275"
                            }
                        ];
                        var myDoughnut = new Chart(document.getElementById("serverstatus02").getContext("2d")).Doughnut(doughnutData);
                    </script>
                    <p>April 17, 2014</p>
                    <footer>
                        <div class="pull-left">
                            <h5><i class="fa fa-hdd-o"></i> 17 GB</h5>
                        </div>
                        <div class="pull-right">
                            <h5>60% Used</h5>
                        </div>
                    </footer>
                </div>
                <!--  /darkblue panel -->
            </div>
            <!-- /col-md-4 -->
            <div class="col-md-4 col-sm-4 mb">
                <!-- REVENUE PANEL -->
                <div class="green-panel pn">
                    <div class="green-header">
                        <h5>REVENUE</h5>
                    </div>
                    <div class="chart mt">
                        <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%"
                            data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color=""
                            data-highlight-line-color="#fff" data-spot-radius="4"
                            data-data="[200,135,667,333,526,996,564,123,890,464,655]"></div>
                    </div>
                    <p class="mt"><b>$ 17,980</b><br />Month Income</p>
                </div>
            </div>
            <!-- /col-md-4 -->
        </div>
        <!-- /row -->
        <div class="row">
            <!-- WEATHER PANEL -->
            <div class="col-md-4 mb">
                <div class="weather pn">
                    <i class="fa fa-cloud fa-4x"></i>
                    <h2>11º C</h2>
                    <h4>BUDAPEST</h4>
                </div>
            </div>
            <!-- /col-md-4-->
            <!-- DIRECT MESSAGE PANEL -->
            <div class="col-md-8 mb">
                <div class="message-p pn">
                    <div class="message-header">
                        <h5>DIRECT MESSAGE</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-3 centered hidden-sm hidden-xs">
                            <img src="img/ui-danro.jpg" class="img-circle" width="65">
                        </div>
                        <div class="col-md-9">
                            <p>
                                <name>Dan Rogers</name>
                                sent you a message.
                            </p>
                            <p class="small">3 hours ago</p>
                            <p class="message">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                            <form class="form-inline" role="form">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="exampleInputText"
                                        placeholder="Reply Dan">
                                </div>
                                <button type="submit" class="btn btn-default">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Message Panel-->
            </div>
            <!-- /col-md-8  -->
        </div>
        <div class="row">
            <!-- TWITTER PANEL -->
            <div class="col-md-4 mb">
                <div class="twitter-panel pn">
                    <i class="fa fa-twitter fa-4x"></i>
                    <p>Dashio is here! Take a look and enjoy this new Bootstrap Dashboard theme.</p>
                    <p class="user">@Alvrz_is</p>
                </div>
            </div>
            <!-- /col-md-4 -->
            <div class="col-md-4 mb">
                <!-- WHITE PANEL - TOP USER -->
                <div class="white-panel pn">
                    <div class="white-header">
                        <h5>TOP USER</h5>
                    </div>
                    <p><img src="img/ui-zac.jpg" class="img-circle" width="50"></p>
                    <p><b>Zac Snider</b></p>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="small mt">MEMBER SINCE</p>
                            <p>2012</p>
                        </div>
                        <div class="col-md-6">
                            <p class="small mt">TOTAL SPEND</p>
                            <p>$ 47,60</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /col-md-4 -->
            <div class="col-md-4 mb">
                <!-- INSTAGRAM PANEL -->
                <div class="instagram-panel pn">
                    <i class="fa fa-instagram fa-4x"></i>
                    <p>@THISISYOU<br /> 5 min. ago
                    </p>
                    <p><i class="fa fa-comment"></i> 18 | <i class="fa fa-heart"></i> 49</p>
                </div>
            </div>
            <!-- /col-md-4 -->
        </div>
        <!-- /row -->
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 mb">
                <div class="product-panel-2 pn">
                    <div class="badge badge-hot">HOT</div>
                    <img src="img/product.jpg" width="200" alt="">
                    <h5 class="mt">Flat Pack Heritage</h5>
                    <h6>TOTAL SALES: 1388</h6>
                    <button class="btn btn-small btn-theme04">FULL REPORT</button>
                </div>
            </div>
            <!-- /col-md-4 -->
            <!--  PROFILE 02 PANEL -->
            <div class="col-lg-4 col-md-4 col-sm-4 mb">
                <div class="content-panel pn">
                    <div id="profile-02">
                        <div class="user">
                            <img src="img/friends/fr-06.jpg" class="img-circle" width="80">
                            <h4>DJ SHERMAN</h4>
                        </div>
                    </div>
                    <div class="pr2-social centered">
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-dribbble"></i></a>
                    </div>
                </div>
                <!-- /panel -->
            </div>
            <!--/ col-md-4 -->
            <div class="col-md-4 col-sm-4 mb">
                <div class="green-panel pn">
                    <div class="green-header">
                        <h5>DISK SPACE</h5>
                    </div>
                    <canvas id="serverstatus03" height="120" width="120"></canvas>
                    <script>
                        var doughnutData = [{
                                value: 60,
                                color: "#2b2b2b"
                            },
                            {
                                value: 40,
                                color: "#fffffd"
                            }
                        ];
                        var myDoughnut = new Chart(document.getElementById("serverstatus03").getContext("2d")).Doughnut(doughnutData);
                    </script>
                    <h3>60% USED</h3>
                </div>
            </div>
            <!-- /col-md-4 -->
        </div>
        <!-- /row -->
    </div>
    <!-- /col-lg-9 END SECTION MIDDLE -->
    <!-- **********************************************************************************************************************************************************
                RIGHT SIDEBAR CONTENT
                *********************************************************************************************************************************************************** -->
    <div class="col-lg-3 ds">
        <!--COMPLETED ACTIONS DONUTS CHART-->
        <div class="donut-main">
            <h4>COMPLETED ACTIONS & PROGRESS</h4>
            <canvas id="newchart" height="130" width="130"></canvas>
            <script>
                var doughnutData = [{
                        value: 70,
                        color: "#4ECDC4"
                    },
                    {
                        value: 30,
                        color: "#fdfdfd"
                    }
                ];
                var myDoughnut = new Chart(document.getElementById("newchart").getContext("2d")).Doughnut(doughnutData);
            </script>
        </div>
        <!--NEW EARNING STATS -->
        <div class="panel terques-chart">
            <div class="panel-body">
                <div class="chart">
                    <div class="centered">
                        <span>TODAY EARNINGS</span>
                        <strong>$ 890,00 | 15%</strong>
                    </div>
                    <br>
                    <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%"
                        data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color=""
                        data-highlight-line-color="#fff" data-spot-radius="4"
                        data-data="[200,135,667,333,526,996,564,123,890,564,455]"></div>
                </div>
            </div>
        </div>
        <!--new earning end-->
        <!-- RECENT ACTIVITIES SECTION -->
        <h4 class="centered mt">RECENT ACTIVITY</h4>
        <!-- First Activity -->
        <div class="desc">
            <div class="thumb">
                <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
            </div>
            <div class="details">
                <p>
                    <muted>Just Now</muted>
                    <br />
                    <a href="#">Paul Rudd</a> purchased an item.<br />
                </p>
            </div>
        </div>
        <!-- Second Activity -->
        <div class="desc">
            <div class="thumb">
                <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
            </div>
            <div class="details">
                <p>
                    <muted>2 Minutes Ago</muted>
                    <br />
                    <a href="#">James Brown</a> subscribed to your newsletter.<br />
                </p>
            </div>
        </div>
        <!-- Third Activity -->
        <div class="desc">
            <div class="thumb">
                <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
            </div>
            <div class="details">
                <p>
                    <muted>3 Hours Ago</muted>
                    <br />
                    <a href="#">Diana Kennedy</a> purchased a year subscription.<br />
                </p>
            </div>
        </div>
        <!-- Fourth Activity -->
        <div class="desc">
            <div class="thumb">
                <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
            </div>
            <div class="details">
                <p>
                    <muted>7 Hours Ago</muted>
                    <br />
                    <a href="#">Brando Page</a> purchased a year subscription.<br />
                </p>
            </div>
        </div>
        <!-- USERS ONLINE SECTION -->
        <h4 class="centered mt">TEAM MEMBERS ONLINE</h4>
        <!-- First Member -->
        <div class="desc">
            <div class="thumb">
                <img class="img-circle" src="img/ui-divya.jpg" width="35px" height="35px" align="">
            </div>
            <div class="details">
                <p>
                    <a href="#">DIVYA MANIAN</a><br />
                    <muted>Available</muted>
                </p>
            </div>
        </div>
        <!-- Second Member -->
        <div class="desc">
            <div class="thumb">
                <img class="img-circle" src="img/ui-sherman.jpg" width="35px" height="35px" align="">
            </div>
            <div class="details">
                <p>
                    <a href="#">DJ SHERMAN</a><br />
                    <muted>I am Busy</muted>
                </p>
            </div>
        </div>
        <!-- Third Member -->
        <div class="desc">
            <div class="thumb">
                <img class="img-circle" src="img/ui-danro.jpg" width="35px" height="35px" align="">
            </div>
            <div class="details">
                <p>
                    <a href="#">DAN ROGERS</a><br />
                    <muted>Available</muted>
                </p>
            </div>
        </div>
        <!-- Fourth Member -->
        <div class="desc">
            <div class="thumb">
                <img class="img-circle" src="img/ui-zac.jpg" width="35px" height="35px" align="">
            </div>
            <div class="details">
                <p>
                    <a href="#">Zac Sniders</a><br />
                    <muted>Available</muted>
                </p>
            </div>
        </div>
        <!-- CALENDAR-->
        <div id="calendar" class="mb">
            <div class="panel green-panel no-margin">
                <div class="panel-body">
                    <div id="date-popover" class="popover top"
                        style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
                        <div class="arrow"></div>
                        <h3 class="popover-title" style="disadding: none;"></h3>
                        <div id="date-popover-content" class="popover-content"></div>
                    </div>
                    <div id="my-calendar"></div>
                </div>
            </div>
        </div>
        <!-- / calendar -->
    </div>
    <!-- /col-lg-3 -->
    </div>
</main>
@endsection

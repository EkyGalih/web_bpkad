/**
 * Analytics Cards
 */

'use strict';

(function () {
    let cardColor,
        headingColor,
        labelColor,
        fontFamily,
        borderColor,
        bodyColor,
        grayColor,
        heatMap1,
        heatMap2,
        heatMap3,
        heatMap4,
        currentTheme,
        chartBgColor;

    if (isDarkStyle) {
        heatMap1 = '#333457';
        heatMap2 = '#3c3e75';
        heatMap3 = '#484b9b';
        heatMap4 = '#696cff';
        grayColor = '#3b3e59';
        currentTheme = 'dark';
    } else {
        heatMap1 = '#ededff';
        heatMap2 = '#d5d6ff';
        heatMap3 = '#b7b9ff';
        heatMap4 = '#696cff';
        grayColor = '#f4f4f6';
        currentTheme = 'light';
    }
    cardColor = config.colors.cardColor;
    headingColor = config.colors.headingColor;
    labelColor = config.colors.textMuted;
    borderColor = config.colors.borderColor;
    bodyColor = config.colors.bodyColor;
    fontFamily = config.fontFamily;

    // Chart Colors
    const chartColors = {
        donut: {
            series1: config.colors.warning,
            series2: '#fdb528cc',
            series3: '#fdb52899',
            series4: '#fdb52866',
            series5: config.colors_label.warning
        },
        donut2: {
            series1: '#49AC00',
            series2: '#4DB600',
            series3: config.colors.success,
            series4: '#78D533',
            series5: '#9ADF66',
            series6: '#BBEA99'
        },
        line: {
            series1: config.colors.warning,
            series2: config.colors.primary,
            series3: '#7367f029'
        }
    };

    if (isDarkStyle) {
        chartBgColor = '#474360';
        currentTheme = 'dark';
    } else {
        chartBgColor = '#F0F2F8';
        currentTheme = 'light';
    }

    // Performance Radar Chart
    // --------------------------------------------------------------------
    const performanceChartEl = document.querySelector('#performanceChart'),
        performanceChartConfig = {
            chart: {
                height: 300,
                type: 'radar',
                offsetY: 10,
                toolbar: {
                    show: false
                }
            },
            legend: {
                show: true,
                position: 'bottom',
                markers: {
                    size: 5,
                    width: 10,
                    height: 10,
                    offsetX: -2,
                    strokeWidth: 0
                },
                itemMargin: { horizontal: 10 },
                fontFamily: fontFamily,
                fontSize: '15px',
                labels: {
                    colors: labelColor,
                    useSeriesColors: false
                }
            },
            plotOptions: {
                radar: {
                    polygons: {
                        strokeColors: borderColor,
                        connectorColors: borderColor
                    }
                }
            },
            yaxis: {
                show: false
            },
            series: [
                {
                    name: 'Income',
                    data: [70, 90, 80, 95, 75, 90]
                },
                {
                    name: 'Net Worth',
                    data: [110, 78, 95, 85, 95, 78]
                }
            ],
            colors: [config.colors.warning, config.colors.primary],
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                labels: {
                    show: true,
                    style: {
                        colors: [labelColor, labelColor, labelColor, labelColor, labelColor, labelColor],
                        fontSize: '13px',
                        fontFamily: fontFamily,
                        fontWeight: 400
                    }
                }
            },
            fill: {
                opacity: [1, 0.9]
            },
            stroke: {
                show: false,
                width: 0
            },
            markers: {
                size: 0
            },
            grid: {
                show: false,
                padding: {
                    bottom: -10
                }
            }
        };
    if (typeof performanceChartEl !== undefined && performanceChartEl !== null) {
        const performanceChart = new ApexCharts(performanceChartEl, performanceChartConfig);
        performanceChart.render();
    }

    // Jumlah Halaman Terbanyak di kunjungi

    const horizontalBarChartEl = document.querySelector('#horizontalBarChart');

    fetch('/admin/web/analytics/pages') // Pastikan route ini sesuai
        .then(res => res.json())
        .then(data => {
            const titles = data.titles || [];
            const views = data.views || [];
            const urls = data.labels || []; // ini yang kamu set sebagai url

            if (!titles.length || !views.length || !urls.length) return;

            const colors = [
                config.colors.primary,
                config.colors.info,
                config.colors.success,
                config.colors.secondary,
                config.colors.danger,
                config.colors.warning
            ];

            const horizontalBarChartConfig = {
                chart: {
                    height: 270,
                    type: 'bar',
                    toolbar: { show: false }
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                        barHeight: '70%',
                        distributed: true,
                        startingShape: 'rounded',
                        borderRadius: 7
                    }
                },
                colors: colors.slice(0, titles.length),
                series: [{
                    data: views
                }],
                labels: titles,
                grid: {
                    strokeDashArray: 10,
                    borderColor: borderColor,
                    xaxis: { lines: { show: true } },
                    yaxis: { lines: { show: false } },
                    padding: { top: -35, bottom: -12 }
                },
                dataLabels: {
                    enabled: true,
                    style: {
                        colors: ['#fff'],
                        fontWeight: 500,
                        fontSize: '13px',
                        fontFamily: fontFamily
                    },
                    formatter: (val, opts) => titles[opts.dataPointIndex]
                },
                xaxis: {
                    categories: views.map(v => `${v}`),
                    axisBorder: { show: false },
                    axisTicks: { show: false },
                    labels: {
                        style: {
                            colors: labelColor,
                            fontFamily: fontFamily,
                            fontSize: '13px'
                        }
                    }
                },
                yaxis: {
                    max: Math.max(...views),
                    labels: {
                        style: {
                            colors: [labelColor],
                            fontFamily: fontFamily,
                            fontSize: '13px'
                        }
                    }
                },
                tooltip: {
                    enabled: true,
                    custom: ({ series, seriesIndex, dataPointIndex }) => {
                        return `<div class="px-3 py-2">
                        <strong>${titles[dataPointIndex]}</strong><br>
                        ${series[seriesIndex][dataPointIndex]} visits<br>
                        <small>${urls[dataPointIndex]}</small>
                    </div>`;
                    }
                },
                legend: { show: false }
            };

            const chartEl = document.querySelector('#horizontalBarChart');
            if (chartEl) {
                const chart = new ApexCharts(chartEl, horizontalBarChartConfig);
                chart.render();
            }

            // Update list di sebelah kanan chart (sidebar)
            const sidebar = document.querySelector('.col-md-6.d-flex.justify-content-around');
            if (sidebar) {
                const leftSide = document.createElement('div');
                const rightSide = document.createElement('div');

                for (let i = 0; i < titles.length; i++) {
                    const group = document.createElement('div');
                    group.classList.add('d-flex', 'align-items-baseline', ...(i % 3 === 1 ? ['my-10'] : []));

                    const colorClass = `text-${Object.keys(config.colors)[i % Object.keys(config.colors).length]}`;

                    group.innerHTML = `
                    <span class="${colorClass} me-2">
                        <i class="icon-base ri ri-circle-fill icon-base ri ri-12px"></i>
                    </span>
                    <div>
                        <p class="mb-0">${titles[i]}</p>
                        <h5 class="mb-0">${views[i]} Visits</h5>
                    </div>
                `;

                    if (i < 3) {
                        leftSide.appendChild(group);
                    } else {
                        rightSide.appendChild(group);
                    }
                }

                sidebar.innerHTML = '';
                sidebar.appendChild(leftSide);
                sidebar.appendChild(rightSide);
            }
        })
        .catch(err => console.error("Gagal memuat chart halaman terpopuler:", err));

    // // Shipment statistics Chart
    // // --------------------------------------------------------------------
    const shipmentEl = document.querySelector('#shipmentStatisticsChart'),
        shipmentConfig = {
            series: [
                {
                    name: 'Shipment',
                    type: 'column',
                    data: [38, 45, 33, 38, 32, 50, 48, 40, 42, 37]
                },
                {
                    name: 'Delivery',
                    type: 'line',
                    data: [23, 28, 23, 32, 28, 44, 32, 38, 26, 34]
                }
            ],
            chart: {
                height: 280,
                type: 'line',
                stacked: false,
                parentHeightOffset: 0,
                toolbar: { show: false },
                zoom: { enabled: false }
            },
            markers: {
                size: 5,
                colors: [config.colors.white],
                strokeColors: chartColors.line.series2,
                hover: { size: 6 },
                borderRadius: 4
            },
            stroke: {
                curve: 'smooth',
                width: [0, 3],
                lineCap: 'round'
            },
            legend: {
                show: true,
                position: 'bottom',
                markers: {
                    size: 4,
                    strokeWidth: 0
                },
                height: 40,
                itemMargin: {
                    horizontal: 10,
                    vertical: 0
                },
                fontSize: '15px',
                fontFamily: fontFamily,
                fontWeight: 400,
                labels: {
                    colors: headingColor,
                    useSeriesColors: false
                },
                offsetY: 0
            },
            grid: {
                strokeDashArray: 8,
                borderColor
            },
            colors: [chartColors.line.series1, chartColors.line.series2],
            fill: {
                opacity: [1, 1]
            },
            plotOptions: {
                bar: {
                    columnWidth: '30%',
                    startingShape: 'rounded',
                    endingShape: 'rounded',
                    borderRadius: 4
                }
            },
            dataLabels: { enabled: false },
            xaxis: {
                tickAmount: 10,
                categories: ['1 Jan', '2 Jan', '3 Jan', '4 Jan', '5 Jan', '6 Jan', '7 Jan', '8 Jan', '9 Jan', '10 Jan'],
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: '13px',
                        fontFamily: fontFamily,
                        fontWeight: 400
                    }
                },
                axisBorder: { show: false },
                axisTicks: { show: false }
            },
            yaxis: {
                tickAmount: 4,
                min: 0,
                max: 50,
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: '13px',
                        fontFamily: fontFamily,
                        fontWeight: 400
                    },
                    formatter: function (val) {
                        return val + '%';
                    }
                }
            },
            responsive: [
                {
                    breakpoint: 1400,
                    options: {
                        chart: {
                            height: 315
                        },
                        xaxis: {
                            labels: {
                                style: {
                                    fontSize: '10px'
                                }
                            }
                        },
                        legend: {
                            itemMargin: {
                                vertical: 0,
                                horizontal: 10
                            },
                            fontSize: '13px',
                            offsetY: 5
                        }
                    }
                },
                {
                    breakpoint: 1025,
                    options: {
                        chart: { height: 415 },
                        plotOptions: { bar: { columnWidth: '50%' } }
                    }
                },
                {
                    breakpoint: 982,
                    options: { plotOptions: { bar: { columnWidth: '30%' } } }
                },
                {
                    breakpoint: 480,
                    options: {
                        chart: { height: 250 },
                        legend: { offsetY: 7 }
                    }
                }
            ]
        };
    if (typeof shipmentEl !== undefined && shipmentEl !== null) {
        const shipment = new ApexCharts(shipmentEl, shipmentConfig);
        shipment.render();
    }

    // // Reasons for delivery exceptions Chart
    // // --------------------------------------------------------------------
    const deliveryExceptionsChartE1 = document.querySelector('#deliveryExceptionsChart'),
        deliveryExceptionsChartConfig = {
            chart: {
                height: 390,
                parentHeightOffset: 0,
                type: 'donut'
            },
            labels: ['Incorrect address', 'Weather conditions', 'Federal Holidays', 'Damage during transit'],
            series: [13, 25, 22, 40],
            colors: [
                chartColors.donut2.series3,
                chartColors.donut2.series4,
                chartColors.donut2.series5,
                chartColors.donut2.series6
            ],
            stroke: {
                width: 0
            },
            dataLabels: {
                enabled: false,
                formatter: function (val, opt) {
                    return parseInt(val) + '%';
                }
            },
            legend: {
                show: true,
                position: 'bottom',
                offsetY: 10,
                markers: {
                    size: 5,
                    width: 8,
                    height: 8,
                    offsetX: -3,
                    strokeWidth: 0
                },
                itemMargin: {
                    horizontal: 16,
                    vertical: 5
                },
                fontSize: '13px',
                fontFamily: fontFamily,
                fontWeight: 400,
                labels: {
                    colors: headingColor,
                    useSeriesColors: false
                }
            },
            tooltip: {
                theme: currentTheme
            },
            grid: {
                padding: {
                    top: 15
                }
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '75%',
                        labels: {
                            show: true,
                            value: {
                                fontSize: '24px',
                                fontFamily: fontFamily,
                                color: headingColor,
                                fontWeight: 500,
                                offsetY: -30,
                                formatter: function (val) {
                                    return parseInt(val) + '%';
                                }
                            },
                            name: {
                                offsetY: 20,
                                fontFamily: fontFamily
                            },
                            total: {
                                show: true,
                                fontSize: '0.9375rem',
                                label: 'AVG. Exceptions',
                                color: labelColor,
                                formatter: function (w) {
                                    return '30%';
                                }
                            }
                        }
                    }
                }
            },
            responsive: [
                {
                    breakpoint: 420,
                    options: {
                        chart: {
                            height: 360
                        }
                    }
                }
            ]
        };
    if (typeof deliveryExceptionsChartE1 !== undefined && deliveryExceptionsChartE1 !== null) {
        const deliveryExceptionsChart = new ApexCharts(deliveryExceptionsChartE1, deliveryExceptionsChartConfig);
        deliveryExceptionsChart.render();
    }

    // Total Transactions Bar Chart
    // --------------------------------------------------------------------
    const totalTransactionChartEl = document.querySelector('#totalTransactionChart'),
        totalTransactionChartConfig = {
            chart: {
                height: 218,
                stacked: true,
                type: 'bar',
                parentHeightOffset: 0,
                toolbar: {
                    show: false
                }
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return Math.abs(val);
                    }
                }
            },
            legend: { show: false },
            dataLabels: { enabled: false },
            colors: [config.colors.primary, config.colors.success],
            grid: {
                borderColor,
                xaxis: { lines: { show: true } },
                yaxis: { lines: { show: false } },
                padding: {
                    top: -5,
                    bottom: -25
                }
            },
            states: {
                hover: { filter: { type: 'none' } },
                active: { filter: { type: 'none' } }
            },
            plotOptions: {
                bar: {
                    borderRadius: 5,
                    barHeight: '30%',
                    horizontal: true,
                    endingShape: 'flat',
                    startingShape: 'rounded'
                }
            },
            xaxis: {
                position: 'top',
                axisTicks: { show: false },
                axisBorder: { show: false },
                categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: '13px',
                        fontFamily: 'Inter'
                    },
                    formatter: function (val) {
                        return Math.abs(Math.round(val));
                    }
                }
            },
            yaxis: { labels: { show: false } },
            series: [
                {
                    name: 'Last Week',
                    data: [83, 153, 213, 279, 213, 153, 83]
                },
                {
                    name: 'This Week',
                    data: [-84, -156, -216, -282, -216, -156, -84]
                }
            ]
        };
    if (typeof totalTransactionChartEl !== undefined && totalTransactionChartEl !== null) {
        const totalTransactionChart = new ApexCharts(totalTransactionChartEl, totalTransactionChartConfig);
        totalTransactionChart.render();
    }

    // Performance Overview Line Chart
    // --------------------------------------------------------------------
    const performanceOverviewChartEl = document.querySelector('#performanceOverviewChart'),
        performanceOverviewChartConfig = {
            chart: {
                height: 220,
                type: 'line',
                parentHeightOffset: 0,
                toolbar: {
                    show: false
                }
            },
            series: [
                {
                    data: [7, 65, 40, 7, 40, 80, 45, 65, 65]
                }
            ],
            stroke: {
                curve: 'stepline'
            },
            tooltip: {
                enabled: false
            },
            colors: [config.colors.warning],
            grid: {
                yaxis: {
                    lines: {
                        show: false
                    }
                }
            },
            xaxis: {
                labels: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                axisBorder: {
                    show: false
                }
            },
            yaxis: {
                labels: {
                    show: false
                }
            },
            responsive: [
                {
                    breakpoint: 1200,
                    options: {
                        chart: {
                            height: 268
                        }
                    }
                }
            ]
        };
    if (typeof performanceOverviewChartEl !== undefined && performanceOverviewChartEl !== null) {
        const performanceOverviewChart = new ApexCharts(performanceOverviewChartEl, performanceOverviewChartConfig);
        performanceOverviewChart.render();
    }

    // Visits By Day Bar Chart
    // --------------------------------------------------------------------
    const visitsByDayChartEl = document.querySelector('#visitsByDayChart');

    function formatK(value) {
        return value > 999 ? (value / 1000).toFixed(1) + 'k' : value;
    }

    function loadAnalytics(range = '7days') {
        fetch(`/admin/web/analytics/periode/${range}`)
            .then(res => res.json())
            .then(data => {
                const viewsData = data.views;
                const labelsData = data.labels.map(date =>
                    new Date(date).toLocaleDateString('id-ID', { weekday: 'short' })
                );

                const config = window.config || { colors: { warning: '#0a1b39' }, colors_label: { warning: '#347bf7' } };
                const visitsByDayChartConfig = {
                    chart: {
                        height: 240,
                        type: 'bar',
                        parentHeightOffset: 0,
                        toolbar: { show: false }
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 8,
                            distributed: true,
                            columnWidth: '55%',
                            endingShape: 'rounded',
                            startingShape: 'rounded'
                        }
                    },
                    series: [{ data: viewsData }],
                    tooltip: { enabled: true },
                    legend: { show: false },
                    dataLabels: { enabled: false },
                    colors: viewsData.map((_, i) =>
                        i === viewsData.indexOf(Math.max(...viewsData)) ? config.colors.primary : config.colors_label.primary
                    ),
                    grid: {
                        show: false,
                        padding: { top: -15, left: -7, right: -4 }
                    },
                    xaxis: {
                        axisTicks: { show: false },
                        axisBorder: { show: false },
                        categories: labelsData,
                        labels: {
                            style: {
                                colors: labelColor,
                                fontSize: '13px',
                                fontFamily: 'Inter'
                            }
                        }
                    },
                    yaxis: { show: false },
                    responsive: [{ breakpoint: 1025, options: { chart: { height: 210 } } }]
                };

                if (visitsByDayChartEl) {
                    const chart = new ApexCharts(visitsByDayChartEl, visitsByDayChartConfig);
                    chart.render();
                }

                // Update total & max
                document.querySelector('.total-visit-value').innerText = `Total ${formatK(data.total)} Pengunjung`;
                document.querySelectorAll('.most-visited-day').forEach(el => {
                    el.innerText = `Total ${formatK(data.max.value)} Pengunjung pada hari ${data.max.day}`;
                });
            })
            .catch(err => {
                console.error("Gagal mengambil data analytics:", err);
            });
    }

    // Default load
    loadAnalytics('7days');

    // Handle dropdown clicks
    document.querySelectorAll('.range-selector').forEach(item => {
        item.addEventListener('click', () => {
            const selectedRange = item.getAttribute('data-range');
            visitsByDayChartEl.innerHTML = ''; // Clear chart before re-render
            loadAnalytics(selectedRange);
        });
    });

    // Organic Sessions Donut Chart
    // --------------------------------------------------------------------
    const organicSessionsEl = document.querySelector('#organicSessionsChart'),
        organicSessionsConfig = {
            chart: {
                height: 322,
                type: 'donut',
                parentHeightOffset: 0
            },
            labels: ['USA', 'India', 'Canada', 'Japan', 'France'],
            tooltip: { enabled: false },
            dataLabels: { enabled: false },
            stroke: {
                width: 3,
                lineCap: 'round',
                colors: [cardColor]
            },
            states: {
                hover: {
                    filter: { type: 'none' }
                },
                active: {
                    filter: { type: 'none' }
                }
            },
            plotOptions: {
                pie: {
                    endAngle: 130,
                    startAngle: -130,
                    customScale: 0.9,
                    donut: {
                        size: '83%',
                        labels: {
                            show: true,
                            name: {
                                offsetY: 25,
                                fontSize: '13px',
                                fontFamily: 'Inter',
                                color: bodyColor
                            },
                            value: {
                                offsetY: -15,
                                fontWeight: 500,
                                fontSize: '1.75rem',
                                fontFamily: 'Inter',
                                color: headingColor,
                                formatter: function (val) {
                                    return parseInt(val) + 'K';
                                }
                            },
                            total: {
                                show: true,
                                label: '2022',
                                fontSize: '0.9375rem',
                                fontFamily: 'Inter',
                                color: bodyColor,
                                formatter: function (w) {
                                    return '89K';
                                }
                            }
                        }
                    }
                }
            },
            series: [13, 18, 18, 24, 16],
            tooltip: {
                enabled: false
            },
            legend: {
                position: 'bottom',
                fontFamily: 'Inter',
                fontSize: '15px',
                markers: { offsetX: -5, strokeWidth: 0 },
                itemMargin: {
                    horizontal: 24,
                    vertical: 8
                },
                labels: {
                    colors: headingColor
                }
            },
            colors: [
                chartColors.donut.series1,
                chartColors.donut.series2,
                chartColors.donut.series3,
                chartColors.donut.series4,
                chartColors.donut.series5
            ]
        };
    if (typeof organicSessionsEl !== undefined && organicSessionsEl !== null) {
        const organicSessions = new ApexCharts(organicSessionsEl, organicSessionsConfig);
        organicSessions.render();
    }

    // Weekly Sales Line Chart
    // --------------------------------------------------------------------
    const weeklySalesEl = document.querySelector('#weeklySalesChart'),
        weeklySalesConfig = {
            chart: {
                stacked: true,
                type: 'line',
                height: 235,
                parentHeightOffset: 0,
                toolbar: {
                    show: false
                }
            },
            tooltip: { enabled: false },
            series: [
                {
                    type: 'column',
                    name: 'Earning',
                    data: [90, 52, 67, 45, 75, 55, 48]
                },
                {
                    type: 'column',
                    name: 'Expense',
                    data: [-53, -29, -67, -84, -60, -40, -77]
                },
                {
                    type: 'line',
                    name: 'Expense',
                    data: [73, 20, 50, -20, 58, 15, 31]
                }
            ],
            plotOptions: {
                bar: {
                    borderRadius: 8,
                    columnWidth: '57%',
                    borderRadiusApplication: 'end'
                }
            },
            markers: {
                size: 4,
                strokeWidth: 3,
                fillOpacity: 1,
                strokeOpacity: 1,
                colors: [cardColor],
                strokeColors: config.colors.warning
            },
            stroke: {
                curve: 'smooth',
                width: [0, 0, 3],
                colors: [config.colors.warning]
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                show: false
            },
            colors: [config.colors.primary, config.colors_label.primary],
            grid: {
                yaxis: { lines: { show: false } },
                padding: {
                    top: -28,
                    left: -6,
                    right: -8,
                    bottom: -5
                }
            },
            xaxis: {
                axisTicks: { show: false },
                axisBorder: { show: false },
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                labels: {
                    style: {
                        colors: labelColor,
                        fontFamily: 'Inter',
                        fontSize: '13px'
                    }
                }
            },
            yaxis: {
                max: 100,
                min: -100,
                show: false
            },
            states: {
                hover: {
                    filter: {
                        type: 'none'
                    }
                },
                active: {
                    filter: {
                        type: 'none'
                    }
                }
            }
        };
    if (typeof weeklySalesEl !== undefined && weeklySalesEl !== null) {
        const weeklySales = new ApexCharts(weeklySalesEl, weeklySalesConfig);
        weeklySales.render();
    }

    // Project Timeline Range Bar Chart
    // --------------------------------------------------------------------
    fetch('/admin/web/analytics/browser-device')
        .then(res => res.json())
        .then(data => {
            const browserEl = document.querySelector('#browserList');
            const deviceEl = document.querySelector('#deviceList');

            const browserSubtitle = document.querySelector('#browserSubtitle');
            const deviceSubtitle = document.querySelector('#deviceSubtitle');

            // Update subtitle total
            browserSubtitle.innerText = `Total ${data.total_browser} Pengunjung`;
            deviceSubtitle.innerText = `Total ${data.total_device} Pengunjung`;

            // Tampilkan data browser
            browserEl.innerHTML = '';
            data.browsers.forEach((item, i) => {
                const color = ['primary', 'success', 'info', 'warning', 'danger'][i % 5];
                const browserIcons = {
                    Chrome: 'ri-google-line',
                    Firefox: 'ri-firefox-line',
                    Safari: 'ri-safari-line',
                    Edge: 'ri-edge-line',
                    Opera: 'ri-opera-line',
                };
                const icon = browserIcons[item.browser] || 'ri-global-line';

                browserEl.innerHTML += `
                <div class="d-flex align-items-center mb-3">
                    <div class="avatar">
                        <div class="avatar-initial bg-label-${color} rounded">
                            <i class="icon-base ri ${icon} icon-24px"></i>
                        </div>
                    </div>
                    <div class="ms-3 d-flex flex-column">
                        <h6 class="mb-1">${item['browser']}</h6>
                        <small>${item['screenPageViews']} Visitor</small>
                    </div>
                </div>
            `;
            });

            // Tampilkan data device
            deviceEl.innerHTML = '';
            data.devices.forEach((item, i) => {
                const color = ['primary', 'success', 'info', 'warning', 'danger'][i % 5];
                const deviceIcons = {
                    desktop: 'ri-computer-line',
                    mobile: 'ri-smartphone-line',
                    tablet: 'ri-tablet-line',
                };
                const icon = deviceIcons[item.device.toLowerCase()] || 'ri-device-line';

                deviceEl.innerHTML += `
                <div class="d-flex align-items-center mb-3">
                    <div class="avatar">
                        <div class="avatar-initial bg-label-${color} rounded">
                            <i class="icon-base ri ${icon} icon-24px"></i>
                        </div>
                    </div>
                    <div class="ms-3 d-flex flex-column">
                        <h6 class="mb-1">${item.device}</h6>
                        <small>${item.users} Visitor</small>
                    </div>
                </div>
            `;
            });
        });


    // Monthly Budget Area Chart
    // --------------------------------------------------------------------
    const monthlyBudgetChartEl = document.querySelector('#monthlyBudgetChart'),
        monthlyBudgetChartConfig = {
            series: [
                {
                    data: [0, 85, 25, 125, 90, 250, 200, 350]
                }
            ],
            chart: {
                height: 200,
                parentHeightOffset: 0,
                parentWidthOffset: 0,
                toolbar: {
                    show: false
                },
                type: 'area'
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: 5,
                curve: 'smooth'
            },
            legend: {
                show: false
            },
            markers: {
                size: 6,
                colors: 'transparent',
                strokeColors: 'transparent',
                strokeWidth: 4,
                discrete: [
                    {
                        fillColor: config.colors.white,
                        seriesIndex: 0,
                        dataPointIndex: 6,
                        strokeColor: config.colors.success,
                        strokeWidth: 2,
                        size: 6,
                        radius: 8
                    }
                ],
                offsetX: -1,
                hover: {
                    size: 7
                }
            },
            colors: [config.colors.success],
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    gradientToColors: [config.colors.cardColor],
                    opacityTo: 0.5,
                    stops: [0, 100]
                }
            },
            grid: {
                show: false,
                padding: {
                    left: 10,
                    top: 0,
                    right: 12
                }
            },
            xaxis: {
                type: 'numeric',
                labels: { show: false },
                axisTicks: { show: false },
                axisBorder: { show: false }
            },
            yaxis: { show: false },
            markers: {
                size: 1,
                offsetY: 1,
                offsetX: -5,
                strokeWidth: 4,
                strokeOpacity: 1,
                colors: ['transparent'],
                strokeColors: 'transparent',
                discrete: [
                    {
                        size: 7,
                        seriesIndex: 0,
                        dataPointIndex: 7,
                        strokeColor: config.colors.success,
                        fillColor: cardColor
                    }
                ]
            }
        };
    if (typeof monthlyBudgetChartEl !== undefined && monthlyBudgetChartEl !== null) {
        const monthlyBudgetChart = new ApexCharts(monthlyBudgetChartEl, monthlyBudgetChartConfig);
        monthlyBudgetChart.render();
    }

    // External Links Stacked Bar Chart
    // --------------------------------------------------------------------
    const externalLinksChartEl = document.querySelector('#externalLinksChart'),
        externalLinksChartConfig = {
            chart: {
                type: 'bar',
                height: 232,
                parentHeightOffset: 0,
                stacked: true,
                toolbar: {
                    show: false
                }
            },
            series: [
                {
                    name: 'Google Analytics',
                    data: [155, 135, 320, 100, 150, 335, 160]
                },
                {
                    name: 'Facebook Ads',
                    data: [110, 235, 125, 230, 215, 115, 200]
                }
            ],
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '40%',
                    borderRadius: 8,
                    borderRadiusApplication: 'around',
                    startingShape: 'rounded',
                    endingShape: 'rounded'
                }
            },
            dataLabels: {
                enabled: false
            },
            tooltip: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 6,
                lineCap: 'round',
                colors: [cardColor]
            },
            legend: {
                show: false
            },
            colors: [config.colors.primary, config.colors.secondary],
            grid: {
                strokeDashArray: 10,
                borderColor,
                padding: {
                    top: -12,
                    left: -4,
                    right: -5,
                    bottom: 5
                }
            },
            xaxis: {
                categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                labels: {
                    show: false
                },
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                }
            },
            yaxis: {
                show: false
            },
            states: {
                hover: {
                    filter: {
                        type: 'none'
                    }
                },
                active: {
                    filter: {
                        type: 'none'
                    }
                }
            },
            responsive: [
                {
                    breakpoint: 1441,
                    options: {
                        plotOptions: {
                            bar: {
                                columnWidth: '50%'
                            }
                        }
                    }
                },
                {
                    breakpoint: 1025,
                    options: {
                        plotOptions: {
                            bar: {
                                columnWidth: '45%'
                            }
                        }
                    }
                },
                {
                    breakpoint: 577,
                    options: {
                        plotOptions: {
                            bar: {
                                columnWidth: '35%'
                            }
                        }
                    }
                },
                {
                    breakpoint: 426,
                    options: {
                        plotOptions: {
                            bar: {
                                columnWidth: '50%'
                            }
                        }
                    }
                }
            ]
        };
    if (typeof externalLinksChartEl !== undefined && externalLinksChartEl !== null) {
        const externalLinksChart = new ApexCharts(externalLinksChartEl, externalLinksChartConfig);
        externalLinksChart.render();
    }

    // Sales Country Bar Chart
    // --------------------------------------------------------------------
    const salesCountryChartEl = document.querySelector('#salesCountryChart');

    fetch('/admin/web/analytics/visits-by-country')
        .then(res => res.json())
        .then(data => {
            // Ambil inisial untuk city dan region
            const combinedInitials = data.city.map((city, i) => {
                const cityInitial = city;
                const regionInitial = data.region[i]?.trim().split(/\s+/).map(word => word.charAt(0).toUpperCase()).join('');
                return `${cityInitial}, ${regionInitial}`;
            });

            const visitors = data.total;

            const salesCountryChartConfig = {
                chart: {
                    type: 'bar',
                    height: 295,
                    parentHeightOffset: 0,
                    toolbar: { show: false }
                },
                series: [{
                    name: 'Visitor',
                    data: visitors
                }],
                plotOptions: {
                    bar: {
                        borderRadius: 8,
                        barHeight: '60%',
                        horizontal: true,
                        distributed: true,
                        startingShape: 'rounded',
                        dataLabels: { position: 'bottom' }
                    }
                },
                dataLabels: {
                    enabled: true,
                    textAnchor: 'start',
                    offsetY: 8,
                    offsetX: 11,
                    style: {
                        fontWeight: 500,
                        fontSize: '0.9375rem',
                        fontFamily: 'Inter'
                    }
                },
                tooltip: {
                    enabled: true,
                    y: {
                        formatter: val => `${val.toLocaleString()} visits`
                    }
                },
                legend: { show: false },
                colors: Array.from({ length: visitors.length }, (_, i) => {
                    const colorList = [
                        config.colors.primary,
                        config.colors.success,
                        config.colors.warning,
                        config.colors.info,
                        config.colors.danger,
                        config.colors.secondary
                    ];
                    return colorList[i % colorList.length];
                }),
                grid: {
                    strokeDashArray: 8,
                    borderColor: borderColor,
                    xaxis: { lines: { show: true } },
                    yaxis: { lines: { show: false } },
                    padding: {
                        top: -18,
                        left: 21,
                        right: 33,
                        bottom: 10
                    }
                },
                xaxis: {
                    categories: combinedInitials,
                    labels: {
                        formatter: function (val) {
                            return val;
                        },
                        style: {
                            fontSize: '13px',
                            colors: labelColor,
                            fontFamily: 'Inter'
                        }
                    },
                    axisBorder: { show: false },
                    axisTicks: { show: false }
                },
                yaxis: {
                    labels: {
                        style: {
                            fontWeight: 500,
                            fontSize: '0.9375rem',
                            colors: headingColor,
                            fontFamily: 'Inter'
                        }
                    }
                },
                states: {
                    hover: { filter: { type: 'none' } },
                    active: { filter: { type: 'none' } }
                }
            };

            if (typeof salesCountryChartEl !== undefined && salesCountryChartEl !== null) {
                const chart = new ApexCharts(salesCountryChartEl, salesCountryChartConfig);
                chart.render();
            }

            // Tambahkan total di subtitle
            const totalVisitors = data.total.reduce((acc, curr) => acc + curr, 0);

            // Update subtitle text
            document.querySelector('.total-visitor').innerText = `Total ${totalVisitors} Visitor`;
        })
        .catch(err => {
            console.error("Gagal mengambil data wilayah:", err);
        });

    // Weekly Overview Line Chart
    // --------------------------------------------------------------------
    const weeklyOverviewChartEl = document.querySelector('#weeklyOverviewChart'),
        weeklyOverviewChartConfig = {
            chart: {
                type: 'line',
                height: 230,
                offsetY: -9,
                offsetX: -16,
                parentHeightOffset: 0,
                toolbar: {
                    show: false
                }
            },
            series: [
                {
                    name: 'Sales',
                    type: 'column',
                    data: [83, 68, 56, 65, 65, 50, 39]
                },
                {
                    name: 'Sales',
                    type: 'line',
                    data: [63, 38, 31, 45, 46, 27, 18]
                }
            ],
            plotOptions: {
                bar: {
                    borderRadius: 9,
                    columnWidth: '50%',
                    endingShape: 'rounded',
                    startingShape: 'rounded',
                    colors: {
                        ranges: [
                            {
                                to: 50,
                                from: 40,
                                color: config.colors.primary
                            }
                        ]
                    }
                }
            },
            markers: {
                size: 3.5,
                strokeWidth: 2,
                fillOpacity: 1,
                strokeOpacity: 1,
                colors: [cardColor],
                strokeColors: config.colors.primary
            },
            stroke: {
                width: [0, 2],
                colors: [config.colors.primary]
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                show: false
            },
            colors: [grayColor],
            grid: {
                strokeDashArray: 10,
                borderColor,
                padding: {
                    bottom: -10
                }
            },
            xaxis: {
                categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                tickPlacement: 'on',
                labels: {
                    show: false
                },
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                }
            },
            yaxis: {
                min: 0,
                max: 90,
                show: true,
                tickAmount: 3,
                labels: {
                    formatter: function (val) {
                        return parseInt(val) + 'K';
                    },
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Inter',
                        colors: labelColor
                    }
                }
            },
            states: {
                hover: {
                    filter: {
                        type: 'none'
                    }
                },
                active: {
                    filter: {
                        type: 'none'
                    }
                }
            }
        };
    if (typeof weeklyOverviewChartEl !== undefined && weeklyOverviewChartEl !== null) {
        const weeklyOverviewChart = new ApexCharts(weeklyOverviewChartEl, weeklyOverviewChartConfig);
        weeklyOverviewChart.render();
    }
})();

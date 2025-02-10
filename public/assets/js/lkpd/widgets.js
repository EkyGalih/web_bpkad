"use strict";

// Class definition
var KTWidgets = function () {
    // Statistics widgets

    var initChartsWidget6 = function() {
        var element = document.getElementById("kt_charts_widget_6_chart");

        if ( !element ) {
            return;
        }

        var chart = {
            self: null,
            rendered: false
        };

        var initChart = function() {
            var height = parseInt(KTUtil.css(element, 'height'));
            var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
            var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');

            var baseColor = KTUtil.getCssVariableValue('--bs-primary');
            var baseLightColor = KTUtil.getCssVariableValue('--bs-primary-light');
            var secondaryColor = KTUtil.getCssVariableValue('--bs-info');

            var options = {
                series: [{
                    name: 'Sebelum Perubahan',
                    type: 'bar',
                    stacked: true,
                    data: [40, 50, 65, 70, 50, 30]
                }, {
                    name: 'Selisih Anggaran',
                    type: 'bar',
                    stacked: true,
                    data: [20, 20, 25, 30, 30, 20]
                }, {
                    name: 'Setelah Perubahan',
                    type: 'area',
                    data: [50, 80, 60, 90, 50, 70]
                }],
                chart: {
                    fontFamily: 'inherit',
                    stacked: true,
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        stacked: true,
                        horizontal: false,
                        borderRadius: 4,
                        columnWidth: ['12%']
                    },
                },
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Juls'],
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    max: 120,
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                fill: {
                    opacity: 1
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '12px'
                    },
                    y: {
                        formatter: function (val) {
                            return "$" + val + " thousands"
                        }
                    }
                },
                colors: [baseColor, secondaryColor, baseLightColor],
                grid: {
                    borderColor: borderColor,
                    strokeDashArray: 4,
                    yaxis: {
                        lines: {
                            show: true
                        }
                    },
                    padding: {
                        top: 0,
                        right: 0,
                        bottom: 0,
                        left: 0
                    }
                }
            };

            chart.self = new ApexCharts(element, options);
            chart.self.render();
            chart.rendered = true;
        }

        // Init chart
        initChart();

        // Update chart on theme mode change
        KTThemeMode.on("kt.thememode.change", function() {
            if (chart.rendered) {
                chart.self.destroy();
            }

            initChart();
        });
    }

    // Public methods
    return {
        init: function () {
            initChartsWidget6();
        }
    }
}();

// Webpack support
if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
    module.exports = KTWidgets;
}

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTWidgets.init();
});

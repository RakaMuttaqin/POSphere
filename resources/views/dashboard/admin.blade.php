@extends('layouts.app')

@push('title')
    - Dashboard
@endpush

@push('styles')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/vendors/css/extensions/toastr.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/css/colors.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/css/components.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/css/pages/dashboard-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/css/plugins/charts/chart-apex.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets') }}/css/plugins/extensions/ext-component-toastr.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/style.css">
    <!-- END: Custom CSS-->
@endpush

@section('content-body')
    <!-- Dashboard Ecommerce Starts -->
    <section id="dashboard-ecommerce">
        <div class="row match-height">
            <!-- Statistics Card -->
            <div class="col-xl-12 col-md-12 col-12">
                <div class="card card-statistics">
                    <div class="card-header">
                        <h4 class="card-title">Statistics</h4>
                        <div class="d-flex align-items-center">
                            <p class="card-text font-small-2 me-25 mb-0">Updated
                                {{ Carbon\Carbon::now()->format('d-m-Y H:i:s') }}</p>
                        </div>
                    </div>
                    <div class="card-body statistics-body">
                        <div class="row">
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-primary me-2">
                                        <div class="avatar-content">
                                            <i data-feather="trending-up" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0" id="total-penjualan">0</h4>
                                        <p class="card-text font-small-3 mb-0">Penjualan</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-info me-2">
                                        <div class="avatar-content">
                                            <i data-feather="user" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0" id="total-member">0</h4>
                                        <p class="card-text font-small-3 mb-0">Member</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-danger me-2">
                                        <div class="avatar-content">
                                            <i data-feather="box" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0" id="total-barang">0</h4>
                                        <p class="card-text font-small-3 mb-0">Barang</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-success me-2">
                                        <div class="avatar-content">
                                            <i data-feather="dollar-sign" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0" id="total-pendapatan">Rp 0,00</h4>
                                        <p class="card-text font-small-3 mb-0">Pendapatan</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Statistics Card -->
        </div>

        <div class="row match-height">
            {{-- <div class="col-lg-4 col-12">
                <div class="row match-height">
                    <!-- Bar Chart - Orders -->
                    <div class="col-lg-6 col-md-3 col-6">
                        <div class="card">
                            <div class="card-body pb-50">
                                <h6>Orders</h6>
                                <h2 class="fw-bolder mb-1">2,76k</h2>
                                <div id="statistics-order-chart"></div>
                            </div>
                        </div>
                    </div>
                    <!--/ Bar Chart - Orders -->

                    <!-- Line Chart - Profit -->
                    <div class="col-lg-6 col-md-3 col-6">
                        <div class="card card-tiny-line-stats">
                            <div class="card-body pb-50">
                                <h6>Profit</h6>
                                <h2 class="fw-bolder mb-1">6,24k</h2>
                                <div id="statistics-profit-chart"></div>
                            </div>
                        </div>
                    </div>
                    <!--/ Line Chart - Profit -->

                    <!-- Earnings Card -->
                    <div class="col-lg-12 col-md-6 col-12">
                        <div class="card earnings-card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h4 class="card-title mb-1">Earnings</h4>
                                        <div class="font-small-2">This Month</div>
                                        <h5 class="mb-1">$4055.56</h5>
                                        <p class="card-text text-muted font-small-2">
                                            <span class="fw-bolder">68.2%</span><span> more earnings than last
                                                month.</span>
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <div id="earnings-chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Earnings Card -->
                </div>
            </div> --}}

            <!-- Line Chart Starts-->
            <div class="col-lg-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h4 class="card-title">Pendapatan & Keuntungan</h4>
                            <span class="card-subtitle text-muted">Pendapatan dan Keuntungan perhari selama satu bulan
                                terakhir.</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas class="line-chart-ex chartjs" data-height="250"></canvas>
                    </div>
                </div>
            </div>
            <!-- Line Chart Ends-->
        </div>

    </section>
    <!-- Dashboard Ecommerce ends -->
@endsection

@push('scripts')
    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('app-assets') }}/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets') }}/vendors/js/charts/chart.min.js"></script>
    <script src="{{ asset('app-assets') }}/vendors/js/charts/apexcharts.min.js"></script>
    {{-- <script src="{{ asset('app-assets') }}/vendors/js/extensions/toastr.min.js"></script> --}}
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets') }}/js/core/app-menu.js"></script>
    <script src="{{ asset('app-assets') }}/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets') }}/js/scripts/pages/dashboard-ecommerce.js"></script>

    <script>
        $(window).on('load', function() {
            'use strict';
            var chartWrapper = $('.chartjs'),
                flatPicker = $('.flat-picker'),
                lineChartEx = $('.line-chart-ex');

            // Color Variables
            var primaryColorShade = '#836AF9',
                yellowColor = '#ffe800',
                successColorShade = '#28dac6',
                warningColorShade = '#ffe802',
                warningLightColor = '#FDAC34',
                infoColorShade = '#299AFF',
                greyColor = '#4F5D70',
                blueColor = '#2c9aff',
                blueLightColor = '#84D0FF',
                greyLightColor = '#EDF1F4',
                tooltipShadow = 'rgba(0, 0, 0, 0.25)',
                lineChartPrimary = '#666ee8',
                lineChartDanger = '#ff4961',
                labelColor = '#6e6b7b',
                grid_line_color = 'rgba(200, 200, 200, 0.2)'; // RGBA color helps in dark layout

            // Detect Dark Layout
            if ($('html').hasClass('dark-layout')) {
                labelColor = '#b4b7bd';
            }

            // Wrap charts with div of height according to their data-height
            if (chartWrapper.length) {
                chartWrapper.each(function() {
                    $(this).wrap($('<div style="height:' + this.getAttribute('data-height') +
                        'px"></div>'));
                });
            }

            // Init flatpicker
            if (flatPicker.length) {
                var date = new Date();
                flatPicker.each(function() {
                    $(this).flatpickr({
                        mode: 'range',
                        defaultDate: ['2019-05-01', '2019-05-10']
                    });
                });
            }

            function fetchData() {
                $.ajax({
                    url: "/barang/list", // API endpoint
                    method: "GET",
                    dataType: "json",
                    success: function(response) {
                        var totalBarang = response.barang.length;
                        var totalStok = 0;
                        response.barang.forEach(function(item) {
                            totalStok += item.stok;
                        });
                        $('#total-barang').html(totalBarang);
                        $('#total-stok').html(totalStok);
                    }
                });

                $.ajax({
                    url: "/member/show", // API endpoint
                    method: "GET",
                    dataType: "json",
                    success: function(response) {
                        var totalMember = response.total;
                        $('#total-member').html(totalMember);
                    }
                });

                $.ajax({
                    url: "/penjualan/count", // API endpoint
                    method: "GET",
                    dataType: "json",
                    success: function(response) {
                        var labels = [];
                        var pendapatanData = [];
                        var keuntunganData = [];
                        var totalPenjualan = 0;
                        var totalPendapatan = 0;
                        var totalKeuntungan = 0;

                        // Menghitung total penjualan, pendapatan, dan keuntungan
                        response.penjualan.forEach(function(item) {
                            totalPenjualan += item.penjualan;
                            totalPendapatan += item.pendapatan;
                            totalKeuntungan += item.keuntungan;
                        });

                        // Mengisi data untuk line chart
                        response.penjualan.forEach(function(item) {
                            labels.push(item.tanggal); // Ambil tanggal sebagai label
                            pendapatanData.push(item.pendapatan); // Ambil pendapatan
                            keuntunganData.push(item.keuntungan); // Ambil keuntungan
                        });

                        // Statistic
                        // --------------------------------------------------------------------
                        $('#total-penjualan').html(totalPenjualan);
                        $('#total-pendapatan').html(new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }).format(totalPendapatan));
                        $('#total-keuntungan').html(new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }).format(totalKeuntungan));

                        // Line Chart
                        // --------------------------------------------------------------------
                        if (lineChartEx.length) {

                            // Cari keuntungan terbesar untuk max
                            var maxKeuntungan = Math.max(...keuntunganData);

                            // Cari pendapatan terbesar untuk max
                            var maxPendapatan = Math.max(...pendapatanData);

                            var maxData = maxKeuntungan > maxPendapatan ? maxKeuntungan : maxPendapatan;

                            // Hitung stepSize secara dinamis
                            var stepSize = Math.ceil(maxData /
                                5); // Dibagi 5 agar ada sekitar 5 garis

                            var lineExample = new Chart(lineChartEx, {
                                type: 'line',
                                plugins: [
                                    // to add spacing between legends and chart
                                    {
                                        beforeInit: function(chart) {
                                            chart.legend.afterFit = function() {
                                                this.height += 20;
                                            };
                                        }
                                    }
                                ],
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    backgroundColor: false,
                                    hover: {
                                        mode: 'label'
                                    },
                                    tooltips: {
                                        // Updated default tooltip UI
                                        shadowOffsetX: 1,
                                        shadowOffsetY: 1,
                                        shadowBlur: 8,
                                        shadowColor: tooltipShadow,
                                        backgroundColor: window.colors.solid.white,
                                        titleFontColor: window.colors.solid.black,
                                        bodyFontColor: window.colors.solid.black
                                    },
                                    layout: {
                                        padding: {
                                            top: -15,
                                            bottom: -25,
                                            left: -15
                                        }
                                    },
                                    scales: {
                                        xAxes: [{
                                            display: true,
                                            scaleLabel: {
                                                display: true
                                            },
                                            gridLines: {
                                                display: true,
                                                color: grid_line_color,
                                                zeroLineColor: grid_line_color
                                            },
                                            ticks: {
                                                fontColor: labelColor
                                            }
                                        }],
                                        yAxes: [{
                                            display: true,
                                            scaleLabel: {
                                                display: true
                                            },
                                            ticks: {
                                                stepSize: stepSize,
                                                min: 0,
                                                max: maxData,
                                                fontColor: labelColor
                                            },
                                            gridLines: {
                                                display: true,
                                                color: grid_line_color,
                                                zeroLineColor: grid_line_color
                                            }
                                        }]
                                    },
                                    legend: {
                                        position: 'top',
                                        align: 'start',
                                        labels: {
                                            usePointStyle: true,
                                            padding: 25,
                                            boxWidth: 9
                                        }
                                    }
                                },
                                data: {
                                    labels: labels,
                                    datasets: [{
                                            data: pendapatanData,
                                            label: 'Pendapatan',
                                            borderColor: lineChartPrimary,
                                            lineTension: 0.5,
                                            pointStyle: 'circle',
                                            backgroundColor: lineChartPrimary,
                                            fill: false,
                                            pointRadius: 1,
                                            pointHoverRadius: 5,
                                            pointHoverBorderWidth: 5,
                                            pointBorderColor: 'transparent',
                                            pointHoverBorderColor: window.colors.solid
                                                .white,
                                            pointHoverBackgroundColor: lineChartPrimary,
                                            pointShadowOffsetX: 1,
                                            pointShadowOffsetY: 1,
                                            pointShadowBlur: 5,
                                            pointShadowColor: tooltipShadow
                                        },
                                        {
                                            data: keuntunganData,
                                            label: 'Keuntungan',
                                            borderColor: warningColorShade,
                                            lineTension: 0.5,
                                            pointStyle: 'circle',
                                            backgroundColor: warningColorShade,
                                            fill: false,
                                            pointRadius: 1,
                                            pointHoverRadius: 5,
                                            pointHoverBorderWidth: 5,
                                            pointBorderColor: 'transparent',
                                            pointHoverBorderColor: window.colors.solid
                                                .white,
                                            pointHoverBackgroundColor: warningColorShade,
                                            pointShadowOffsetX: 1,
                                            pointShadowOffsetY: 1,
                                            pointShadowBlur: 5,
                                            pointShadowColor: tooltipShadow
                                        }
                                    ]
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Gagal mengambil data:", error);
                    }
                });

            }
            fetchData();

            setInterval(() => {
                fetchData()
            }, 60000);
        });
    </script>

    <!-- END: Page JS-->
@endpush

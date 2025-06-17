@extends('layout.master')
@push('css')
    <link
        href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.1.6/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/date-1.5.3/fc-5.0.1/fh-4.0.1/r-3.0.3/rg-1.5.0/sc-2.4.3/sb-1.8.0/sl-2.0.5/datatables.min.css"
        rel="stylesheet">
    {{-- cái link nay dể đây vô file master datatable --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="text-muted fw-normal mt-0 text-truncate" title="Campaign Sent">Khách hàng</h5>
                            <h3 class="my-2 py-1">84</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 3.27%</span>
                            </p>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <div id="campaign-sent-chart" data-colors="#727cf5"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="text-muted fw-normal mt-0 text-truncate" title="New Leads">Nhân viên</h5>
                            <h3 class="my-2 py-1">3,254</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> 5.38%</span>
                            </p>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <div id="new-leads-chart" data-colors="#0acf97"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="text-muted fw-normal mt-0 text-truncate" title="Deals">Kho</h5>
                            <h3 class="my-2 py-1">861</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 4.87%</span>
                            </p>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <div id="deals-chart" data-colors="#727cf5"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="text-muted fw-normal mt-0 text-truncate" title="Booked Revenue">Doanh số</h5>
                            <h3 class="my-2 py-1">25322K</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 11.7%</span>
                            </p>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <div id="booked-revenue-chart" data-colors="#0acf97"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="header-title">Tỉ lệ bán của giàn</h4>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:void(0);" class="dropdown-item">Today</a>
                            <a href="javascript:void(0);" class="dropdown-item">Yesterday</a>
                            <a href="javascript:void(0);" class="dropdown-item">Last Week</a>
                            <a href="javascript:void(0);" class="dropdown-item">Last Month</a>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div id="dash-campaigns-chart" class="apex-charts" data-colors="#ffbc00,#727cf5,#0acf97"></div>
                    <div class="row text-center mt-3">
                        <div class="col-sm-4">
                            <i class="mdi mdi-send widget-icon rounded-circle bg-warning-lighten text-warning"></i>
                            <h3 class="fw-normal mt-3">
                                <span>6,510</span>
                            </h3>
                            <p class="text-muted mb-0 mb-2"><i class="mdi mdi-checkbox-blank-circle text-warning"></i>
                                Loại
                                1</p>
                        </div>
                        <div class="col-sm-4">
                            <i class="mdi mdi-flag-variant widget-icon rounded-circle bg-primary-lighten text-primary"></i>
                            <h3 class="fw-normal mt-3">
                                <span>3,487</span>
                            </h3>
                            <p class="text-muted mb-0 mb-2"><i class="mdi mdi-checkbox-blank-circle text-primary"></i>
                                Loại
                                2</p>
                        </div>
                        <div class="col-sm-4">
                            <i class="mdi mdi-email-open widget-icon rounded-circle bg-success-lighten text-success"></i>
                            <h3 class="fw-normal mt-3">
                                <span>1,568</span>
                            </h3>
                            <p class="text-muted mb-0 mb-2"><i class="mdi mdi-checkbox-blank-circle text-success"></i>
                                Loại 3</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="header-title">Thống kê Doanh thu</h4>
                    <form method="GET" action="{{ route('dashboards.index') }}" class="d-flex align-items-center">
                        <label for="start_date" class="me-2">Từ ngày:</label>
                        <input type="date" name="start_date"
                            value="{{ request('start_date', now()->startOfMonth()->toDateString()) }}"
                            class="form-control me-2" style="width: 150px;">
                        <label for="end_date" class="me-2">Đến ngày:</label>
                        <input type="date" name="end_date"
                            value="{{ request('end_date', now()->endOfMonth()->toDateString()) }}"
                            class="form-control me-2" style="width: 150px;">
                        <button type="submit" class="btn btn-primary btn-sm">Lọc</button>
                    </form>
                </div>
                <div class="card-body pt-0">
                    <div class="chart-content-bg">
                        <div class="row text-center">
                            <div class="col-sm-6">
                                <p class="text-muted mb-0 mt-3">Tổng Tiền Xuất</p>
                                <h2 class="fw-normal mb-3">
                                    <span>{{ number_format($currentMonthRevenue ?? 0, 0, ',', '.') }} VNĐ</span>
                                </h2>
                            </div>
                            <div class="col-sm-6">
                                <p class="text-muted mb-0 mt-3">Tổng Tiền Nhập</p>
                                <h2 class="fw-normal mb-3">
                                    <span>{{ number_format($previousMonthRevenue ?? 0, 0, ',', '.') }} VNĐ</span>
                                </h2>
                            </div>
                        </div>
                    </div>

                    <div class="chart-container" style="position: relative; height: 400px;">
                        <canvas id="revenueChart"></canvas>
                    </div>
                    <div class="chart-container" style="position: relative; height: 400px;">
                        <canvas id="dailyChart" width="400" height="200"></canvas>

                    </div>
                    <!-- Biểu đồ theo ngày (thêm mới) -->
                </div>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection

@push('js')
    {{-- đẩy vào javascript     --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // // Debug dữ liệu
            console.log("Months:", @json($months));
            console.log("Import Data:", @json($importData));
            console.log("Export Data:", @json($exportData));
            const ctx = document.getElementById('revenueChart').getContext('2d');
            if (ctx) {
                const revenueChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        //           labels: @json($months) || [],
                        labels: @json($months),
                        datasets: [{
                                label: 'Doanh thu nhập (VNĐ)',
                                data: @json($importData) || [],
                                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Doanh thu xuất (VNĐ)',
                                data: @json($exportData) || [],
                                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Doanh thu (VNĐ)'
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Tháng'
                                }
                            }
                        },
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            } else {
                console.error('Canvas element with id "revenueChart" not found.');
            }
        });

// Biểu đồ theo ngày
    const dailyCtx = document.getElementById('dailyChart').getContext('2d');
    new Chart(dailyCtx, {
        type: 'line',
        data: {
            labels: @json($days),
            datasets: [{
                label: 'Số tiền bán (VND) - Phiếu xuất',
                data: @json($exportDataByDay),
                borderColor: 'rgba(173, 216, 230, 1)', // Màu xanh nhạt
                backgroundColor: 'rgba(173, 216, 230, 0.2)',
                pointBackgroundColor: 'rgba(173, 216, 230, 1)',
                tension: 0.1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Số tiền (VND)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Ngày'
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Thống kê số tiền bán theo ngày (' + @json($startDateDay) + ' - ' + @json($endDateDay) + ')'
                }
            }
        }
    });
        // // Biểu đồ theo ngày
        // const dailyCtx = document.getElementById('dailyChart').getContext('2d');
        // new Chart(dailyCtx, {
        //     type: 'line',
        //     data: {
        //         labels: @json($days),
        //         datasets: [{
        //             label: 'Số tiền bán (VND) - Phiếu xuất',
        //             data: @json($exportDataByDay),
        //             borderColor: 'rgba(173, 216, 230, 1)', // Màu xanh nhạt
        //             backgroundColor: 'rgba(173, 216, 230, 0.2)',
        //             pointBackgroundColor: 'rgba(173, 216, 230, 1)',
        //             tension: 0.1
        //         }]
        //     },
        //     options: {
        //         scales: {
        //             y: {
        //                 beginAtZero: true,
        //                 title: {
        //                     display: true,
        //                     text: 'Số tiền (VND)'
        //                 }
        //             },
        //             x: {
        //                 title: {
        //                     display: true,
        //                     text: 'Ngày'
        //                 }
        //             }
        //         },
        //         plugins: {
        //             title: {
        //                 display: true,
        //                 text: 'Thống kê số tiền bán theo ngày (01/05/2025 - 01/06/2025)'
        //             }
        //         }
        //     }
        // });
    
    </script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Debug dữ liệu
            console.log('Months:', {{ json_encode($months) }});
            console.log('Import Data:', {{ json_encode($importData) }});
            console.log('Export Data:', {{ json_encode($exportData) }});

            const ctx = document.getElementById('revenueChart').getContext('2d');
            const revenueChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($months),
                    datasets: [{
                            label: 'Doanh thu nhập (VNĐ)',
                            data: @json($importData),
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Doanh thu xuất (VNĐ)',
                            data: @json($exportData),
                            backgroundColor: 'rgba(255, 99, 132, 0.5)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Doanh thu (VNĐ)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Tháng'
                            }
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        });
    </script> --}}
@endpush

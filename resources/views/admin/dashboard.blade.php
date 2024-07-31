@extends('admin.layout.template')

@section('title', 'Dashboard')
@section('content')

    <style>
        .coba {
            max-height: 345px;
            min-height: 345px;
            overflow-y: auto;
        }

        .sticky-header {
            position: sticky;
            top: 0;
            background: white;
            z-index: 100;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="row report-inner-cards-wrapper">
                            <div class=" col-md-6 col-xl report-inner-card">
                                <div class="inner-card-text">
                                    <span class="report-title">Total Gaji Bulan
                                        {{ \Carbon\Carbon::now()->subMonth()->translatedFormat('F Y') }}</span>
                                    <h4>Rp. {{ number_format($lastMonthTotalSalary, 0, ',', '.') }}</h4>
                                </div>
                                <div class="inner-card-icon bg-success">
                                    <i class="icon-rocket"></i>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl report-inner-card">
                                <div class="inner-card-text">
                                    <span class="report-title">Permintaan Izin Karyawan Pending</span>
                                    <h4>{{ $totalPermissionRequests }}</h4>
                                </div>
                                <div class="inner-card-icon bg-danger">
                                    <i class="icon-bell"></i>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl report-inner-card">
                                <div class="inner-card-text">
                                    <span class="report-title">Karyawan Bulanan</span>
                                    <h4>{{ $monthlyEmployees }}</h4>
                                </div>
                                <div class="inner-card-icon bg-primary">
                                    <i class="icon-people"></i>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl report-inner-card">
                                <div class="inner-card-text">
                                    <span class="report-title">Karyawan Harian</span>
                                    <h4>{{ $dailyEmployees }}</h4>
                                </div>
                                <div class="inner-card-icon bg-warning">
                                    <i class="icon-people"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Karyawan</h4>
                        <div class="aligner-wrapper">
                            <canvas id="sessionsDoughnutChart" height="210"></canvas>
                            <div class="wrapper d-flex flex-column justify-content-center absolute absolute-center">
                                <h2 class="text-center mb-0 font-weight-bold">{{ $totalEmployees }}</h2>
                                <small class="d-block text-center text-muted  font-weight-semibold mb-0">Total
                                    Karyawan</small>
                            </div>
                        </div>
                        <div class="wrapper mt-4 d-flex flex-wrap align-items-center">
                            <div class="d-flex">
                                <span class="square-indicator bg-danger ml-2"></span>
                                <p class="mb-0 ml-2">Laki-Laki</p>
                            </div>
                            <div class="d-flex">
                                <span class="square-indicator bg-success ml-2"></span>
                                <p class="mb-0 ml-2">Perempuan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="coba col-md-8">
                <div class="card rounded">
                    <div class="card-body mb-0 pt-3">
                        <h4 class="card-title">Daftar Bagian</h4>
                    </div>
                    <div class="card-body mt-0 pt-0">
                        <table class="table table-hover">
                            <thead class="sticky-header">
                                <tr class="text-center">
                                    <th class="font-weight-bold">No</th>
                                    <th class="font-weight-bold">Nama Bagian</th>
                                    <th class="font-weight-bold">Jumlah karyawan</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($activeDepartments as $index => $department)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $department->name }}</td>
                                        <td>{{ $department->employees_count }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Total Gaji Karyawan per Bulan</h4>
                        <div class="aligner-wrapper">
                            <canvas id="totalSalaryChart" height="150"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="col-lg-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Bagian Karyawan</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jumlah Karyawan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($topEmployees as $index => $employee)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $employee->employee->name }}</td>
                                            <td>{{ $employee->employee->NIP }}</td>
                                            <td>Rp. {{ number_format($employee->total_salary, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        (function($) {
            'use strict';
            $(function() {

                var doughnutChartCanvas = $("#sessionsDoughnutChart").get(0).getContext("2d");
                var doughnutPieData = {
                    datasets: [{
                        data: [{{ $femaleEmployees }}, {{ $maleEmployees }}],
                        backgroundColor: [
                            // '#ffca00',
                            '#38ce3c',
                            '#ff4d6b'

                        ],
                        borderColor: [
                            // '#ffca00',
                            '#38ce3c',
                            '#ff4d6b'

                        ],
                    }],

                    labels: [
                        'Prempuan',
                        'Laki-Laki',
                    ]
                };
                var doughnutPieOptions = {
                    cutoutPercentage: 75,
                    animationEasing: "easeOutBounce",
                    animateRotate: true,
                    animateScale: false,
                    responsive: true,
                    maintainAspectRatio: true,
                    showScale: true,
                    legend: {
                        display: false
                    },
                    layout: {
                        padding: {
                            left: 0,
                            right: 0,
                            top: 0,
                            bottom: 0
                        }
                    }
                };
                var doughnutChart = new Chart(doughnutChartCanvas, {
                    type: 'doughnut',
                    data: doughnutPieData,
                    options: doughnutPieOptions
                });

                //Pro purchase banner close
                $('.purchace-popup .popup-dismiss').on('click', function() {
                    $('.purchace-popup').hide();
                })


                // total gaji chart
                var data = {
                    labels: {!! json_encode($labels) !!},
                    datasets: [{
                        label: 'Total Gaji Karyawan',
                        data: {!! json_encode($totalSalaries) !!},
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                };

                var options = {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString();
                                }
                            }
                        }
                    }
                };

                var ctx = document.getElementById('totalSalaryChart').getContext('2d');
                var totalSalaryChart = new Chart(ctx, {
                    type: 'bar',
                    data: data,
                    options: options
                });

            });
        })(jQuery);
    </script>
@endsection

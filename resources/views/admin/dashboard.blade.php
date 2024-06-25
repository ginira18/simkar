@extends('admin.layout.template')

@section('title', 'Dashboard')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Sessions by channel</h4>
                        <div class="aligner-wrapper">
                            <canvas id="sessionsDoughnutChart" height="210"></canvas>
                            <div class="wrapper d-flex flex-column justify-content-center absolute absolute-center">
                                <h2 class="text-center mb-0 font-weight-bold">8.234</h2>
                                <small class="d-block text-center text-muted  font-weight-semibold mb-0">Total Leads</small>
                            </div>
                        </div>
                        <div class="wrapper mt-4 d-flex flex-wrap align-items-cente">
                            <div class="d-flex">
                                <span class="square-indicator bg-danger ml-2"></span>
                                <p class="mb-0 ml-2">Assigned</p>
                            </div>
                            <div class="d-flex">
                                <span class="square-indicator bg-success ml-2"></span>
                                <p class="mb-0 ml-2">Not Assigned</p>
                            </div>
                            <div class="d-flex">
                                <span class="square-indicator bg-warning ml-2"></span>
                                <p class="mb-0 ml-2">Reassigned</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                        data: [55, 25, 20],
                        backgroundColor: [
                            '#ffca00',
                            '#38ce3c',
                            '#ff4d6b'
                        ],
                        borderColor: [
                            '#ffca00',
                            '#38ce3c',
                            '#ff4d6b'
                        ],
                    }],

                    // These labels appear in the legend and in the tooltips when hovering different arcs
                    labels: [
                        'Reassigned',
                        'Not Assigned',
                        'Assigned'
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
            });
        })(jQuery);
    </script>
@endsection

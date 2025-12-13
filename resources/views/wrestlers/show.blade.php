@extends('layouts.master')

@section('page-title', $wrestler->name)

@section('content')
    <section class="no-padding-top no-padding-bottom">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-6">
                            @include('wrestlers.partials.profile')
                        </div>
                        <div class="col-md-6">
                            @include('wrestlers.partials.contract')
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @include('wrestlers.partials.biography')
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    @include('wrestlers.partials.stats')
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var marksCanvas = document.getElementById("myRadarChart");
            if (marksCanvas) {
                var ctx = marksCanvas.getContext('2d');
                var marksData = {
                    labels: ["Draw", "Ability", "Mic Skills", "Charisma", "Hardcore"],
                    datasets: [{
                        label: "{{$wrestler->name}}",
                        backgroundColor: "rgba(54, 162, 235, 0.2)",
                        borderColor: "rgba(54, 162, 235, 1)",
                        pointBackgroundColor: "rgba(54, 162, 235, 1)",
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "rgba(54, 162, 235, 1)",
                        data: [{{$wrestler->draw}}, {{$wrestler->ability}}, {{$wrestler->mic_skills}}, {{$wrestler->charisma}}, {{$wrestler->hardcore}}]
                    }]
                };

                var options = {
                    responsive: true,
                    maintainAspectRatio: false,
                    scale: {
                        ticks: {
                            beginAtZero: true,
                            min: 0,
                            max: 100,
                            stepSize: 20
                        },
                        pointLabels: {
                            fontSize: 12
                        },
                    },
                    legend: {
                        display: false
                    }
                };

                var radarChart = new Chart(ctx, {
                    type: 'radar',
                    data: marksData,
                    options: options
                });
            }
        });
    </script>
@endsection
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="col-md-7 col-md-offset-1">
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
        <div class="col-md-3">
            <div class="col-md-12">
                @include('wrestlers.partials.stats')
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <script>
        var marksCanvas = document.getElementById("myRadarChart");
        var marksData = {
            labels: ["Draw", "Ability", "Mic Skills", "Charisma", "Hardcore"],
            datasets: [{
                label: "",
                backgroundColor: "rgba(800,0,0,0.2)",
                data: [{{$wrestler->draw}}, {{$wrestler->ability}},{{$wrestler->mic_skills}} ,{{$wrestler->charisma}}, {{$wrestler->hardcore}}]
            }]
        };

        var options = {
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

        var radarChart = new Chart(marksCanvas, {
            type: 'radar',
            data: marksData,
            options: options
        });
    </script>
@endsection
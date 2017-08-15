@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Profile</div>
                    <div class="panel-body">
                        <div class="col-md-6">
                            <p>Name</p>
                            <p>Age</p>
                            <p>Weight</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-right">{{$wrestler->name}}</p>
                            <p class="text-right">{{$wrestler->age}}</p>
                            <p class="text-right">{{$wrestler->weight}}weight</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Contract</div>
                    <div class="panel-body">
                        <div class="col-md-6 hidden-sm-down">
                            <p>Promotion</p>
                            <p>Salary (p/m)</p>
                            <p>Expires</p>
                        </div>
                        <div class="col-md-6 hidden-sm-down">
                            @if($wrestler->promotion)
                                <p class="text-right">{{$wrestler->promotion->name}}</p>
                            @else
                                <p>n/a</p>
                            @endif
                            <p class="text-right">$20,000</p>
                            <p class="text-right">10/10/2019</p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Skills</div>
                    <div class="panel-body">
                        <canvas id="myRadarChart" width="100" height="100"></canvas>
                    </div>
                </div>
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
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

<div class="block">
    <div class="title"><strong>Contract</strong></div>
    <div class="block-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Promotion:</strong></p>
                <p><strong>Salary (p/m):</strong></p>
                <p><strong>Disposition:</strong></p>
            </div>
            <div class="col-md-6">
                @if($wrestler->promotion)
                    <p>{{$wrestler->promotion->name}}</p>
                @else
                    <p>Free Agent</p>
                @endif
                <p>${{number_format($wrestler->salary ?? 0)}}</p>
                <p>{{$wrestler->disposition}}</p>
            </div>
        </div>
    </div>
</div>

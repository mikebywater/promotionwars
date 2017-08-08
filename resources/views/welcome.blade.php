<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Promotion Wars Online</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>


<div class="container">
    <div class="row">
        <div class="span4"></div>
        <div class="span4"><img class="center-block" style="margin-top:200px; margin-bottom:50px" src="img/banner.jpg" /></div>
        <div class="span4"></div>
    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 text-center"><a class="btn btn-primary" href="/home">Continue</a></div>
        <div class="col-md-4"></div>
    </div>
</div>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Promotion Wars Online</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="/css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="/css/style.default.premium.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<body>
   @include('layouts.partials.header')
<div class="d-flex align-items-stretch">
    @include('layouts.partials.sidebar')
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Dashboard</h2>
            </div>
        </div>
@yield('content')
        <footer class="footer">
            <div class="footer__block block no-margin-bottom">
                <div class="container-fluid text-center">
                    <p class="no-margin-bottom">Promotion Wars Online</p>
                </div>
            </div>
        </footer>
    </div>
</div>
<!-- JavaScript files-->
<script src="/vendor/jquery/jquery.min.js"></script>
<script src="/vendor/popper./js/umd/popper.min.js"> </script>
<script src="/vendor/bootstrap//js/bootstrap.min.js"></script>
<script src="/vendor/jquery.cookie/jquery.cookie.js"> </script>
<script src="/vendor/chart./js/Chart.min.js"></script>
<script src="/vendor/jquery-validation/jquery.validate.min.js"></script>
<script src="/js/charts-home.js"></script>
<!-- Notifications-->
<script src="/vendor/messenger-hubspot/build//js/messenger.min.js">   </script>
<script src="/vendor/messenger-hubspot/build//js/messenger-theme-flat.js">       </script>
<script src="/js/front.js"></script>
</body>
</html>

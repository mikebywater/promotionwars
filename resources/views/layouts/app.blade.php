<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
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
<body>
<div id="app">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="/">
                    <img src="/img/banner.jpg" height="40"/>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">

                    <li><a href="/home">Home</a></li>
                    <li><a href="/promotions">Promotions</a></li>
                    <li><a href="/wrestlers">Wrestlers</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Feedback</a></li>
                                <li><a href="#">Inbox</a></li>
                                <li class="divider"></li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>

                <form class="navbar-form navbar-right" id="search-form">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search for a wrestler" id="search-bar">
                    </div>
                    <button type="submit" class="btn btn-default">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <strong>Current Game: {{ \App\Repositories\Game\Game::find(session('game_id')) }} </strong>
    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script>
    $(document).ready(function() {
        $("#search-form").submit(function(event) {
            event.preventDefault();

            var searchTerm = $("#search-bar").val();

            if (searchTerm.length < 2) {
                return false;
            }

            window.location.href = "/search?q="+ searchTerm;
        });

        $("#search-bar").keypress(function(event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);

            if (keycode == '13') {
                event.preventDefault();
                var searchTerm = $(this).val();

                if (searchTerm.length < 2) {
                    return false;
                }

                window.location.href = "/search?q="+ searchTerm;	
            }
        });
    });
</script>
@yield('scripts')
</body>
</html>

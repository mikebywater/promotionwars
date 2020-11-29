<header class="header">
    <nav class="navbar navbar-expand-lg">
        <div class="search-panel">
            <div class="search-inner d-flex align-items-center justify-content-center">
                <div class="close-btn">Close <i class="fa fa-close"></i></div>
                <form id="searchForm" action="/search">
                    <div class="form-group">
                        <input type="search" name="q" placeholder="What are you searching for..." autocomplete="off">
                        <button type="submit" class="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <div class="navbar-header">
                <!-- Navbar Header--><a href="index.html" class="navbar-brand">
                    <div class="brand-text brand-big visible text-uppercase"><img src="/img/banner5.png" style="height: 50px; margin: -10px 20px -10px;"></div>
                    <div class="brand-text brand-sm"><strong class="text-primary">D</strong><strong>A</strong></div></a>
                <!-- Sidebar Toggle Btn-->
                <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
            </div>
            <div class="right-menu list-inline no-margin-bottom">
                <div class="list-inline-item"><a href="#" class="search-open nav-link"><i class="icon-magnifying-glass-browser"></i></a></div>
                <div class="list-inline-item dropdown"><a id="navbarDropdownMenuLink1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link messages-toggle"><i class="icon-email"></i><span class="badge dashbg-1">5</span></a>
                    <div aria-labelledby="navbarDropdownMenuLink1" class="dropdown-menu messages"><a href="#" class="dropdown-item message d-flex align-items-center">
                            <div class="profile"><img src="img/avatar-3.jpg" alt="..." class="img-fluid">
                                <div class="status online"></div>
                            </div>
                            <div class="content">   <strong class="d-block">Nadia Halsey</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">9:30am</small></div></a><a href="#" class="dropdown-item message d-flex align-items-center">
                            <div class="profile"><img src="img/avatar-2.jpg" alt="..." class="img-fluid">
                                <div class="status away"></div>
                            </div>
                            <div class="content">   <strong class="d-block">Peter Ramsy</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">7:40am</small></div></a><a href="#" class="dropdown-item message d-flex align-items-center">
                            <div class="profile"><img src="img/avatar-1.jpg" alt="..." class="img-fluid">
                                <div class="status busy"></div>
                            </div>
                            <div class="content">   <strong class="d-block">Sam Kaheil</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">6:55am</small></div></a><a href="#" class="dropdown-item message d-flex align-items-center">
                            <div class="profile"><img src="img/avatar-5.jpg" alt="..." class="img-fluid">
                                <div class="status offline"></div>
                            </div>
                            <div class="content">   <strong class="d-block">Sara Wood</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">10:30pm</small></div></a><a href="#" class="dropdown-item text-center message"> <strong>See All Messages <i class="fa fa-angle-right"></i></strong></a></div>
                </div>
                <!-- Log out               -->
                <div class="list-inline-item logout">

                    <li>
                        <a id="logout" class="nav-link" href="{{ route('logout') }}"  onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                            <span class="d-none d-sm-inline">Logout </span><i class="icon-logout"></i>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </div>
            </div>
        </div>
    </nav>
</header>
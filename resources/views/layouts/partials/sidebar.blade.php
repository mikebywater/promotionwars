<!-- Sidebar Navigation-->
<nav id="sidebar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center"><a href="pages-profile.html">
            <div class="avatar"><img src="img/avatar.jpg" alt="..." class="img-fluid rounded-circle"></div></a>
        <div class="title">
            <h1 class="h5">{{session('game')->promoter_name}}</h1>
            <p>{{session('promotion') ? session('promotion')->short_name : 'Unemployed'}} </p>
        </div>
    </div>
    <!-- Sidebar Navidation Menus--><span class="heading">My Promotion</span>
    <ul class="list-unstyled">

        <li class="active"><a href="/roster"> <i class="icon-grid"></i>Roster </a></li>
        <li><a href="/feuds"> <i class="icon-home"></i>Feuds</a></li>
        <li><a href="/championships"> <i class="icon-home"></i>Championships</a></li>
        <li><a href="/shows"> <i class="icon-home"></i>Shows</a></li>
        <li><a href="/feedback"> <i class="icon-home"></i>Feedback</a></li>
        <li><a href="/camp"> <i class="icon-home"></i>Training Camp</a></li>
        <li><a href="/stables"> <i class="icon-home"></i>Tag Teams / Stables</a></li>

        <li><a href="#financesDropdown" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-bar-chart"></i>Finances</a>
            <ul id="financesDropdown" class="collapse list-unstyled ">
                <li><a href="/prices"></a></li>
                <li><a href="/p-and-l">Profit and Loss</a></li>
            </ul>
        </li>
    </ul><span class="heading">Game World</span>
    <ul class="list-unstyled">
        <li> <a href="#"> <i class="icon-settings"></i>Other Wrestlers</a></li>
        <li> <a href="#"> <i class="icon-writing-whiteboard"></i>Other Promotions</a></li>
        <li> <a href="#"> <i class="icon-chart"></i>Rankings</a></li>
    </ul>
</nav>
<!-- Sidebar Navigation end-->
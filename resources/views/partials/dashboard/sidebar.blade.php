<div class="navbar nav_title" style="border: 0;">
    <a href="{{ route('dashboard.home') }}" class="site_title">
        <i class="fa fa-sellsy"></i> <span>Dashboard</span>
    </a>
</div>

<div class="clearfix"></div>

<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <ul class="nav side-menu">
            <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-home"></i> Главная</a></li>

            <li>
                <a><i class="fa fa-address-card"></i> Опросы<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    {{--TODO change links--}}
                    <li><a href="#">Список</a></li>
                    <li><a href="#">Добавить новый</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /sidebar menu -->
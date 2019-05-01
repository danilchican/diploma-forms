<div class="navbar nav_title" style="border: 0;">
    <a href="{{ route('dashboard.home') }}" class="site_title">
        <i class="fa fa-sellsy"></i> <span>Админ-панель</span>
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
                    <li><a href="{{ route('dashboard.forms.create') }}">Добавить новый</a></li>
                    <li><a href="#">Список опросов</a></li>
                    <li><a href="#">Готовые шаблоны</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /sidebar menu -->
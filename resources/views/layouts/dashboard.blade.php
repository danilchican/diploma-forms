<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.dashboard.head')
</head>
<body class="nav-md">
<div id="app">
    <div class="container body">
        <div class="main_container">

            @include('partials.dashboard.header')

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    @include('partials.dashboard.sidebar')
                </div>
            </div>

            <!-- page content -->
            <div class="right_col" role="main">
                @yield('content')
            </div>
            <!-- /page content -->
        </div>
    </div>
</div>

<script src="{{ asset('js/dashboard.js') }}"></script>
@stack('scripts')
</body>
</html>
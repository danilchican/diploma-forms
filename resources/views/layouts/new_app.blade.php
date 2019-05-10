<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}{{ isset($subtitle) ? ' - ' . $subtitle : '' }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

@include('partials.common.header')

<div class="container">
    @yield('content')
</div>
<footer>
    <div class="container">
        <hr>
        <ul id="footer-blocks">
            <li class="col-md-4" style="padding-left:0">
                <img width="200" class="footer-logo" src="{{ asset('/images/logo.jpg') }}" alt="Кафедра менеджмента БГУИР"/>
            </li>
            <li class="col-md-4 text-center">
                <p style="padding-top: 10px;"><i>+375(17)293-86-46<br/>+375(17)293-88-26</i></p>
            </li>
            <li class="col-md-4">
                <span style="padding-top: 20px" class="pull-right">
                    &copy; Кафедра менеджмента, 2019, <a href="mailto:kafman@bsuir.by">kafman@bsuir.by</a>
                </span>
            </li>
        </ul>
    </div>
</footer>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>

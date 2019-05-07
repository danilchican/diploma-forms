{{--TODO rename--}}
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
<div class="container">
    <hr>
    <footer>
        <p>
            <span>&copy; Кафедра менеджмента, 2019, <a href="mailto:kafman@bsuir.by">kafman@bsuir.by</a></span>
            <span class="pull-right"><i>+375(17)293-86-46, +375(17)293-88-26</i></span>
        </p>
    </footer>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

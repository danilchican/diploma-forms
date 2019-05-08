<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - Вход в систему</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
</head>

<body class="login">
<div>
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="auth-content">
                <form id="login-form" method="post" action="{{ route('login') }}">
                    <h1>Вход в систему</h1>
                    {{ csrf_field() }}

                    <div class="auth-content-field">
                        <input name="email" type="email" id="email" value="{{ old('email') }}"
                               placeholder="Email" required="required" autofocus
                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"/>

                        @if ($errors->has('email'))
                            <div class="invalid-auth-field" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="auth-content-field">
                        <input name="password" type="password" id="password" required="required"
                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                               placeholder="Пароль"/>

                        @if ($errors->has('password'))
                            <div class="invalid-auth-field" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="auth-content-field remember-field">
                        <input type="checkbox" name="remember"
                               id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">Запомнить меня</label>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary submit">Войти</button>
                        <a class="reset_pass" href="{{ route('password.request') }}">Забыли пароль?</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="separator">
                        <div>
                            <p>&copy;<script>document.write(new Date().getFullYear())</script>
                                Все права защищены. <a href="{{ config('app.url') }}">{{ config('app.name') }}</a></p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
</body>
</html>
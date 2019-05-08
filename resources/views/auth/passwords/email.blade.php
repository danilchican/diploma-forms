<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - Восстановление пароля</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
</head>

<body class="login">
<div>
    <div class="reset-password-wrapper">
        <div class="animate form login_form">
            <section class="auth-content">
                <form id="reset-password-form" method="post" action="{{ route('password.email') }}">
                    <h1>Восстановление пароля</h1>

                    <div class="reset-form-wrapper">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

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
                        <div>
                            <button type="submit" class="btn btn-primary submit">
                                Отправить ссылку для восстановления
                            </button>
                        </div>
                        <div class="clearfix"></div>
                        <div class="reset-password-block">
                            <a class="reset_pass" href="{{ route('login') }}">Уже зарегистрированы?</a>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">
                            <div>
                                <p>&copy;<script>document.write(new Date().getFullYear())</script>
                                    Все права защищены. <a href="{{ config('app.url') }}">{{ config('app.name') }}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
</body>
</html>
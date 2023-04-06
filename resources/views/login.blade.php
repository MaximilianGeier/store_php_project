<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ mix('css/reset.css') }}"/>
        <link rel="stylesheet" href="{{ mix('css/global.css') }}"/>
        <link rel="stylesheet" href="{{ mix('css/login.css') }}"/>
        <title>Leichtigkeit</title>
    </head>
    <body>
        <div class="login__background">
            <h2 class="login__title">Log in</h2>
            <ul>
                @foreach($errors->all() as $err)
                    <li class="login__error-msg">{{$err}}</li>
                @endforeach
            </ul>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <input value="{{ old('nickname') }}" autofocus {{ $errors->has('nickname') ? 'error' : '' }} placeholder="ник" name="nickname" type="text"/>
                <input {{ $errors->has('password') ? 'error' : '' }} placeholder="пароль" name="password" type="password"/>
                <div>
                    <input name="remember" type="checkbox"/>
                    <span>Remember me</span>
                </div>
                <button class="standart_btn" type="submit">Вход</button>
            </form>
            <a href="{{ route('home') }}">Вернуться на главную</a>
        </div>
    </body>
</html>

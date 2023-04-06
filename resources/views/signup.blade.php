<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ mix('css/reset.css') }}"/>
    <link rel="stylesheet" href="{{ mix('css/global.css') }}"/>
    <link rel="stylesheet" href="{{ mix('css/signup.css') }}"/>
    <title>Leichtigkeit</title>
</head>
<body>
<div class="signup__background">
    <h2 class="signup__title">Sign up</h2>
    <ul>
        @foreach($errors->all() as $err)
            <li class="signup__error-msg">{{$err}}</li>
        @endforeach
    </ul>
    <form action="{{ route('register') }}" method="post">
        @csrf
        <label>
            <input value="{{ old('nickname') }}" autofocus {{ $errors->has('nickname') ? 'error' : '' }} placeholder="ник" name="nickname" type="text"/>
        </label>
        <label>
            <input value="{{ old('first_name') }}" {{ $errors->has('first_name') ? 'error' : '' }} placeholder="имя" name="first_name" type="text"/>
        </label>
        <label>
            <input value="{{ old('last_name') }}" {{ $errors->has('last_name') ? 'error' : '' }} placeholder="фамилия" name="last_name" type="text"/>
        </label>
        <label>
            @error('email')
            <p>{{ $message }}</p>
            @enderror
            <input value="{{ old('email') }}" {{ $errors->has('email') ? 'error' : '' }} placeholder="почта" name="email" type="email"/>
        </label>
        <label>
            <input {{ $errors->has('password') ? 'error' : '' }} placeholder="пароль" name="password" type="password"/>
        </label>
        <label>
            <input placeholder="подтвердить пароль (кивни)" name="password_confirmation" type="password"/>
        </label>

        <button class="standart_btn" type="submit">Регистрация</button>
    </form>
    <a href="{{ route('home') }}">Вернуться на главную</a>
</div>
</body>
</html>

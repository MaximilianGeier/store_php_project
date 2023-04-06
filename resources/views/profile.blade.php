<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}"/>
    <link rel="stylesheet" href="{{ mix('css/profile.css') }}"/>
    <title>Leichtigkeit</title>
</head>
<body>
<style>
    .admin__form{
        margin-top: 30px;
    }
    .standart_btn{
        margin-top: 20px;
    }
</style>
<div class="wrapper">
    <div class="container">
        @include('view.header')
        <form class="profile__form" action="{{ route('profile') }}" method="post">
            <ul>
                @foreach($errors->all() as $err)
                    <li class="profile__error-msg">{{$err}}</li>
                @endforeach
            </ul>
            @csrf
            <p>Ник:</p>
            <input value="{{ $user->nickname }}" name="nickname" type="text">

            <p>Почта:</p>
            <input value="{{ $user->email }}" name="email" type="email">

            <p>Пароль:</p>
            <input placeholder="**********" name="password" type="password">

            <button type="submit" class="order__cancel-btn standart_btn">
                <p>Изменить данные</p>
            </button>
        </form>
    </div>
    @include('view.footer')
</div>
</body>
</html>

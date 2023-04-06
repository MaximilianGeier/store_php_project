<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}"/>
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

        <form class="admin__form" action="{{ route('admin') }}" method="post">
            @csrf
            <p>Ник пользователя:</p>
            <input placeholder="nickname" name="nickname" type="text">

            <button name="action" value="seller" type="submit" class="order__cancel-btn standart_btn">
                <p>Изменить статус продавца</p>
            </button>
            <button name="action" value="admin" type="submit" class="order__cancel-btn standart_btn">
                <p>Изменить статус админа</p>
            </button>
            <button name="action" value="del" type="submit" class="order__cancel-btn standart_btn">
                <p>Удалить пользователя</p>
            </button>
        </form>
    </div>
    @include('view.footer')
</div>
</body>
</html>

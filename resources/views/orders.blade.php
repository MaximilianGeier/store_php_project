<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}"/>
    <link rel="stylesheet" href="{{ mix('css/order.css') }}"/>

    <title>Leichtigkeit</title>
</head>
<body>
<div class="wrapper">
    <div class="container">
        @include('view.header')

        <div class="orders">
            @foreach($orders as $order)
                <div class="order">
                    <img class="order__img" src="{{ asset('/storage/'. $order->path) }}" alt="">
                    <h2 class="order__title">{{ $order['name'] }}</h2>
                    <div class="order__wrapper">
                        <p>Дата заказа: <span class="order__date">{{ $order['created_at'] }}</span></p>
                        <p>Стоимость: $<span class="order__price">{{ $order['price'] * $order['ordered_count'] }}</span></p>
                    </div>
                    <form class="cancel__form" action="{{ route('orders.cancel') }}" method="post" >
                        @csrf
                        <button type="submit" name="order_id" value="{{ $order['id'] }}" class="order__cancel-btn standart_btn">
                            <p>Отменить заказ</p>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
    @include('view.footer')
</div>
</body>
</html>

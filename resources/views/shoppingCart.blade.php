<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}"/>
    <link rel="stylesheet" href="{{ mix('css/order.css') }}"/>
    <link rel="stylesheet" href="{{ mix('css/shoppingCart.css') }}"/>

    <title>Leichtigkeit</title>
</head>
<body>
<div class="wrapper">
    <div class="container">
        @include('view.header')

        <form action="{{ route('order.add') }}" method="post">
            @csrf
            <div class="products">
                @foreach($products as $product)
                    <div class="product">
                        <img class="order__img" src="{{ asset('/storage/'. $product->path) }}" alt="">
                        <h2 class="product__title">{{ $product['name'] }}</h2>
                        <div class="order__wrapper">
                            <p>Количество: <span class="product__count">{{ $product['ordered_count'] }}</span></p>
                            <p>Стоимость: $<span class="product__price">{{ $product['ordered_count'] * $product['price'] }}</span></p>
                        </div>
                        <input type="checkbox" name="{{ $product['id'] }}">
                    </div>
                @endforeach
            </div>
            <button type="submit" class="order__cancel-btn standart_btn" href="#">
                <p>Перейти к оформлению</p>
            </button>
        </form>
    </div>
    @include('view.footer')
</div>
</body>
</html>

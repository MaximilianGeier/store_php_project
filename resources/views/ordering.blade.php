<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}"/>
    <link rel="stylesheet" href="{{ mix('css/ordering.css') }}"/>

    <title>Leichtigkeit</title>
</head>
<body>
<div class="wrapper">
    <div class="container">
        @include('view.header')

        <div class="order__wrapper">
            <div>
                <div class="products">
                    @foreach($products as $product)
                        <div class="product">
                            <img class="order__img" src="{{ asset('/storage/'. $product['path']) }}" alt="">
                            <h2 class="product__title">{{ $product['name'] }}</h2>
                            <div class="product__wrapper">
                                <p>Количество: <span class="product__count">{{ $product['ordered_count'] }}</span></p>
                                <p>Стоимость: $<span class="product__price">{{ $product['ordered_count'] * $product['price'] }}</span></p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <form action="{{ route('order.make') }}" method="post" class="order__info">
                @csrf
                <p>Общая сумма заказа: <span></span></p>
                <div>
                    <p class="order__address">Адрес доставки:</p>
                    <input name="address" placeholder="г. Челябинск, ул. Братьев Кашириных, 129, кв. 42" type="text"/>
                </div>
                <input type="hidden" name="allID" value="{{ $allID }}"/>
                <input type="hidden" name="products" value="{{ json_encode($products) }}"/>
                <button class="standart_btn" type="submit">
                    <p>Заказать</p>
                </button>
            </form>
        </div>
    </div>
    @include('view.footer')
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ mix('css/reset.css') }}"/>
    <link rel="stylesheet" href="{{ mix('css/global.css') }}"/>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}"/>
    <link rel="stylesheet" href="{{ mix('css/style.css') }}"/>
    <link rel="stylesheet" href="{{ mix('css/product.css') }}"/>

    <title>Leichtigkeit</title>
</head>
<body>
<div class="wrapper">
    <div class="container">
        @include('view.header')
        <div class="container">
            <div class="preview">
                <img class="product__img" src="{{ asset('/storage/'. $product->path) }}" alt="">
                <div class="product__wrapper">
                    <h2>{{ $product->name }}</h2>
                    <form action="{{ route('product.add') }}" method="post">
                        @csrf
                        <input placeholder="количество" type="number" name="count">
                        <input type="hidden" name="product_id" value="{{ $product->id }}" />
                        <button type="submit" class="standart_btn">
                            <p>Заказать</p>
                        </button>
                    </form>
                </div>
            </div>
            <div class="product__description">
                <p>Описание:</p>
                {{ $product->description }}
            </div>
        </div>
    </div>
    @include('view.footer')
</div>
</body>
</html>

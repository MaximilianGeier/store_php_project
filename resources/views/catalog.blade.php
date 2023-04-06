<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/app.css">
    <link rel="stylesheet" href="./css/filters.css">
    <title>Leichtigkeit</title>
</head>
<body>
<div class="container">
    @include('view.header')
</div>

<div class="container">
    <form class="filters" method="post" action="{{ route('catalog') }}">
        @csrf
        <div class="category">
            <span>Выбрать категорию:</span>
            <select name="category" size="1">
                @foreach($categories as $category)
                    <option selected value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="sort-by">
            <span>Сортировать по:</span>
            <select size="1" name="sortby">
                <option selected value="new">Лучший рейтинг</option>
                <option value="min_price">По цене</option>
            </select>
        </div>
        <div class="price">
            <span>Цена от:</span>
            <input name="price_from" type="number">

            <span>Цена до:</span>
            <input name="price_to" type="number">
        </div>
        <button type="submit" class="standart_btn">
            <p>Применить</p>
        </button>
    </form>
</div>

<div class="container">
    <div class="catalog">
        <div class="catalog__content">
            @foreach($products as $product)
                <div class="product_card" onclick="window.location='{{ url('/product', $product->id) }}'">
                    <div class="product_card-img">
                        <img src="{{ asset('/storage/'. $product->path) }}" alt="изображение не найдено">
                    </div>
                    <div class="product_card-title">
                        <p>{{ $product->name }}</p>
                    </div>
                    <div class="product_card-price">
                        <p>${{ $product->price }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@include('view.footer')
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}"/>
        <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-element-bundle.min.js"></script>
        <title>Leichtigkeit</title>
    </head>
    <body>
    <div class="container">
        @include('view.header')
    </div>

    <div class="container">
        <div class="ad">
            <swiper-container>
                <swiper-slide><img src="{{ asset('./images/ad1.png') }}"/></swiper-slide>
                <swiper-slide><img src="{{ asset('./images/ad3.png') }}"/></swiper-slide>
            </swiper-container>
        </div>
    </div>

    <div class="categories">
        <div class="categories__top">
            <h2>Категории</h2>
            <a href="{{ route('catalog') }}" class="standart_btn">
                <p>Показать все</p>
            </a>
        </div>
        <div class="categories__content">
            @foreach($categories as $category)
                <div class="categories__content-card">
                    <div class="card-img">
                        <img src="./images/pen.svg" alt="">
                    </div>
                    <div class="card-title">
                        <p>{{ $category->name }}</p>
                    </div>
                </div>
            @endforeach
        </div>
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
        {{ $products->links('vendor.pagination.custom') }}
    </div>

    @include('view.footer')
    </body>
</html>

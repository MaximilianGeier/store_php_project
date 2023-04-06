<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}"/>
    <link rel="stylesheet" href="{{ mix('css/productAdding.css') }}"/>
    <title>Leichtigkeit</title>
</head>
<body>
    <div class="container">
        @include('view.header')
    </div>
    <div class="container">
        <h2 store__title>Название магазина</h2>
        <a class="standart_btn" href="#">
            <p>Изменить название</p>
        </a>

        <h2 class="store__subtitle">Добавление товара</h2>
        <div class="store__product">
            <form action="{{ route('store.add') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field()}}
                <div class="product__form-group">
                    <input type="file" name="image">
                    <div class="product__wrapper">
                        <input placeholder="Название товара" type="text" name="name">
                        <input placeholder="Количество" type="number" name="count">
                        <input placeholder="Цена $" type="number" name="price">
                        <textarea placeholder="Описание товара" type="text" name="description"></textarea>
                        <div>
                            <p>Категория:</p>
                            <select name="category" size="1">
                                @foreach($categories as $category)
                                    <option selected value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <button class="standart_btn" type="submit">
                    <p>
                        Добавить товар
                    </p>
                </button>
            </form>
        </div>
    </div>
    @include('view.footer')
</body>
</html>

# Интернет магазин на php
## Запуск
php artisan serve --port=8080  
Могут возникнуть проблемы из-за плагина xethron/migrations-generator. В этом случае можно удалить его (composer remove --dev "xethron/migrations-generator") или в файле config/app.php убрать строки:
        Way\Generators\GeneratorsServiceProvider::class,
        Xethron\MigrationsGenerator\MigrationsGeneratorServiceProvider::class,

## Описание технической части
Взаимодействие с БД происходит через модели.
Все страницы сверстаны с использованием blade php
Контроль доступа для разных ролей пользователей осуществляется через middleware

## Описание функционала сайта:
На всех страницах доступен одина шапка с полем ввода для поиска по каталогу (поиск через простой запрос к БД с like)
![image](https://user-images.githubusercontent.com/29898413/231755685-7151b16c-7c2c-448c-9222-d79682975dc3.png)

Страница заказов с возможностью отмены заказов:
![image](https://user-images.githubusercontent.com/29898413/231756051-396fb80f-a109-4e52-a625-1982f6ec832f.png)

Корзина (вобор товаров и переход к оформлению):
![image](https://user-images.githubusercontent.com/29898413/231756221-db0bc6c3-2ec3-42a8-b065-6c3ac0de6eeb.png)

Страница оформления товара (передается только адрес, так как остальные данные покупателя нам уже известны):
![image](https://user-images.githubusercontent.com/29898413/231756407-3c9082c1-8272-4705-bc01-aa44d62d0005.png)


В админ панели можно менять статус других поьзователей по нику:
![image](https://user-images.githubusercontent.com/29898413/231756614-2c175e23-b7a8-44d3-96d5-a7e4344c4cf0.png)

Страница входа (с валидацией полей и отображением ошибок): 
![image](https://user-images.githubusercontent.com/29898413/231756809-cea3546e-fab3-4979-b6ef-fb50401bff12.png)

Страница регистрации (все поля также валидируются)
![image](https://user-images.githubusercontent.com/29898413/231757017-570a8b75-bd89-4bd7-b6c7-e756fe728078.png)

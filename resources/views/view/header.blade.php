<header class="header">
    <a href="{{ route('home') }}">
        <img src="{{ asset('./images/Leichtigkeit.svg') }}" alt="Leichtigkeit" class="logo">
    </a>
    <div class="search">
        <form action="{{ route('search') }}" method="post">
            @csrf
            <input name="search" type="text" placeholder="Поиск"/>
            <button type="submit">
                <img src="{{ asset('./images/search.svg') }}" alt="search">
            </button>
        </form>
    </div>
    <nav class="menu">
        <div class="profile">
            <img class="profile__img" src="{{ asset('./images/profile.svg') }}" alt="profile">
            <ul class="sub-menu">
                @guest()
                    <li><a href="{{ route('register') }}">Регистрация</a></li>
                    <li><a href="{{ route('login') }}">Вход</a></li>
                @endguest
                @auth()
                    <li><a href="{{ route('orders') }}">Заказы</a></li>
                    <li><a href="{{ route('profile') }}">Профиль</a></li>
                    @if(\Illuminate\Support\Facades\Auth::user()->isSeller())
                            <li><a href="{{ route('store') }}">Добавить товар</a></li>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                        <li><a href="{{ route('admin') }}">Админка</a></li>
                    @endif
                    <li>
                        <form method="get" action="{{route('logout')}}">
                            @csrf
                            <a href="{{ route('logout') }}" class="profile" onclick="event.preventDefault(); this.closest('form').submit()">Выйти
                            </a>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>

        <a href="{{ route('cart') }}" class="cart">
            <img src="{{ asset('./images/cart.svg') }}" alt="">
        </a>
    </nav>
</header>

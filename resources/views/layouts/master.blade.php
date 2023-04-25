<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@lang('main.online_shop'): @yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/starter-template.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('index') }}">@lang('main.online_shop')</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li  class="nav-item ms-1 @routeactive('index')" >
                    <a href="{{ route('index') }}" class="text-decoration-none text-reset">@lang('main.all_products')</a>
                </li>
                <li class="nav-item ms-1 @routeactive('categor*')">
                    <a href="{{ route('categories') }}" class="text-decoration-none text-reset">Категории</a>
                </li>
                <li class="nav-item ms-1 @routeactive('basket*')">
                    <a href={{ route('basket') }} class="text-decoration-none text-reset">В корзину</a>
                </li>
                <li class="nav-item ms-1">
                    <a href="{{ route('reset') }}" class="text-decoration-none text-reset">Сбросить проект в начальное состояние</a>
                </li>
                <li class="nav-item ms-1">
                    <a href="{{ route('locale', __('main.set_lang')) }}" class="text-decoration-none text-reset">@lang('main.set_lang')</a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @guest()
                    <li >
                        <a href="{{ route('login') }}" class="text-decoration-none text-reset">
                            Войти
                        </a>
                    </li>
                @endguest
                @auth
                    @admin
                        <li>
                            <a href="{{ route('home') }}" class="text-decoration-none text-reset">
                                Панель администратора
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('person.orders.index') }}" class="text-decoration-none text-reset">
                                Мои заказы
                            </a>
                        </li>
                    @endadmin
                        <li class="ms-2">
                            <a href="{{ route('get-logout') }}" class="text-decoration-none text-reset">
                                Выйти
                            </a>
                        </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>


<div class="container">
    <div class="starter-template">
        @if(session()->has('success'))
            <p class="alert alert-success">{{ session('success') }}</p>
        @endif
        @if(session()->has('warning'))
        <p class="alert alert-danger">{{ session('warning') }}</p>
    @endif
        @yield('content')
    </div>
</div>
</body>
</html>

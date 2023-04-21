<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Интернет Магазин: @yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/starter-template.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('index') }}">Интернет Магазин</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li  class="nav-item ms-2 active" ><a href="{{ route('index') }}">Все товары</a>
                </li>
                <li class="nav-item ms-2"><a href="{{ route('categories') }}">Категории</a>
                </li>
                <li class="nav-item ms-2"><a href={{ route('basket') }} >В корзину</a>
                </li>
                <li class="nav-item ms-2"><a href="{{ route('index') }}">Сбросить проект в начальное состояние</a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @guest()
                    <li ><a href="{{ route('login') }}">Панель администратора</a></li>
                @endguest
                @auth
                    <li class="me-2"><a href="{{ route('home') }}">Панель администратора</a></li>
                    <li ><a href="{{ route('get-logout') }}">Выйти</a></li>
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

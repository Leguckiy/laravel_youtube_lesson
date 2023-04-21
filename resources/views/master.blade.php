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
                <li  class="nav-item ms-3 active" ><a href="{{ route('index') }}">Все товары</a>
                </li>
                <li class="nav-item ms-3"><a href="{{ route('categories') }}">Категории</a>
                </li>
                <li class="nav-item ms-3"><a href={{ route('basket') }} >В корзину</a>
                </li>
                <li class="nav-item ms-3"><a href="{{ route('index') }}">Сбросить проект в начальное состояние</a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="">Панель администратора</a></li>
            </ul>
        </div>
    </div>
</nav>


<div class="container">
    @yield('content')
</div>
</body>
</html>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@lang('main.online_shop'): @yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.min.js"></script>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/starter-template.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('index') }}">
                @lang('main.online_shop')
            </a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li  class="nav-item" >
                    <a href="{{ route('index') }}" class="nav-link @routeactive('index')">
                        @lang('main.all_products')
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories') }}" class="nav-link @routeactive('categor*')">
                        @lang('main.categories')
                    </a>
                </li>
                <li class="nav-item">
                    <a href={{ route('basket') }} class="nav-link @routeactive('basket*')">
                        @lang('main.cart')
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('reset') }}" class="nav-link">
                        @lang('main.reset_project')
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('locale', __('main.set_lang')) }}" class="nav-link">
                        @lang('main.set_lang')
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ App\Services\CurrencyConversion::getCurrencySymbol() }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        {{-- @foreach (App\Models\Currency::get() as $currency) --}}
                        @foreach (App\Services\CurrencyConversion::getCurrencies() as $currency)
                            <li>
                                <a class="dropdown-item" href="{{ route('currency', $currency->code) }}">
                                    {{ $currency->symbol }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @guest()
                    <li >
                        <a href="{{ route('login') }}" class="nav-link">
                            @lang('main.login')
                        </a>
                    </li>
                @endguest
                @auth
                    @admin
                        <li>
                            <a href="{{ route('home') }}" class="nav-link">
                                @lang('main.admin_panel')
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('person.orders.index') }}" class="nav-link">
                                @lang('main.my_orders')
                            </a>
                        </li>
                    @endadmin
                        <li class="ms-2">
                            <a href="{{ route('get-logout') }}" class="nav-link">
                                @lang('main.logout')
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

@extends('master')

@section('title', 'Товар')

@section('content')
    <div class="container">
        <div class="starter-template">
            <h1>iPhone X 64GB</h1>
            <h2>{{ $product }}</h2>
            <p>Цена: <b>71990 руб.</b></p>
            <img src="">
            <p>Отличный продвинутый телефон с памятью на 64 gb</p>
            <a class="btn btn-success" href="{{ route('basket') }}">Добавить в корзину</a>
        </div>
    </div>
@endsection

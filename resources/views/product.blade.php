@extends('layouts.master')

@section('title', 'Товар')

@section('content')
    <h1>{{ $product->name }}</h1>
    <h2>{{ $product->category->name }}</h2>
    <p>Цена: <b>{{ $product->price }} руб.</b></p>
    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">
    <p>{{ $product->description }}</p>
    @if($product->isAvailable())
        <form action="{{ route('basket-add', $product->id) }}" method="post">
            @csrf
            <button type="submit" class="btn btn-success">
                Добавить в корзину
            </button>
        </form>
    @else
        <span>Не доступен</span>
        <br>
        <span>Сообщить мне, когда товар появиться в наличии</span>
        <div class="alert alert-danger">
            @error('email')
                {{ $message }}
            @enderror
        </div>
        <form method="post" action="{{ route('subscription', $product) }}">
            @csrf
            <span>ваш Email:</span>
            <input type="text" name="email">
            <button type="submit" class="btn btn-success">Отправить</button>
        </form>
    @endif
@endsection



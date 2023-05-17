@extends('layouts.master')

@section('title', __('main.product'))

@section('content')
    <h1>{{ $product->__('name') }}</h1>
    <h2>{{ $product->category->__('name') }}</h2>
    <p>@lang('product.price'): <b>{{ $product->price }} @lang($currencySymbol)</b></p>
    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->__('name') }}">
    <p>{{ $product->__('description') }}</p>
    @if($product->isAvailable())
        <form action="{{ route('basket-add', $product->id) }}" method="post">
            @csrf
            <button type="submit" class="btn btn-success">
                @lang('product.add_to_cart')
            </button>
        </form>
    @else
        <span>@lang('product.not_available')</span>
        <br>
        <span>@lang('product.tell_me'):</span>
        <div class="alert alert-danger">
            @error('email')
                {{ $message }}
            @enderror
        </div>
        <form method="post" action="{{ route('subscription', $product) }}">
            @csrf
            <span>Email:</span>
            <input type="text" name="email">
            <button type="submit" class="btn btn-success">@lang('product.subscribe')</button>
        </form>
    @endif
@endsection



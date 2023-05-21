@extends('layouts.master')

@section('title', __('main.product'))

@section('content')
    <h1>{{ $sku->product->__('name') }}</h1>
    <h2>{{ $sku->product->category->__('name') }}</h2>
    <p>@lang('product.price'): <b>{{ $sku->price }} @lang($currencySymbol)</b></p>
    @isset($sku->product->properties)
        @foreach ($sku->propertyOptions as $propertyOption)
            <h5>{{ $propertyOption->property->__('name') }}: {{ $propertyOption->__('name') }}</h5>
        @endforeach
    @endisset
    <img src="{{ Storage::url($sku->product->image) }}" alt="{{ $sku->product->__('name') }}">
    <p>{{ $sku->product->__('description') }}</p>
    @if($sku->isAvailable())
        <form action="{{ route('basket-add', $sku->product->id) }}" method="post">
            @csrf
            <button type="submit" class="btn btn-success">
                @lang('product.add_to_cart')
            </button>
        </form>
    @else
        <span>@lang('product.not_available')</span>
        <br>
        <span>@lang('product.tell_me'):</span>
        @error('email')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @enderror
        <form method="post" action="{{ route('subscription', $sku) }}">
            @csrf
            <span>Email:</span>
            <input type="text" name="email">
            <button type="submit" class="btn btn-success">@lang('product.subscribe')</button>
        </form>
    @endif
@endsection



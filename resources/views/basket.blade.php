@extends('layouts.master')

@section('title', __('basket.cart'))

@section('content')
    <h1>
        @lang('basket.cart')
    </h1>
    <p>
        @lang('basket.ordering')
    </p>
    <div class="panel">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>
                    @lang('basket.name')
                </th>
                <th>
                    @lang('basket.count')
                </th>
                <th>
                    @lang('basket.price')
                </th>
                <th>
                    @lang('basket.cost')
                </th>
            </tr>
            </thead>
            <tbody>
                @foreach ($order->skus as $sku)
                    <tr>
                        <td>
                            <a href="{{ route('sku', [$sku->product->category->code, $sku->product->code, $sku]) }}">
                                <img height="56px" src="{{ Storage::url($sku->product->image) }}">
                                {{ $sku->product->__('name') }}
                            </a>
                        </td>
                        <td><span class="badge rounded-pill bg-primary">{{ $sku->countInOrder }}</span>
                            <div class="btn-group">
                                <form action="{{ route('basket-remove', $sku) }}" method="post">
                                    <button type="submit" class="btn btn-danger">
                                        <span class="glyphicon glyphicon-minus" aria-hidden="true">
                                            -
                                        </span>
                                    </button>
                                    @csrf
                                </form>
                                <form action="{{ route('basket-add', $sku) }}" method="post">
                                    <button type="submit" class="btn btn-success" >
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true">
                                            +
                                        </span>
                                    </button>
                                    @csrf
                                </form>
                            </div>
                        </td>
                        <td>
                            {{ $sku->price }} @lang($currencySymbol)
                        </td>
                        <td>
                            {{ $sku->price * $sku->countInOrder }} @lang($currencySymbol)
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3">
                        @lang('basket.full_cost'):
                    </td>
                    @if ($order->hasCoupon())
                    <td>
                        <s>{{ $order->getFullSum(false) }} @lang($currencySymbol)</s> <b>{{ $order->getFullSum() }}</b>
                    </td>
                    @else
                        <td>
                            {{ $order->getFullSum() }} @lang($currencySymbol)
                        </td>
                    @endif
                </tr>
            </tbody>
        </table>
        <br>
        @if (!$order->hasCoupon())
            <div class="d-flex justify-content-end">
                <form method="POST" action="{{ route('set-coupon') }}" class="d-flex">
                    @csrf
                    <label for="coupon">Добавить купон:</label>
                    <input class="form-control ms-1" type="text" name="coupon" id="coupon">
                    <button type="submit" class="btn btn-success ms-1">Применить</button>
                </form>
            </div>
            @error('coupon')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        @else
            <div>Вы используете купон {{ $order->coupon->code }}</div>
        @endif
        <br>
        <div class="btn-group pull-right" role="group">
            <a type="button" class="btn btn-success" href="{{ route('basket-place') }}">
                @lang('basket.place_order')
            </a>
        </div>
    </div>
@endsection

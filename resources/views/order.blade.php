@extends('layouts.master')

@section('title', __('basket.place_order'))

@section('content')
    <h1>
        @lang('basket.approve_order'):
    </h1>
    <div class="container">
        <div class="justify-content-center">
            <p>
                @lang('basket.full_cost'): <b>{{ $order->calculateFullSum() }} @lang('main.rub').</b>
            </p>
            <form action="{{ route('basket-confirm') }}" method="POST">
                <div>
                    <p>
                        @lang('basket.personal_data'):
                    </p>

                    <div class="container d-flex flex-column justify-content-center">
                        <div class="align-self-center">
                            <label for="name" class="form-label">
                                @lang('basket.data.name'):
                            </label>
                            <input type="text" name="name" id="name" value="" class="form-control">
                        </div>
                        <div class="align-self-center">
                            <label for="phone" class="form-label">
                                @lang('basket.data.phone'):
                            </label>
                            <input type="text" name="phone" id="phone" value="" class="form-control">
                        </div>
                        @guest
                            <div class="align-self-center">
                                <label for="email" class="form-label">
                                    @lang('basket.data.email'):
                                </label>
                                <input type="text" name="email" id="email" value="" class="form-control">
                            </div>
                        @endguest
                    </div>
                    <br>
                    <input type="submit" class="btn btn-success" value="@lang('basket.approve_order')">
                    @csrf
                </div>
            </form>
        </div>
    </div>
@endsection

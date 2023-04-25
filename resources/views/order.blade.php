@extends('layouts.master')

@section('title', 'Оформить заказ')

@section('content')
    <h1>Подтвердите заказ:</h1>
    <div class="container">
        <div class="justify-content-center">
            <p>Общая стоимость заказа: <b>{{ $order->calculateFullSum() }} грн.</b></p>
            <form action="{{ route('basket-confirm') }}" method="POST">
                <div>
                    <p>Укажите свои имя и номер телефона, чтобы наш менеджер мог с вами связаться:</p>

                    <div class="container d-flex flex-column justify-content-center">
                        <div class="align-self-center">
                            <label for="name" class="form-label">Имя: </label>
                            <input type="text" name="name" id="name" value="" class="form-control">
                        </div>
                        <div class="align-self-center">
                            <label for="phone" class="form-label">Номер телефона: </label>
                            <input type="text" name="phone" id="phone" value="" class="form-control">
                        </div>
                        @guest
                            <div class="align-self-center">
                                <label for="email" class="form-label">Email: </label>
                                <input type="text" name="email" id="email" value="" class="form-control">
                            </div>
                        @endguest
                    </div>
                    <br>
                    <input type="submit" class="btn btn-success" value="Подтвердить заказ">
                    @csrf
                </div>
            </form>
        </div>
    </div>
@endsection

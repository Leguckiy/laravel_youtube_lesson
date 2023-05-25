@extends('auth.layouts.master')

@isset($merchant)
    @section('title', 'Редактировать поставщика ' . $merchant->name)
@else
    @section('title', 'Создать поставщика')
@endisset

@section('content')
    <div class="col-md-12">
        @isset($merchant)
            <h1>Редактировать Поставщика <b>{{ $merchant->name }}</b></h1>
        @else
            <h1>Добавить Поставщика</h1>
        @endisset

        <form method="POST" enctype="multipart/form-data"
                @isset($merchant)
                action="{{ route('merchants.update', $merchant) }}"
                @else
                action="{{ route('merchants.store') }}"
            @endisset
        >
            <div>
                @isset($merchant)
                    @method('PUT')
                @endisset
                @csrf
                <div class="input-group row">
                    <label for="name" class="col-sm-2 col-form-label">Название: </label>
                    <div class="col-sm-6">
                        @include('auth.layouts.error', ['fieldName' => 'name'])
                        <input type="text" class="form-control" name="name" id="name"
                                value="{{ old('name', $merchant->name ?? '') }}">
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email: </label>
                    <div class="col-sm-6">
                        @include('auth.layouts.error', ['fieldName' => 'email'])
                        <input type="text" class="form-control" name="email" id="email"
                                value="{{ old('email', $merchant->email ?? '') }}">
                    </div>
                </div>
                <button class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
@endsection


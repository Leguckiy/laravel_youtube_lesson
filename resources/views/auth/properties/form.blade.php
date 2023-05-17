@extends('auth.layouts.master')

@isset($property)
    @section('title', 'Редактировать свойство ' . $property->name)
@else
    @section('title', 'Создать свойство')
@endisset

@section('content')
    <div class="col-md-12">
        @isset($property)
            <h1>Редактировать Свойство <b>{{ $property->name }}</b></h1>
        @else
            <h1>Добавить Свойство</h1>
        @endisset

        <form method="POST" enctype="multipart/form-data"
                @isset($property)
                action="{{ route('properties.update', $property) }}"
                @else
                action="{{ route('properties.store') }}"
            @endisset
        >
            <div>
                @isset($property)
                    @method('PUT')
                @endisset
                @csrf
                <div class="input-group row">
                    <label for="name" class="col-sm-2 col-form-label">Название: </label>
                    <div class="col-sm-6">
                        @include('auth.layouts.error', ['fieldName' => 'name'])
                        <input type="text" class="form-control" name="name" id="name"
                                value="{{ old('name', $property->name ?? '') }}">
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="name_en" class="col-sm-2 col-form-label">Название en: </label>
                    <div class="col-sm-6">
                        @include('auth.layouts.error', ['fieldName' => 'name_en'])
                        <input type="text" class="form-control" name="name_en" id="name_en"
                                value="{{ old('name_en', $property->name_en ?? '') }}">
                    </div>
                </div>
                <button class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
@endsection


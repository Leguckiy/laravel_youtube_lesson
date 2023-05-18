@extends('auth.layouts.master')

@isset($sku)
    @section('title', 'Редактировать Sku ' . $sku->name)
@else
    @section('title', 'Создать Sku')
@endisset

@section('content')
    <div class="col-md-12">
        @isset($sku)
            <h1>Редактировать Sku <b>{{ $sku->name }}</b></h1>
        @else
            <h1>Добавить Sku</h1>
        @endisset

        <form method="POST" enctype="multipart/form-data"
                @isset($sku)
                action="{{ route('skus.update', [$product, $sku]) }}"
                @else
                action="{{ route('skus.store', $product) }}"
            @endisset
        >
            <div>
                @isset($sku)
                    @method('PUT')
                @endisset
                @csrf
                <div class="input-group row">
                    <label for="price" class="col-sm-2 col-form-label">Цена: </label>
                    <div class="col-sm-2">
                        @include('auth.layouts.error', ['fieldName' => 'price'])
                        <input type="text" class="form-control" name="price" id="price"
                            value="{{ old('price', $sku->price ?? '') }}">
                    </div>
                </div>
                <div class="input-group row">
                    <label for="count" class="col-sm-2 col-form-label">Кол-во: </label>
                    <div class="col-sm-2">
                        @include('auth.layouts.error', ['fieldName' => 'count'])
                        <input type="text" class="form-control" name="count" id="count"
                        value="{{ old('count', $sku->count ?? '') }}">
                    </div>
                </div>
                @foreach ($product->properties as $property)
                <div class="input-group row">
                    <label for="property_id[{{ $property->id }}]" class="col-sm-2 col-form-label">{{ $property->name }}: </label>
                    <div class="col-sm-6">
                        <select name="property_id[{{ $property->id }}]" id="property_id[{{ $property->id }}]" class="form-control">
                            @foreach ($property->propertyOptions as $propertyOption)
                                <option value="{{ $propertyOption->id }}"
                                    @isset($sku)
                                        @if ($sku->propertyOptions->contains($propertyOption->id))
                                            {{ 'selected' }}
                                        @endif
                                    @endisset
                                >
                                    {{ $propertyOption->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endforeach

                <button class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
@endsection


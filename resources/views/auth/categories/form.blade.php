@extends('auth.layouts.master')

@isset($category)
    @section('title', 'Редактировать категорию ' . $category->name)
@else
    @section('title', 'Создать категорию')
@endisset

@section('content')
    <div class="col-md-12">
        @isset($category)
            <h1>Редактировать Категорию <b>{{ $category->name }}</b></h1>
                @else
                    <h1>Добавить Категорию</h1>
                @endisset

                <form method="POST" enctype="multipart/form-data"
                      @isset($category)
                      action="{{ route('categories.update', $category) }}"
                      @else
                      action="{{ route('categories.store') }}"
                    @endisset
                >
                    <div>
                        @isset($category)
                            @method('PUT')
                        @endisset
                        @csrf
                        <div class="input-group row">
                            <label for="code" class="col-sm-2 col-form-label">Код: </label>
                            <div class="col-sm-6">
                                @include('auth.layouts.error', ['fieldName' => 'code'])
                                <input type="text" class="form-control" name="code" id="code"
                                       value="{{ old('code', $category->code ?? '') }}">
                            </div>
                        </div>
                        <br>
                        <div class="input-group row">
                            <label for="name" class="col-sm-2 col-form-label">Название: </label>
                            <div class="col-sm-6">
                                @include('auth.layouts.error', ['fieldName' => 'name'])
                                <input type="text" class="form-control" name="name" id="name"
                                       value="{{ old('name', $category->name ?? '') }}">
                            </div>
                        </div>
                        <br>
                        <div class="input-group row">
                            <label for="name_en" class="col-sm-2 col-form-label">Название en: </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="name_en" id="name_en"
                                       value="{{ old('name_en', $category->name_en ?? '') }}">
                            </div>
                        </div>
                        <br>
                        <div class="input-group row">
                            <label for="description" class="col-sm-2 col-form-label">Описание: </label>
                            <div class="col-sm-6">
                                @include('auth.layouts.error', ['fieldName' => 'description'])
							<textarea name="description" id="description" cols="72"
                                      rows="7">{{ old('description', $category->description ?? '') }}</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="input-group row">
                            <label for="description_en" class="col-sm-2 col-form-label">Описание en: </label>
                            <div class="col-sm-6">
							<textarea name="description_en" id="description_en" cols="72"
                                      rows="7">{{ old('description_en', $category->description_en ?? '') }}</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="input-group row">
                            <label for="image" class="col-sm-2 col-form-label">Картинка: </label>
                            <div class="col-sm-10">
                                <label class="btn btn-default btn-file">
                                    Загрузить <input type="file" style="display: none;" name="image" id="image">
                                </label>
                            </div>
                        </div>
                        <button class="btn btn-success">Сохранить</button>
                    </div>
                </form>
    </div>
@endsection


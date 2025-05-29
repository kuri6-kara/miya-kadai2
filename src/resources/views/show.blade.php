@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/update.css') }}" />
@endsection

@section('content')
<!-- @php 
dump($errors->all())
@endphp -->
<div class="show">
    <form action="/products/{{ $product['id'] }}/update" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="form__label--item">
            商品画像
        </div>
        <div class="form__input--file">
            <img src="{{ asset('/storage/' . $product->image) }}" alt="{{ $product->name }}">
            <input type="file" name="image">
            <input type="hidden" name="image" value="{{ $product['image']}}">
        </div>
        <div class="form__error">
            @error('image')
            {{ $message }}
            @enderror
        </div>

        <div class="form__label--item">
            商品名
        </div>
        <div class=form__inout--text>
            <input type="text" name="name" value="{{ $product['name'] }}">
        </div>
        <div class="form__error">
            @error('name')
            {{ $message }}
            @enderror
        </div>

        <div class="form__label--item">値段</div>
        <div class="form__input--text">
            <input type="number" name="price" value="{{ $product['price'] }}">
        </div>
        <div class="form__error">
            @error('price')
            {{ $message }}
            @enderror
        </div>

        <div class="form__label--item">季節</div>
        <div class="form__input--text">
            @foreach($seasons as $season)
            <input type="checkbox" name="season_ids[]" value="{{ $season->id }}" {{ $product->seasons->contains($season->id) ? 'checked' : '' }}>{{ $season->name }}
            @endforeach
        </div>
        <div class="form__error">
            @error('season_ids')
            {{ $message }}
            @enderror
        </div>

        <div class="form__label--item">商品説明</div>
        <div class="form__input--text">
            <input type="text" name="description" value="{{ $product['description'] }}">
        </div>
        <div class="form__error">
            @error('description')
            {{ $message }}
            @enderror
        </div>

        <div class="return-form__button">
            <button type="button" onclick="location.href='/products' ">戻る</button>
        </div>
        <div class="update-form__button">
            <button type="submit">更新</button>
        </div>
    </form>

    <form class="delete-form" action="/products/{{ $product['id'] }}/delete" method="POST">
        @method('DELETE')
        @csrf
        <div class="delete-form__button">
            <input type="hidden" name="id" value="{{ $product['id'] }}">
            <button class="delete-form__button-submit" type="submit">
                <i class="fas fa-trash-alt"></i>
            </button>
        </div>
    </form>
</div>

@endsection
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}" />
@endsection

@section('content')
<div class="register-form__content">
    <div class="register-form__heading">
        <h2>商品登録</h2>
    </div>
    <form action="/products" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">商品名</span>
                <span class="form__label--required">必須</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="name" placeholder="商品名を入力" value="{{ old('name') }}" />
                </div>
                <div class="form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">値段</span>
                    <span class="form__label--required">必須</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="number" name="price" placeholder="値段を入力" value="{{ old('price') }}" />
                    </div>
                    <div class="form__error">
                        @error('price')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">商品画像</span>
                    <span class="form__label--required">必須</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--file">
                        <input type="file" name="image">
                    </div>
                    <div class="form__error">
                        @error('image')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">季節</span>
                    <span class="form__label--required">必須</span>
                </div>
                <div class="form__group-content">
                    <div class="form__group-content">
                        <div class="form__input--text">
                            @foreach($seasons as $season)
                            <input type="checkbox" name="season_ids[]" value="{{ $season->id }}" />
                            {{ $season->content }}
                            <input type="hidden" name="season_ids[]" value="{{ $season->id }}" />
                            @endforeach
                        </div>
                    </div>
                    <div class="form__error">
                        <div class="seasons">
                            @error('season')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">商品説明</span>
                    <span class="form__label--required">必須</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--textarea">
                        <textarea name="description" placeholder="商品の説明を入力" value="{{ old('description') }}">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="form__error">
                    <div class="description">
                        @error('description')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="return-form__button">
            <button type="button" onclick="location.href='/products' ">戻る</button>
        </div>
        <div class="register-form__button">
            <button type="button" onclick="location.href='/products' ">登録</button>
        </div>
    </form>
</div>
@endsection
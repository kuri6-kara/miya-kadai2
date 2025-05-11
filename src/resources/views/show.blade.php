@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/update.css') }}" />
@endsection

@section('content')
<div class="show">
    <form action="/products/{productId}/update" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <div class="form__label--item">
            商品画像
        </div>
        <div class="form__input--file">
            <img src="{{ asset('/storage/' . $product->image) }}" alt="{{ $product->name }}">
            <input type="file" name="image">
            <input type="hidden" name="image" value="{{ $product['image']}}">
        </div>

        <div class="form__label--item">
            商品名
        </div>
        <div class=form__inout--text>
            <input type="text" name="name" value="{{ $product['name'] }}">
        </div>

        <div class="form__label--item">値段</div>
        <div class="form__input--text">
            <input type="text" name="price" value="{{ $product['price'] }}">
        </div>

        <div class="form__label--item">季節</div>
        <div class="form__input--text">
            @foreach($seasons as $season)
            <input type="checkbox" name="season_ids[]" value="{{ $season->id }}" />
            {{ $season->content }}
            <input type="hidden" name="season_ids[]" value="{{ $season->id }}" />
            @foreach
        </div>

        <div class="form__label--item">商品説明</div>
        <div class="form__input--text">
            <input type="text" name="description" value="{{ $product['description'] }}">
        </div>

</div>

@endsection
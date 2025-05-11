@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/update.css') }}" />
@endsection

@section('content')
<div class="show">
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
        <input type="text" name="price" value="{{ $product['price'] }}">
    </div>

    <img src="{{ asset('/storage/' . $product->images) }}" alt="{{ $product->name }}">

    <form action="/products/{productId}/update" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
</div>

@endsection
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css') }}" />
@endsection

@section('content')
<div class="product">
    <h2 class="product__heading content__heading">商品一覧</h2>
    <div class="form__button">
        <a class="header__button" href="/products/register">
            +商品を追加
        </a>
    </div>
    <div class="product__inner">
        <form class="search-form" action="/products/search" method="post">
            @csrf
            <input class="search-form__keyword-input" type="text" name="keyword" value="{{ request('keyword')}}" placeholder="商品名で検索">
            <div class="search-form__actions">
                <input class="search-form__search-btn btn" type="submit" value="検索">
            </div>
        </form>

        <div class="card">
            @foreach($products as $product)
            <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none text-dark">
                <div class="card">
                    <img src="{{ asset('/storage/' . $product->image) }}" alt="{{ $product->name }}">
                    <div class="card-body">
                        <div class="card-body">
                            <p class="card-text">{{ $product->name }}</p>
                            <p class="card-text">{{ $product->price }}</p>
                        </div>
                    </div>
                </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
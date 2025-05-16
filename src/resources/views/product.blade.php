@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css') }}" />
@endsection

@section('content')
<div class="product">
    <div class="product__heading">
        <h2 class="product__title">商品一覧</h2>
        <div class="form__button">
            <div class="register-form__button">
                <button type="button" onclick="location.href='/products/register' ">+商品を追加</button>
            </div>
        </div>
    </div>

    <div class="product-group">
        <form class="search-form" action="/products/search" method="post">
            @csrf
            <input class="search-form__keyword-input" type="text" name="keyword" value="{{ request('keyword')}}" placeholder="商品名で検索">
            <div class="search-form__actions">
                <input class="search-form__search-btn btn" type="submit" value="検索">
            </div>
        </form>

        <div class="sort-form">
            <select name="sort" class="form-select">
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>高い順に表示</option>
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>低い順に表示</option>
            </select>
        </div>

        <div class="card">
            @foreach($products as $product)
            <a href="/products/{{ $product['id'] }}" class="card_link">
                <div class="card">
                    <img src="{{ '/storage/image/' . $product['image'] }}">
                    <input type="hidden" name="image" value="{{ $product['image']}}">
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
{{ $products->links('vendor.pagination.semantic-ui') }}
@endsection
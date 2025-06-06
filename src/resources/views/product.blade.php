@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/product.css') }}" />
@endsection

@section('content')

    <div class="product__heading">
        <h2>商品一覧</h2>
        <div class="register-form__button">
            <button type="button" onclick="location.href='/products/register' ">+商品を追加</button>
        </div>
    </div>

    <div class="product-group">
        <div class="product-left">
            <form class="search-form" action="/products/search" method="get">
                @csrf
                <input class="search-form__keyword-input" type="text" name="keyword" value="{{ request('keyword')}}" placeholder="商品名で検索">
                <div class="search-form__actions">
                    <input class="search-form__search-btn btn" type="submit" value="検索">
                </div>

                <div class="sort-form">
                    <select name="sort" class="form-select">
                        <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>高い順に表示</option>
                        <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>低い順に表示</option>
                    </select>
                </div>
            </form>

            <!-- @if(@isset($sort)&& $sort != "")
        <div class="sort_contents">
            <p class="searched_data">{{$sort}}</p>
            <div class="close-content">
                <a href="/products">
                    <img src="{{ asset('/images/close-icon.png') }}" alt="閉じるアイコン" class="img-close-icon" />
                </a>
            </div>
        </div>
        @endif -->
        </div>

        <div class="product-right">
            <div class="card">
                @foreach($products as $product)
                <a href="/products/{{ $product['id'] }}" class="card_link">
                    <div class="card_image">
                        <img class="card_image" src="{{ '/storage/' . $product['image'] }}">
                        <input type="hidden" name="image" value="{{ $product['image']}}">
                    </div>
                    <div class="card_text">
                        <p class="card_name">{{ $product->name }}</p>
                        <p class="card_price">{{ $product->price }}</p>
                    </div>
                </a>
                @endforeach
            </div>
            <div class="pagination-content">
                {{ $products->links('vendor.pagination.semantic-ui') }}
            </div>
        </div>
    </div>


@endsection
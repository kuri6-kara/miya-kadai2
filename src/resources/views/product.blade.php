@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css') }}" />
@endsection

@section('content')
<div class="admin">
    <h2 class="admin__heading content__heading">商品一覧</h2>
    <div class="admin__inner">
        <form class="search-form" action="/products/search" method="post">
            @csrf
            <input class="search-form__keyword-input" type="text" name="keyword" value="{{ request('keyword')}}" placeholder="商品名で検索">

        </form>
    </div>
</div>
@endsection
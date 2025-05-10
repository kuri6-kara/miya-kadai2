@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/update.css') }}" />
@endsection

@section('content')
<div class="show">
    <h1>商品名>{{ $product->name }}</h1>
    <img src="{{ asset('/storage/' . $product->images) }}" alt="{{ $product->name }}">

    <form action="/products/{productId}/update" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
</div>

@endsection
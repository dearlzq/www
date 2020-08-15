@extends('index.layouts.shop')

@section('title', '商品详情')
@section('content')


    @include('index.layouts.navbar')
    @include('index.layouts.navright')
    @include('index.layouts.cartmenu')
<h1>没有商品，空购物车</h1>
@endsection

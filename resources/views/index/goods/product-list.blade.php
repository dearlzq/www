@extends('index.layouts.shop')

@section('title', '商品列表')
@section('content')


@include('index.layouts.navbar')
@include('index.layouts.cartmenu')
@include('index.layouts.navright')

<!-- product -->
<div class="section product product-list">
    <div class="container">
        <div class="pages-head">
            <h3>PRODUCT LIST</h3>
        </div>
        <div class="input-field">
            <select>
                <option value="">Popular</option>
                <option value="1">New Product</option>
                <option value="2">Best Sellers</option>
                <option value="3">Best Reviews</option>
                <option value="4">Low Price</option>
                <option value="5">High Price</option>
            </select>
        </div>

        <div class="row">
            @foreach($good as $k => $v)
            <div class="col s6">
                <div class="content">
                    <img src="/storage/{{$v->goods_img}}" alt="">
                    <h6><a href="{{ URL('/goods/shop-single/'.$v->goods_id)}}">{{$v->goods_name}}</a></h6>
                    <div class="price">
                        ${{$v->shop_price}} <span>${{$v->shop_price}}{{$v->shop_price}}</span>
                    </div>
                    <a href="{{url('/cart/cartlist/'.$v->goods_id)}}">
                        <button class="btn button-default">ADD TO CART</button>
                    </a>

                </div>
            </div>
            @endforeach
        </div>
        <div class="pagination-product">
            <ul>
                <li class="active">1</li>
                <li><a href="">2</a></li>
                <li><a href="">3</a></li>
                <li><a href="">4</a></li>
                <li><a href="">5</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- end product -->


<!-- loader -->
<div id="fakeLoader"></div>
<!-- end loader -->

@endsection

@extends('index.layouts.shop')

@section('title', '购物车列表')
@section('content')

@include('index.layouts.navbar')
@include('index.layouts.navright')
@include('index.layouts.footerjs')
@include('index.layouts.cartmenu')


<!-- cart -->
<div class="cart section">
    <div class="container">
        <div class="pages-head">
            <h3>CART</h3>
        </div>
        @foreach($goods as $k=>$v)
            <div class="content">
                <div class="cart-1">
                    <div class="row">
                        <div class="col s5">
                            <h5>Image</h5>
                        </div>
                        <div class="col s7">
                            <img src="/storage/{{$v['goods_img']}}" alt="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <h5>名称</h5>
                        </div>
                        <div class="col s7">
                            <h5><a href="">{{$v['goods_name']}}</a></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <h5>数量</h5>
                        </div>
                        <div class="col s7">
                            <input value="1" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <h5>Price</h5>
                        </div>
                        <div class="col s7">
                            <h5>{{$v['shop_price']}}</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <h5>Action</h5>
                        </div>
                        <div class="col s7">
                            <h5><i class="fa fa-trash"></i></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="total">
                <div class="row">
                    <div class="col s7">
                        <h6>总价</h6>
                    </div>
                    <div class="col s5">
                        <h6>${{$v['shop_price']}}</h6>
                    </div>
                </div>
            </div>
        @endforeach
        {{--<button class="btn button-default">结账</button>--}}
        <a href="/order/index" class="btn button-default">提交订单</a>
    </div>
</div>
<!-- end cart -->

<!-- loader -->
<div id="fakeLoader"></div>
<!-- end loader -->
@endsection

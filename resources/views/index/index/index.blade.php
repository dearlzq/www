@extends('index.layouts.shop')

@section('title', '首页')
@section('content')

    @include('index.layouts.navbar')
    @include('index.layouts.navright')
    @include('index.layouts.cartmenu')




    <!-- slider -->
    <div class="slider">

        <ul class="slides">
            <li>
                <img src="/static/img/slide1.jpg" alt="">
                <div class="caption slider-content  center-align">
                    <h2>WELCOME TO MSTORE</h2>
                    <h4>Lorem ipsum dolor sit amet.</h4>
                    <a href="" class="btn button-default">SHOP NOW</a>
                </div>
            </li>
            <li>
                <img src="/static/img/slide2.jpg" alt="">
                <div class="caption slider-content center-align">
                    <h2>JACKETS BUSINESS</h2>
                    <h4>Lorem ipsum dolor sit amet.</h4>
                    <a href="" class="btn button-default">SHOP NOW</a>
                </div>
            </li>
            <li>
                <img src="/static/img/slide3.jpg" alt="">
                <div class="caption slider-content center-align">
                    <h2>FASHION SHOP</h2>
                    <h4>Lorem ipsum dolor sit amet.</h4>
                    <a href="" class="btn button-default">SHOP NOW</a>
                </div>
            </li>
        </ul>

    </div>
    <!-- end slider -->

    <!-- features 免运费-->
    <div class="features section">
        <div class="container">
            <div class="row">
                <div class="col s6">
                    <div class="content">
                        <div class="icon">
                            <i class="fa fa-car"></i>
                        </div>
                        <h6>Free Shipping---免运费</h6>
                        <p>Welcome to come often </p>
                    </div>
                </div>
                <div class="col s6">
                    <div class="content">
                        <div class="icon">
                            <i class="fa fa-dollar"></i>
                        </div>
                        <h6>Money Back---退款</h6>
                        <p>Looking forward to your next visit</p>
                    </div>
                </div>
            </div>
            <div class="row margin-bottom-0">
                <div class="col s6">
                    <div class="content">
                        <div class="icon">
                            <i class="fa fa-lock"></i>
                        </div>
                        <h6>Secure Payment---安全支付</h6>
                        <p>Protecting wealth</p>
                    </div>
                </div>
                <div class="col s6">
                    <div class="content">
                        <div class="icon">
                            <i class="fa fa-support"></i>
                        </div>
                        <h6>24/7 Support---全天支持</h6>
                        <p>Lorem ipsum dolor sit amet consectetur</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end features -->






    <!--推荐 quote -->
    <div class="section quote">
        <div class="container">
            <h4>recommend---推荐</h4>
            <p>Here will recommend the best to you</p>
        </div>
    </div>
    <!-- end quote -->
    <!-- product -->
    <div class="section product">
        <div class="container">
            <div class="section-head">
                <h4>recommend</h4>
                <div class="divider-top"></div>
                <div class="divider-bottom"></div>
            </div>
            <div class="row">
                @foreach($is_show as $z=>$x)
                    <div class="col s6">
                        <div class="content">
                            <img src="/storage/{{$x->goods_img}}" alt="">
                            <h6><a href="{{ URL('/goods/shop-single/'.$x->goods_id)}}">{{$x->goods_name}}</a></h6>
                            <div class="price">
                                ${{$x->shop_price}} <span>${{$x->shop_price}}{{$x->shop_price}}</span>
                            </div>

                            <a href="{{url('/cart/cartlist/'.$x->goods_id)}}">

                            </a>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
    <!-- end product -->






    <!--推荐 quote -->
    <div class="section quote">
        <div class="container">
            <h4>NEW---新品</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid ducimus illo hic iure eveniet</p>
        </div>
    </div>
    <!-- end quote -->
    <!-- product -->
    <div class="section product">
        <div class="container">
            <div class="section-head">
                <h4>NEW</h4>
                <div class="divider-top"></div>
                <div class="divider-bottom"></div>
            </div>
            <div class="row">
                @foreach($is_new as $n=>$m)
                    <div class="col s6">
                        <div class="content">
                            <img src="/storage/{{$m->goods_img}}" alt="">
                            <h6><a href="{{ URL('/goods/shop-single/'.$m->goods_id)}}">{{$m->goods_name}}</a></h6>
                            <div class="price">
                                ${{$m->shop_price}} <span>${{$m->shop_price}}{{$m->shop_price}}</span>
                            </div>

                            <a href="{{url('/cart/cartlist/'.$m->goods_id)}}">
                            </a>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
    <!-- end product -->









    <!--新品 quote -->
    <div class="section quote">
        <div class="container">
            <h4>ALL---全部</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid ducimus illo hic iure eveniet</p>
        </div>
    </div>
    <!-- end quote -->

    <!-- product -->
    <div class="section product">
        <div class="container">
            <div class="section-head">
                <h4>ALL</h4>
                <div class="divider-top"></div>
                <div class="divider-bottom"></div>
            </div>
            <div class="row">
                @foreach($goods as $k=>$v)
                <div class="col s6">
                    <div class="content">
                        <img src="/storage/{{$v->goods_img}}" alt="">
                        <h6><a href="{{ URL('/goods/shop-single/'.$v->goods_id)}}">{{$v->goods_name}}</a></h6>
                        <div class="price">
                            ${{$v->shop_price}} <span>${{$v->shop_price}}{{$v->shop_price}}</span>
                        </div>

                        <a href="{{url('/cart/cartlist/'.$v->goods_id)}}">
                        </a>
                    </div>
                </div>
                @endforeach


            </div>
        </div>
    </div>
    <!-- end product -->
    <!-- loader -->
    <div id="fakeLoader"></div>
    <!-- end loader -->

@endsection

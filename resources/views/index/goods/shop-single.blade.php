@extends('index.layouts.shop')

@section('title', '商品详情')
@section('content')


@include('index.layouts.navbar')
@include('index.layouts.cartmenu')
@include('index.layouts.navright')



<!-- shop single -->
<div class="pages section">

    <div class="container">
        <div class="shop-single">
            <img src="/storage/{{$goods['goods_img']}}" alt="">
            <h5>{{$goods['goods_name']}}</h5>
            <div class="price">${{$goods['shop_price']}} <span>${{$goods['shop_price']}}{{$goods['shop_price']}}</span></div>
            <p>{{$goods['goods_desc']}}</p>
            <a href="{{url('/cart/cartlist/'.$goods['goods_id'])}}">
                <button class="btn button-default">加入购物车</button>
            </a>
        </div>

        <div class="review">
            <h5>1 reviews</h5>
            <div class="review-details">
                <div class="row">
                    <div class="col s3">
                        <img src="/storage/{{$goods['goods_img']}}" alt="" class="responsive-img">
                    </div>
                    <div class="col s9">
                        <div class="review-title">
                            <span><strong>{{$goods['goods_name']}}</strong> | Juni 5, 2016 at 9:24 am | <a href="">Reply</a></span>
                        </div>
                        <p>{{$goods['goods_desc']}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="review-form">
            <div class="review-head">
                <h5>Post Review in Below</h5>
                <p>{{$goods['goods_img']}}</p>
            </div>
            <div class="row">
                <form class="col s12 form-details">
{{--                    <div class="input-field">--}}
{{--                        <input type="text" required class="validate" placeholder="{{$goods['goods_name']}}">--}}
{{--                    </div>--}}
{{--                    <div class="input-field">--}}
{{--                        <input type="email" class="validate" placeholder="EMAIL" required>--}}
{{--                    </div>--}}
{{--                    <div class="input-field">--}}
{{--                        <input type="text" class="validate" placeholder="SUBJECT" required>--}}
{{--                    </div>--}}
                    <h5>{{$goods['goods_name']}}</h5>
                    <div class="price">${{$goods['shop_price']}} <span>${{$goods['shop_price']}}{{$goods['shop_price']}}</span></div>
                    <p>{{$goods['goods_desc']}}</p>
                    <div class="input-field">
                        <textarea name="talk" id="textarea1" cols="30" rows="10" class="materialize-textarea" class="validate" placeholder="YOUR REVIEW---您的评论"></textarea>
                    </div>


                    <div class="form-button">
                        <a href="{{url('/goods/talklist/')}}">
                        <div class="btn button-default">事后审查</div>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end shop single -->

<!-- loader -->
<div id="fakeLoader"></div>
<!-- end loader -->
<!-- scripts -->
<script type="text/javascript" charset="utf-8" src="https://g.alicdn.com/de/prismplayer/2.8.8/aliplayer-min.js"></script>

<script>
    var player = new Aliplayer({
            "id": "player-con",
            "source": "/storage/",
            "width": "50%",
            "height": "400px",
            "autoplay": true,
            "isLive": false,
            "rePlay": false,
            "playsinline": true,
            "preload": true,
            "controlBarVisibility": "hover",
            "useH5Prism": true
        }, function (player) {
            console.log("The player is created");
        }
    );
</script>
@endsection

@extends('index.layouts.shop')

@section('title', '商品详情')
@section('content')


    @include('index.layouts.navbar')
    @include('index.layouts.navright')
    @include('index.layouts.cartmenu')
<!-- product -->
<div class="section product product-list">
    <div class="container">
        <div class="pages-head">
            <h3>TOP 10</h3>
        </div>
        <div class="input-field">
            <select>
                <option value="">浏览排行TOP10</option>
                <option value="1">购买排行TOP10</option>
                <option value="2">收藏排行TOP10</option>
            </select>
        </div>
        <div class="row">
            <div class="col s6">
                <div class="content">
                    <img src="/static/img/product-new1.png" alt="">
                    <h6><a href="">Fashion Men's</a></h6>
                    <div class="price">
                        $20 <span>$28</span>
                    </div>
                    <button class="btn button-default">ADD TO CART</button>
                </div>
            </div>
            <div class="col s6">
                <div class="content">
                    <img src="/static/img/product-new2.png" alt="">
                    <h6><a href="">Fashion Men's</a></h6>
                    <div class="price">
                        $20 <span>$28</span>
                    </div>
                    <button class="btn button-default">ADD TO CART</button>
                </div>
            </div>
        </div>
        <div class="row margin-bottom">
            <div class="col s6">
                <div class="content">
                    <img src="/static/img/product-new3.png" alt="">
                    <h6><a href="">Fashion Men's</a></h6>
                    <div class="price">
                        $20 <span>$28</span>
                    </div>
                    <button class="btn button-default">ADD TO CART</button>
                </div>
            </div>
            <div class="col s6">
                <div class="content">
                    <img src="/static/img/product-new4.png" alt="">
                    <h6><a href="">Fashion Men's</a></h6>
                    <div class="price">
                        $20 <span>$28</span>
                    </div>
                    <button class="btn button-default">ADD TO CART</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s6">
                <div class="content">
                    <img src="img/product-new3.png" alt="">
                    <h6><a href="">Fashion Men's</a></h6>
                    <div class="price">
                        $20 <span>$28</span>
                    </div>
                    <button class="btn button-default">ADD TO CART</button>
                </div>
            </div>
            <div class="col s6">
                <div class="content">
                    <img src="/static/img/product-new4.png" alt="">
                    <h6><a href="">Fashion Men's</a></h6>
                    <div class="price">
                        $20 <span>$28</span>
                    </div>
                    <button class="btn button-default">ADD TO CART</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end product -->


<!-- loader -->
<div id="fakeLoader"></div>
<!-- end loader -->


@endsection

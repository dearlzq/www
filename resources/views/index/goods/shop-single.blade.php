@extends('index.layouts.shop')
@include('index.layouts.footerjs')
@section('title', '商品详情')
@section('content')

@include('index.layouts.navbar')
@include('index.layouts.cartmenu')
@include('index.layouts.navright')
@include('index.layouts.footerjs')



<!-- shop single -->
<div class="pages section">

    <div class="container">
        <div class="shop-single">
            <img src="/storage/{{$goods['goods_img']}}" width="100" height="100" alt="">
            <h5>{{$goods['goods_name']}}</h5>
            <div class="price">${{$goods['shop_price']}} <span>${{$goods['shop_price']}}{{$goods['shop_price']}}</span></div>
            <p>{{$goods['goods_desc']}}</p>

                <button class="btn button-default" data-gid="{{$goods['goods_id']}}" id="cart_add">加入购物车</button>
                <a class="btn button-default" href="{{url('/cart/cartlist')}}">购物车页面</a>
            @if($goods['fav'] == 0)
            <button type="button" class="btn button-default" id="fav" goods_id="{{$goods['goods_id']}}">收藏</button>
            @else
            <button type="button" id="fav" class="btn">已收藏</button>
            @endif
        </div>

        <!-- 视频展示 开始 -->
        <div class="prism-player" id="player-con"></div>
        <!-- 视频展示 结束 -->

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
                    <h5>{{$goods['goods_name']}}</h5>
                    <div class="price">${{$goods['shop_price']}} <span>${{$goods['shop_price']}}{{$goods['shop_price']}}</span></div>
                    <p>{{$goods['goods_desc']}}</p>

                    <div class="form-button">
                        <form action="/ShopSingle" method="post">
                            <div class="col-md-10 data editer">
                                <textarea class="tt" name="content" style="width:800px;height:400px;visibility:hidden;" ></textarea>
                            </div>
                            </center>
                            </br>
                            <div class="btn-toolbar list-toolbar">
                                <input type="submit" id="tj" value="提交" class="btn btn-primary" ng-click="setEditorValue();save()" style="margin-left: 80%;">
                            </div>
                        </form>
{{--                        回复反馈--}}
                        @foreach($shop_fan as $k=>$v)
                            <div id="aa" style="border:1px solid red; width:700px;margin-left: 18%;background:pink;">
                                <p>网名:{{$v->f_name}}</p>
                                <p>评价内容:{{$v->f_text}}</p>
                                <p>{{date("Y-m-d H:i:s",$v->f_time)}}</p>
                                <input type="button" id="hf" f_id="{{$v->f_id}}" value="回复" class="btn btn-primary" ng-click="setEditorValue();save()" style="margin-left: 90%;">
                            </div>
                            @foreach($v['aa'] as $kk=>$vv)
                                <div style="border:1px solid red; width:500px;margin-left: 34%;background:pink;">
                                    <p>网名:{{$vv['f_name']}}回复{{$v['f_name']}}</p>
                                    <p>评价内容:{{$vv['f_text']}}</p>
                                    <p>{{date("Y-m-d H:i:s",$vv->f_time)}}</p>
                                </div>
                                <br>
                                    @endforeach
                                </br>
                            @endforeach

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
{{--//富文本--}}
<link rel="stylesheet" href="/adm/plugins/kindeditor/themes/default/default.css" />
<script charset="utf-8" src="/adm/plugins/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/adm/plugins/kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript" src="/qtai/js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="/qtai/js/plugins/jquery.easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="/qtai/js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="/qtai/js/widget/nav.js"></script>



<div class="prism-player" id="player-con"></div>
<script>
    var player = new Aliplayer({
            "id": "player-con",
            "source": "/storage/{!! $goods['m3u8'] !!}",
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
<script type="text/javascript">
    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('textarea[name="content"]', {
            allowFileManager : true
        });
    });
    //当前页面
    $(document).on("change","#cate_id",function(){
        var cate_id=$(".cate_id:selected").val();
//        console.log(cate_id);
        $.ajax({
            url: "{{'/admin/goods/brand_list'}}",
            type: 'post',
            data: {cate_id:cate_id},
            dataType: 'html',
            success: function (res) {
                $("#brand_list").html(res);
            }
        });
    });


<script>
    $(function(){

        //购物车
        $("#cart_add").click(function(e){
            var gid = ($(this).attr('data-gid'))
            $.ajax({
                url: '/cart/add?id=' + gid,
                type: 'get',
                dataType: 'json',
                success:function(d){
                    console.log(d);
                    if(d.errno==0)
                    {
                        $.MessageBox("加入购物车成功");
                    }
                }
            });
        });
        //评论


    })
</script>
<script>
    $(document).on("click","#hf",function(){
        var _this=$(this);
        var f_id= _this.attr("f_id");
        var input="<input type='text' name='aa' f_id="+f_id+" class='input_name'><input type='button' id='fb' value='发布'>";
        var vv=_this.parents('#aa').find("[name='aa']").prop("class");
        // console.log(vv);return;undefined
        if(vv==null){
            _this.parents('#aa').append(input);
        }
    })
    $(document).on("click","#fb",function(){
        var _this=$(this);
        var f_id=_this.prev('input').attr('f_id');
        var input_name=_this.prev('input').val();
        // console.log(f_id);
        var data={};
        data.f_id=f_id;
        data.input_name=input_name;
        $.ajax({
            url:"/huiAdd",
            data:data,
            dataType:"json",
            success:function(res){
                if(res.code==200){
                    window.location.href=""
                }else if(res.code==500){
                    window.location.href=res.url
                }
            }
        })
    })
    });

    $("#fav").on('click',function(){
        var goods_id = $(this).attr("goods_id");
        $.ajax({
            url: "/goods/fav?id=" + goods_id,
            type: "get",
            dataType: 'json',
            success: function(d){
                if(d.error==0)
                {
                    $.MessageBox("收藏成功");
                    $("#fav").text("已收藏")
                }else{
                    $.MessageBox(d.msg);
                }
            }
        });
    });
</script>

@endsection

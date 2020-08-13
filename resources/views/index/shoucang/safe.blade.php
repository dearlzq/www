<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>设置-个人信息</title>
    <link rel="icon" href="/assets/img/favicon.ico">

    <link rel="stylesheet" type="text/css" href="/qtai/css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="/qtai/css/pages-seckillOrder.css" />
</head>

<body>

<script type="text/javascript" src="/qtai/js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){
        $("#service").hover(function(){
            $(".service").show();
        },function(){
            $(".service").hide();
        });
        $("#shopcar").hover(function(){
            $("#shopcarlist").show();
        },function(){
            $("#shopcarlist").hide();
        });

    })
</script>
<script type="text/javascript" src="/qtai/js/plugins/jquery.easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="/qtai/js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="/qtai/js/widget/nav.js"></script>
</body>
<!--header-->
<div id="account">
    <div class="py-container">
        <div class="yui3-g home">
            <!--左侧列表-->
            <div class="yui3-u-1-6 list">

                <div class="person-info">
                    <div class="person-photo"><img src="/qtai/img/_/photo.png" alt=""></div>
                    <div class="person-account">
                        <span class="name">Michelle</span>
                        <span class="safe">账户安全</span>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="list-items">
                    <dl>
                        <dt><i>·</i> 订单中心</dt>
                        <dd ><a href="home-index.html"   >我的订单</a></dd>
                        <dd><a href="home-order-pay.html" >待付款</a></dd>
                        <dd><a href="home-order-send.html"  >待发货</a></dd>
                        <dd><a href="home-order-receive.html" >待收货</a></dd>
                        <dd><a href="home-order-evaluate.html" >待评价</a></dd>
                    </dl>
                    <dl>
                        <dt><i>·</i> 我的中心</dt>
                        <dd><a href="" >我的收藏</a></dd>
                    </dl>
                </div>
            </div>
            <!--右侧主内容-->
            <div class="yui3-u-5-6">
                <div class="body userSafe">
                    <ul class="sui-nav nav-tabs nav-large nav-primary ">
                        <li class="active"><a href="#one" data-toggle="tab">密码设置</a></li>
                        <!-- <li><a href="#two" data-toggle="tab">绑定手机</a></li> -->
                    </ul>
                    <div class="tab-content ">
                        <div id="one" class="tab-pane active">
                            <form class="sui-form form-horizontal sui-validate" id="jsForm">
                                <div class="control-group">
                                    <label for="inputusername" class="control-label">用户名：</label>
                                    <div class="controls" id='user_name' user_name="{{$res['user_name']}}">
                                    {{$res['user_name']}}
                                    <!-- <input id="pwdid" type="text" name="u_name"/> -->

                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="inputPassword" class="control-label">原密码：</label>
                                    <div class="controls">
                                        <input class="fn-tinput" type="password" name="password" value="" placeholder="新密码" required id="password" data-rule-remote="php.php"  name="u_pwd" id="u_pwd">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="inputPassword" class="control-label">新密码：</label>
                                    <div class="controls">
                                        <input class="fn-tinput" type="password" name="new_pwd" value="" placeholder="新密码" required id="password" data-rule-remote="php.php"  name="u_pwd" id="u_pwd">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="inputRepassword" class="control-label">重复密码：</label>
                                    <div class="controls">
                                        <input class="fn-tinput" type="password" id="re_pwd" name="=re_pwd" value="" placeholder="确认新密码" required equalTo="#password" name="u_pwd" id="u_pwd">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label"></label>
                                    <div class="controls">
                                        <button type="button" id="change" class="sui-btn btn-primary">修改密码</button>
                                    </div>
                                </div>
                            </form>
                        </div>
        </div>
    </div>
</div>




</html>

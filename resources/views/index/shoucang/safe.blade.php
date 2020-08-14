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

                <div class="list-items">
                    <dl>
                        <dt><i>·</i> 订单中心</dt>
                        <dd ><a href=""   >我的订单</a></dd>
                        <dd><a href="" >待付款</a></dd>
                        <dd><a href=""  >待发货</a></dd>
                        <dd><a href="" >待收货</a></dd>
                    </dl>
                    <dl>
                        <dt><i>·</i> 我的中心</dt>
                        <dd><a href="/collect" >我的收藏</a></dd>
                        <dd><a href="/lists" >修改密码</a></dd>
                        <dd><a href="/fankui" >留言板</a></dd>


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
                                    <div class="controls" id='u_name' u_name="{{$res['u_name']}}">
                                    {{$res['u_name']}}
                                    <!-- <input id="pwdid" type="text" name="u_name"/> -->

                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="inputPassword" class="control-label">原密码：</label>
                                    <div class="controls">
                                        <input class="fn-tinput" type="password" name="u_pwd" value="" placeholder="新密码" required id="password" data-rule-remote="php.php"  name="u_pwd" id="u_pwd">
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



</div>
    </div>
</div>
</html>
<script src="/adm/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="/adm/plugins/bootstrap/js/bootstrap.min.js"></script>

<script>
    $(function(){
        $(document).on('click','#change',function(){
            var data = {};
            data.u_name = $("#u_name").attr('u_name');
            data.u_pwd = $('input[name=u_pwd]').val();
            data.new_pwd = $('input[name=new_pwd]').val();
            var re_pwd = $('#re_pwd').val();
            if(data.u_pwd == data.new_pwd){
                alert("新密码不能和旧密码一致！");
                return false;
            }
            if(data.new_pwd != re_pwd){
                alert("两次密码必须一致！！");
                return false;
            }
            $.ajax({
                data:data,
                type:'post',
                dataType:'json',
                url:'/login_do',
                success:function(res){
                    if(res.errno == 00001){
                        alert(res.msg);
                    }else{
                        alert(res.msg);
                        location.href = '/login';
                    }
                }
            })
        }) ;
    });
</script>


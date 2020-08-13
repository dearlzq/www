@extends('index.layouts.shop')

@section('title', '注册')
@section('content')
    <!-- register -->
    <div class="pages section">
        <div class="container">
            <div class="pages-head">
                <h3>REGISTER</h3>
            </div>
            <div class="register">
                <div class="row">
                    <form class="col s12" >
                        @csrf
                        <div class="input-field">
                            <input type="text" class="validate" placeholder="用户名" id="u_name" name="u_name"  required>
                        </div>
                        <div class="input-field">
                            <input type="password" placeholder="密码" class="validate" id="u_pwd" name="u_pwd" required>
                        </div>
                        <div class="input-field">
                            <input type="password" placeholder="确认密码" class="validate" id="repwd"  name="" required>
                        </div>
                        <div class="input-field">
                            <input type="password" placeholder="手机号" class="validate" id="u_phone" name="u_phone" required>
                        </div>
                        <div class="input-field">
                            <input type="text" placeholder="短信验证码" class="validate" id="code" name="code" >  <a href="#" id="verify">获取短信验证码</a>

                        </div>

                        <div><input type="submit" class="btn button-default" id="reg" value="REGISTER"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end register -->


    <!-- loader -->
    <div id="fakeLoader"></div>
    <!-- end loader -->
@endsection

<script src="/admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="/admin/plugins/bootstrap/js/bootstrap.min.js"></script>

<script>
    //发送手机验证码
    $(document).on('click','#verify',function(){
        var u_phone = $('#u_phone').val();
        // alert(123);
        $.ajax({
            url:'/go_reg',
            type:'post',
            dataType:'json',
            data:{'u_phone':u_phone},
            success:function(res){
                alert(res.msg);
            }

        });
    });


    //注册
    $(document).on('click','#reg',function(){
        var u_name = $('#u_name').val();
        var u_phone = $('#u_phone').val();
        var code = $('#code').val();
        var u_pwd = $('#u_pwd').val();
        var repwd = $('#repwd').val();

        if(repwd != u_pwd){
            alert('两次密码不一致');
            return false;
        }
        if(!validatorTel(u_phone)){
            alert("手机号格式不正确哦");
        }

        //alert(123);
        $.ajax({
            url: '/reg_do',
            type: 'post',
            dataType: 'json',
            data: {'u_name': u_name, 'u_phone': u_phone, 'code': code, 'u_pwd': u_pwd},
            success: function (res) {
                //console.log(res);

                if(res.code==0){
                    alert('注册成功')
                    location.href='/index/user/login'
                }else{
                    alert(res.msg);
                }

//
            }

        });
    });
    /*
     * 验证手机号码
     */
    function validatorTel(content){

        // 正则验证格式
        eval("var reg = /^1[34578]\\d{9}$/;");
        return RegExp(reg).test(content);
    }

</script>


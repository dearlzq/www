@extends('index.layouts.shop')

@section('title', '登录')
@section('content')


    <!-- login -->
    <div class="pages section">
        <div class="container">
            <div class="pages-head">
                <h3>LOGIN</h3>
            </div>
            <div class="login">
                <div class="row">
                    <form class="col s12" >
                        @csrf
                        <div class="input-field">
                            <input type="text" class="validate" placeholder="手机号" id="u_phone" name="u_phone" required>
                        </div>
                        <div class="input-field">
                            <input type="password" class="validate" placeholder="密码" id="u_pwd"  name="u_pwd" required>
                        </div>
                        <a href=""><h6>Forgot Password ?</h6></a>
                        <input type="submit" class="btn button-default" id="login" value="LOGIN">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end login -->

    <!-- loader -->
    <div id="fakeLoader"></div>
    <!-- end loader -->

@endsection
<script src="/adm/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="/adm/plugins/bootstrap/js/bootstrap.min.js"></script>
<script>
    $(document).on('click','#login',function(){
        var u_phone = $('#u_phone').val();
        var u_pwd = $('#u_pwd').val();
        $.ajax({
            url:'/login_dos',
            type:'post',
            dataType:'json',
            data:{'u_phone':u_phone,'u_pwd':u_pwd},
            success:function(res){
                if(res.code==00000){
                    alert(res.msg);
                    location.href = '/';
                }else{
                    alert(res.msg);
                }
            }
        })

    });

</script>

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
                            <input type="text" class="validate" placeholder="手机号" id="tel" name="tel" required>
                        </div>
                        <div class="input-field">
                            <input type="password" class="validate" placeholder="密码" id="password"  name="password" required>
                        </div>
{{--                        <a href=""><h6>Forgot Password ?</h6></a>--}}
                        <input type="button" class="btn btn-default" id="login" value="LOGIN">
                        <a href="/reg" class="btn btn-default">注册</a>
                        <div class="input-field">
{{--                            <a href="/user/login/github"><img src="/static/img/github.jpg" alt=""></a>--}}
{{--                            <a href="#"><img width="93" src="/img/wx.png" alt=""></a>--}}
{{--                            <a href="#"><img width="93" src="/img/qq.png" alt=""></a>--}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end login -->

    <!-- loader -->
    <div id="fakeLoader"></div>
    <!-- end loader -->

    <script src="/adm/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="/adm/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script>
        $("#login").click(function () {
            var tel = $('#tel').val();
            var password = $('#password').val();
            $.post('/login_dos',{'tel':tel,'password':password},function (res) {
                if(res.code=='00001'){
                    alert(res.msg);
                }
                if(res.code=='00002'){
                    alert(res.msg);
                }
                if(res.code=='00000'){
                    location.href = "/"
                }
            },'json');
        });

    </script>
@endsection


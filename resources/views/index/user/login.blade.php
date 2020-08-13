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
                    <form class="col s12" action="{{url('/DoLogin')}}" method="post">
                        @csrf
                        <div class="input-field">
                            <input type="text" class="validate" placeholder="USERNAME" name="user_name" required>
                        </div>
                        <div class="input-field">
                            <input type="password" class="validate" placeholder="PASSWORD" name="password" required>
                        </div>
                        <a href=""><h6>Forgot Password ?</h6></a>
                        <input type="submit" class="btn button-default" value="LOGIN">
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

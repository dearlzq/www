@extends('index.layouts.shop')

@section('title', '支付完成')
@section('content')

@include('index.layouts.navbar')
@include('index.layouts.navright')
@include('index.layouts.footerjs')
@include('index.layouts.cartmenu')

<!-- side nav right-->
<div class="side-nav-panel-right">
    <ul id="slide-out-right" class="side-nav side-nav-panel collapsible">
        <li class="profil">
            <img src="/img/profile.jpg" alt="">
            <h2>John Doe</h2>
        </li>
        <li><a href="setting.html"><i class="fa fa-cog"></i>Settings</a></li>
        <li><a href="about-us.html"><i class="fa fa-user"></i>About Us</a></li>
        <li><a href="contact.html"><i class="fa fa-envelope-o"></i>Contact Us</a></li>
        <li><a href="login.html"><i class="fa fa-sign-in"></i>Login</a></li>
        <li><a href="register.html"><i class="fa fa-user-plus"></i>Register</a></li>
    </ul>
</div>
<!-- end side nav right-->


<!-- cart -->
<div class="cart section" style="height:245px">
    <div class="container">
        <div class="pages-head">
            <h3><a href="/">回首页</a></h3>
            <br>
            <br>

            <h2>{{$msg}}</h2>
        </div>
    </div>
</div>
<!-- end cart -->
@endsection
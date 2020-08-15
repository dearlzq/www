@extends('index.layouts.shop')

@section('title', '支付')
@section('content')

@include('index.layouts.navbar')
@include('index.layouts.navright')
@include('index.layouts.footerjs')
@include('index.layouts.cartmenu')


<!-- side nav right-->
<div class="side-nav-panel-right">
    <ul id="slide-out-right" class="side-nav side-nav-panel collapsible">
        <li class="profil">
            <img src="img/profile.jpg" alt="">
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

<!-- checkout -->
<div class="checkout pages section">
    <div class="container">
        <div class="pages-head">
            <h3>结算</h3>
        </div>
        <div class="checkout-content">
            <div class="row">
                <div class="col s12">
                    <ul class="collapsible" data-collapsible="accordion">
                        <li class="active">
                            <div class="collapsible-header active"><h5>付款方式</h5></div>
                            <div class="collapsible-body">
                                <div class="payment-mode">
                                    <p></p>
                                    <form method="post" action="/pay/add?ordid={{$_GET['ordid']}}" class="checkout-radio">
                                        {{csrf_field()}}
                                        <div class="input-field">
                                            <input checked type="radio" class="with-gap" id="bank-transfer" name="pay_type" value="1">
                                            <label for="bank-transfer"><span><img width="50" src="https://dss0.bdstatic.com/70cFvHSh_Q1YnxGkpoWK1HF6hhy/it/u=765355096,2080940444&fm=26&gp=0.jpg"
                                                                                  alt=""></span></label>
                                        </div>
                                        <div class="input-field">
                                            <input type="radio" class="with-gap" id="cash-on-delivery" name="pay_type" value="2">
                                            <label for="cash-on-delivery"><span><img width="50" src="https://dss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=2403234292,1073721747&fm=26&gp=0.jpg"
                                                                                     alt=""></span></label>
                                        </div>
                                        <div class="input-field">
                                        </div>
                                        <input type="submit" class="btn button-default" value="支付">
                                    </form>
                                </div>
                            </div>



                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end checkout -->


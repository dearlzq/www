<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//计划任务
Route::prefix('/cron')->group(function (){
    Route::get('/codec','Cron\VideoCron@codec');   //定时转码
});

Route::get('/','Index\IndexController@index');//首页




//商品
Route::get('/goods/shop-single/{id}','Goods\GoodsController@ShopSingle');//商品详情
Route::get('/goods/product-list','Goods\GoodsController@ProductList');//商品列表
Route::get('/goods/talklist/','Goods\GoodsController@talklist');//商品评论
Route::get('/goods/top/','Goods\RankController@index');//排行榜
//Route::any('/fanAdd','Goods\GoodsController@fanAdd');//执行
//Route::any('/fankui','Goods\GoodsController@fankui');//展示



//购物车
Route::get('/cart/add','Cart\CartController@add');//加入购物车
Route::get('/cart/cartlist','Cart\CartController@cartList');//购物车列表
Route::get('/cart/talk','Cart\CartController@talk');//评论


Route::get("/goods/fav","Goods\GoodsController@fav");//收藏

Route::get("/shoucang","Shoucang\ShouController@wish_list");//收藏列表
Route::get("/shoucang/add","Shoucang\ShouController@wish_add");//收藏列表
Route::get("/shoucang/del","Shoucang\ShouController@wish_del");//取消收藏
//订单
Route::any('/order/index','Order\IndexController@index');
//支付
Route::get('/pay/checkout','Pay\IndexController@index');//支付
Route::any('/pay/add','Pay\IndexController@add');//
Route::any('/pay/alireturn','Pay\IndexController@alireturn');//支付同步
Route::any('/pay/alinotify','Pay\IndexController@alinotify');//支付异步
//评论留言
Route::any('/fankui','liuyan\FanController@fankui');//展示
Route::any('/fanAdd','liuyan\FanController@fanAdd');//执行
Route::any('/huiAdd','liuyan\FanController@huiAdd');//回复

//个人信息
Route::any('/add','Shoucang\ShouController@add');
Route::any('/add_do','Shoucang\ShouController@add_do');

//前台登录
Route::any('/login','User\UserController@login'); //登录展示
Route::any('/login_dos','User\UserController@login_do'); //执行登录
Route::get('/user/login/github','User\UserController@githubLogin'); //github登录跳转
Route::get('/oauth/github','User\OauthController@github'); //github授权回跳地址
//前台注册
Route::any('/reg','User\UserController@reg');//注册
Route::any('/reg/sendSMS','User\UserController@sendSMS');//发送短信验证码
Route::any('/reg_do','User\UserController@reg_do');//执行注册
Route::any('/tuichu','User\UserController@tuichu');//退出执行

//个人中心
Route::any('/lists','Shoucang\SafeController@lists');//修改密码
Route::any('/login_do','Shoucang\SafeController@login_do');





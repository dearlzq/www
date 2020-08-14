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
Route::get('/goods/top/'    ,'Goods\RankController@index');//排行榜

//Route::any('/lists','wish\WishController@lists');  //我的收藏
//购物车
Route::get('/cart/add','Cart\CartController@add');//加入购物车
Route::get('/cart/cartlist','Cart\CartController@cartList');//购物车列表
//评论留言
Route::any('/fankui','liuyan\FanController@fankui');//展示
Route::any('/fanAdd','liuyan\FanController@fanAdd');//执行
Route::any('/huiAdd','liuyan\FanController@huiAdd');//回复

//个人信息
Route::any('/add','index\HomeController@add');
Route::any('/add_do','index\HomeController@add_do');
Route::any('/city','index\HomeController@city');

//前台登录
Route::any('/login','User\UserController@login'); //登录展示
Route::any('/login_dos','User\UserController@login_do'); //执行登录
//前台注册
Route::any('/reg','User\UserController@reg');//注册
Route::any('/go_reg','User\UserController@go_reg');//发送短信验证码
Route::any('/reg_do','User\UserController@reg_do');//执行注册
Route::any('/tuichu','User\UserController@tuichu');//退出执行

//个人中心
Route::any('/lists','Shoucang\SafeController@lists');//修改密码
Route::any('/login_do','Shoucang\SafeController@login_do');





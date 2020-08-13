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

//Route::get('/', function () {

//    return view('welcome');
//});

Route::get('/','Index\IndexController@index');//首页

//商品
Route::get('/goods/shop-single/{id}','Goods\GoodsController@ShopSingle');//商品详情
Route::get('/goods/product-list','Goods\GoodsController@ProductList');//商品列表

//Route::any('/lists','wish\WishController@lists');  //我的收藏

//评论留言
Route::any('/fankui','liuyan\FanController@fankui');//展示
Route::any('/fanAdd','liuyan\FanController@fanAdd');//执行
Route::any('/huiAdd','liuyan\FanController@huiAdd');//回复

//个人信息
Route::any('/add','index\HomeController@add');
Route::any('/add_do','index\HomeController@add_do');
Route::any('/city','index\HomeController@city');

//前台登录注册
Route::get('/reg','User\UserController@reg');//注册
Route::post('/DoReg','User\UserController@DoReg');//注册
Route::get('/login','User\UserController@login');//登陆
Route::post('/DoLogin','User\UserController@DoLogin');//登陆

//个人中心
Route::any('/lists','Shoucang\SafeController@lists');//修改密码
Route::any('/login_do','Shoucang\SafeController@login_do');



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

<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {
    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('goods-models', GoodsController::class); //商品管理
    $router->resource('order-models', OrderController::class); //订单管理
    $router->resource('video-models', VideoController::class); //视频管理
    $router->resource('category-models', CategoryController::class); //分类管理
});

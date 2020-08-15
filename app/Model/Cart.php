<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;
class Cart extends Model
{
    /*
     * 获取商品和数量
     */
    public static function goods()
    {
        $uuid = $_COOKIE['uuid'];
        $redis_cart_ss_goods_num = 'ss:cart:goods_num:' . $uuid;
        //获取购物车中商品的数量
        return Redis::zrevRange($redis_cart_ss_goods_num, 0, -1, true);
    }
    /**
     * 删除购物车的商品以及数量
     *
     */
    public static function clear()
    {
        $uuid = $_COOKIE['uuid'];
        $key1 = 'ss:cart:goods:'.$uuid;         //商品
        $key2 = 'ss:cart:goods_num:'.$uuid;     //商品个数
        Redis::del($key1,$key2);
    }
}

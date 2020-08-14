<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\CartModel;
use App\Model\Goods;
use Illuminate\Support\Facades\Redis;
class CartController extends Controller
{

    public function __construct()
    {
        $this->now = time();
        $this->uuid = $_COOKIE['uuid'];
    }
    public $now;
    public $uuid;
    public function cartList()
    {
        return view('index.cart.cartlist');
    }

    /**
     * 添加
     */
    public function add(Request $request)
    {
        $goods_id = intval($request->get('id'));
        $num = intval($request->get('num',1));

        //判断是否有此商品
        $g = Goods::find($goods_id);
        if($g == NULL)      //商品不存在
        {
            return [
                'errno' => 40004,
                'msg'   => '商品不存在'
            ];
        }
        $uuid = $_COOKIE['uuid'];
        $redis_cart_ss1 = 'ss:cart:goods:'.$uuid;
        $redis_cart_ss2 = 'ss:cart:goods_num:'.$uuid;

        //获取商品信息
        if(Redis::zScore($redis_cart_ss1,$goods_id) == false){
            Redis::zAdd($redis_cart_ss1,$this->now,$goods_id);
        }
        $num = Redis::zIncrBy($redis_cart_ss2,$num,$goods_id);    //增加购物车商品数量

        $response = [
            'errno' => 0,
            'msg'   => 'ok'
        ];

        return $response;
    }

}

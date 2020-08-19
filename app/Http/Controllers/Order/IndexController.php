<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Model\Goods;
use Illuminate\Http\Request;
use App\Model\Cart;
use App\Model\OrderModel;
use App\Model\OrderGoodsModel;

class IndexController extends Controller
{
    public function index()
    {
//        if($uid = session('u_id') == null)
//        {
//            header('Refresh:2;url=/login');
//            echo '请先登录正在跳转';
//            die;
//        }
        $uid = 1;
        //获取购物车商品
        $cart_goods = Cart::goods();
        if(empty($cart_goods))
        {
            return view('index.cart.aww');
        }

        $total = 0;
        foreach($cart_goods as $k=>$v){
            $price = Goods::find($k)->shop_price; //商品的单价
            $total += $price * $v; //订单总价

        }

        //订单入库，订单商品入库
        $order_sn = OrderModel::generateOrderSN($uid);

        $order_info = [
            'order_sn'      => $order_sn,
            'user_id'       => $uid,
            'pay_status'    => 0,           //未支付
            'order_amount'  => $total,      //总金额
            'add_time'      => time(),      //订单创建时间
        ];

        $ordid = OrderModel::insertGetId($order_info);//订单入库


        //订单商品入库
        foreach($cart_goods as $k=>$v){
            $g = Goods::select("goods_name","goods_sn","shop_price as goods_price")->find($k)->toArray();
            $g['goods_id'] = $k;
            $g['goods_number'] = $v;
            $g['order_id'] = $ordid;

            OrderGoodsModel::insertGetId($g);
        }

        //生成订单后清空购物车
        Cart::clear();
        //跳转支付页面
        $redirect = '/pay/checkout?ordid='.$ordid;
        return redirect($redirect);
    }
}

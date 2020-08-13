<?php

namespace App\Http\Controllers\Goods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods;
use Illuminate\Support\Facades\Redis;
use App\Model\VideoModel;

class GoodsController extends Controller
{
    //商品详情
    public function ShopSingle($id)
    {
//        $goods_id = $request->get('id');
        //判断是否缓存
        $key = 'h:goods_info:'.$id;       //商品hash key
        $goods_info = Redis::hgetAll($key);
        if($goods_info)         //TODO 有缓存
        {

        }else{      //无缓存

            $g = Goods::find($id);           // 查库 获取商品信息

            //商品部存在
            if(empty($g))
            {
                $data = [
                    'msg'   => '商品不存在'
                ];
                return view('error.404',$data);
            }

            $goods_info = $g->toArray();
            Redis::hMset($key,$goods_info);            //缓存商品信息
            Redis::expire($key,600);                //缓存时间 10分钟
        }

        //获取视频信息
        $v = VideoModel::where(['goods_id'=>$id])->first();

        if($v)
        {
            $goods_info['m3u8'] = $v->m3u8;
        }else{
            $goods_info['m3u8'] = "video_out/3.m3u8";        //默认视频
        }

        //记录商品浏览量  商品浏览排行
        $redis_key = 'ss:goods_view:count';         //商品浏览排行 Sorted Sets
        Redis::zIncrBy($redis_key,1,$id);

        ;
        $data = [
            'goods' => $goods_info
        ];

//        echo '<pre>';dd($data);echo '</pre>';
        return view('index.goods.shop-single',$data);

//        $goods = Goods::find($id);
//        return view('index.goods.shop-single',compact('goods'));
    }





    //商品列表
    public function ProductList()
    {

        $good = Goods::get();
        return view('index.goods.product-list',compact('good'));
    }

    public function talklist()
    {
        $data = request()->input();
        dd($data);
    }
}

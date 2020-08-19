<?php

namespace App\Http\Controllers\Goods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use http\Env\Response;
use App\Model\Goods;
use Illuminate\Support\Facades\Redis;
use App\Model\VideoModel;
use App\Model\shop_fan;
use App\Model\Indexuser;


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

        $shop_fan=shop_fan::where(['f_del'=>1,'p_id'=>0])->get();
        foreach($shop_fan as $k=>$v){
            $p_id=shop_fan::where("p_id",$v['f_id'])->get();
            $v['aa']=$p_id;
        }
        return view('index.goods.shop-single',compact('shop_fan'),$data);

    }



    //反馈的执行方法
    public function fanAdd(Request $request){
        echo '1';
        die;
        $u_id=request()->session()->get('u_id');
        if(empty($u_id)){
            return redirect('/login');
        }
        $shop_fan=new shop_fan;
        $data=$request->all();
        if(empty($data['content'])){
            return redirect('/index.goods.shop-single');
            exit;
        }
        // print_r($data);exit;
        $shop_fan->f_time=time();
        $shop_fan->f_text=$data['content'];
        $u_name=Indexuser::where('u_id',$u_id)->value('u_name');
        // print_r($u_name);
        $shop_fan->f_name=$u_name;
        $res=$shop_fan->save($data);
        if($res){
            return redirect('/index.goods.shop-single');
        };
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

    public function fav(Request $request)
    {
        if(session('u_id') == null){
            $response = ['error' => 000001, 'msg' => '未登录,请登录'];
            return $response;
        }
        $uid = session('u_id');
        $goods_id = $request->get('id',0);
        $g = Goods::find($goods_id);
        if(empty($goods_id) || empty($g)){
            $response = ['error'=>300001 , 'msg' => '收藏失败检查商品是否存在'];
            return $response;
        }
        $redis_fav_key = 'ss:fav_goods:' . $uid;
        //判断是否已收藏
        if(Redis::zScore($redis_fav_key,$goods_id))
        {
            $response = ['error' => 300002 , 'msg' => '已收藏'];
        }else{
            Redis::zAdd($redis_fav_key,time(),$goods_id);
            $response = ['error' => 0 , 'msg' => '收藏成功'];
            //加入收藏排行榜
            $redis_goods_fav_list_key = 'ss:fav_goods_rank';
            Redis::zIncrBy($redis_goods_fav_list_key,1,$goods_id);
        }
        return $response;
    }
}

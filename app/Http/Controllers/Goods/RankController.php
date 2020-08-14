<?php

namespace App\Http\Controllers\Goods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class RankController extends Controller
{
    //
    public function index()
    {
//
//        $redis_key = 'ss:goods_view:count';
////        $redis->zRevRange('key', 0, -1, true); /* array('val10' => 10, 'val2' => 2, 'val0' => 0) */
//        Redis::zRevRange($redis_key,0,1,$id);
//
//        dd($redis_key);
        return view('index.goods.rank');
    }
}

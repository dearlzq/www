<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class Goods extends Model
{
    protected $table = 'p_goods';
    protected $primaryKey = 'goods_id';
    public $timestamps =false;


    public static function detail($id)
    {
        $key = 'h:goods:'.$id;

        $goods_info = Redis::hgetall($key);
        //无缓存，读库
            if(empty($goods_info)){
            $goods_info = self::find($id)->toArray();
            //写入缓存
            Redis::hMset($key,$goods_info);
            Redis::expire($key,3600);       //设置过期时间
        }

        return $goods_info;
    }
}

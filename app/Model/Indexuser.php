<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Indexuser extends Model
{
    protected $table="shop_indexuser";
    protected $primaryKey="u_id";
    //去掉修改的默认时间
    public $timestamps=false;
    //删除的没名单
    protected $guarded=[];
}

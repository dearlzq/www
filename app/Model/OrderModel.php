<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    protected  $table='order_info';
    protected $primaryKey='order_id';
    public $timestamps = false;
    /*
     * 生成订单
     */
    public static function generateOrderSN($uid=0)
    {
        return 'SN'.$uid.date('ymdhi').mt_rand(11111,99999).mt_rand(11111,99999);
    }
}

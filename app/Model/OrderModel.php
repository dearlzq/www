<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    protected  $table='p_order_goods';
    protected $primaryKey='rec_id';
    public $timestamps = false;
}

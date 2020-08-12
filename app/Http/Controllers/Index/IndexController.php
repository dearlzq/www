<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods;

class IndexController extends Controller
{
    //首页
    public function index()
    {
        $goods = Goods::get();
        return view('index.index.index',compact('goods'));
    }
}

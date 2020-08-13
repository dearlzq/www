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
        $is_new = Goods::where('is_new','=','1')->get();
//        dd($is_new);
        $is_show = Goods::where('is_show','=','1')->get();
        return view('index.index.index',compact('goods','is_new','is_show'));
    }
}

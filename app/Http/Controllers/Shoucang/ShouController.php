<?php


namespace App\Http\Controllers\Shoucang;

use App\Http\Controllers\Controller;
use App\Model\Collert;
use Illuminate\Http\Request;
use App\Model\Goods;
use App\Model\History;
use App\Model\Indexuser;
use App\Model\shop_uneed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ShouController extends Controller
{

    //个人信息
    public function add(Request $request)
    {
        $uid = Session::get('u_id');
        $date = DB::table('date')->get();
        return view('/index/user/home', ['date' => $date]);
    }


    /**
     * @param Request $request
     * @return array
     * 执行添加
     */
    public function add_do(Request $request)
    {
        $_token = $request->all();
        $a1 = empty($_token['y_img']);
        $a2 = empty($_token['y_name']);
        if ($a1 == true || $a2 == true) {
            echo '参数缺失';
            exit;
        }
        $uid = request()->session()->get('u_id');
        $_token['u_id'] = $uid;
        //添加图片 单文件上传
        $res = shop_uneed::insert($_token);
        if ($res) {
            echo '添加成功s';
//            return redirect("admin/login/login");
        }
    }

//单文件上传
    public function uplode($y_img)
    {
        $file = $y_img;
        if ($file->isValid()) {
            $store = $file->store('uploads');
            return $store;
        }
        exit('图片上传失败');
    }


    /**
     * 收藏
     */
    public function collect()
    {
        $collert = new Collert();
        $u_id = request()->session()->get('u_id');
        $goods_id = $collert::where(['u_id' => $u_id, 'is_del' => 1])->get('goods_id')->toArray();
//        dd($goods_id);
        $goods = new Goods();
        $goods_info = $goods::where(['is_delete' => 1])->whereIn('goods_id', $goods_id)->get()->toArray();
//        dd($goods_info);

//猜你喜欢
        $history = History::where("u_id", $u_id)->limit(1)->get('goods_id')->toArray();
        if ($history) {
            $cate_id = Goods::where(["goods_id" => $history[0]['goods_id']])->first('cate_id')->toArray();
            $history_goods = Goods::where(["cate_id" => $cate_id])->orderby("desc")->limit(4)->get()->toArray();
        } else {
            $history_goods = [];
        }

        return view('/index/shoucang/shoucang', ['goods_info' => $goods_info, 'history_goods' => $history_goods]);
    }

}
?>

<?php


namespace App\Http\Controllers\Shoucang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Wish;
class ShouController extends Controller
{
    /*
     * 收藏页面
     */
    public function wish_list()
    {
        //获取用户id
        $userinfo = session("u_id");
        if (!$userinfo) { //判断是否登陆
            echo("<script>alert('请您先登录！');location='/login'</script>");
            die;
        }
        $user_id = $userinfo['user_id'];
        //获取用户收藏
        $wish = Wish::select("admin_wish.*", "p_goods.goods_id", "p_goods.goods_name", "p_goods.goods_img", "p_goods.shop_price")->
        leftjoin("p_goods", "p_goods.goods_id", "=", "admin_wish.goods_id")->
        where(['user_id' => $user_id])->
        orderBy("add_time", "desc")->
        get()->
        toArray();
        //判断用户有无商品
        if (empty($wish)) {
            echo("<script>alert('您还没有收藏过商品呢！再转转吧!');location='/'</script>");
        }
        return view("shoucang/shoucang", ['wish' => $wish]);
    }

    /*
     *加入收藏
     */
    public function wish_add()
    {
        $goods_id = request()->goods_id;//接收参数
        $userinfo = session("u_id");
        // 判断用户是否登陆
        if (!$userinfo) {
            $reposn = [
                'code' => 100008,
                'msg' => '请您先登录',
            ];
            return $reposn;
        }
        $user_id = session("u_id");;
        //判断该用户是否添加过该商品
        $dataNum = Wish::where(['goods_id' => $goods_id, "user_id" => $user_id])->count();
        if ($dataNum) {
            $reposn = [
                'code' => 100009,
                'msg' => "您已经添加过该商品，请勿重复操作!"
            ];
            return $reposn;
        }
        $data = [
            "user_id" => $user_id,
            "goods_id" => $goods_id,
            "add_time" => time()
        ];
        $res = Wish::insert($data);
        if ($res) {
            $reposn = [
                'code' => 000000,
                'msg' => "加入收藏成功!"
            ];
        } else {
            $reposn = [
                'code' => 000000,
                'msg' => "加入收藏失败!"
            ];
        }
        return $reposn;
    }

    /*
     * 取消收藏
     */
    public function wish_del()
    {
        $goods_id = request()->goods_id;//接收参数
        $userinfo = session("userinfo");
        $user_id = $userinfo['user_id'];
        if (!$goods_id) {
            $reposn = [
                "code" => 100011,
                "msg" => "非法操作"
            ];
            return $reposn;
        }
        if (!$userinfo) {
            $reposn = [
                "code" => 100011,
                "msg" => "非法操作"
            ];
            return $reposn;
        }
        $res = Wish::where(['goods_id' => $goods_id, "user_id" => $user_id])->delete();
        if ($res) {
            $reposn = [
                "code" => 000000,
                "msg" => "取消收藏成功"
            ];
        } else {
            $reposn = [
                "code" => 100012,
                "msg" => "取消收藏失败"
            ];
        }
        return $reposn;
    }
}
?>

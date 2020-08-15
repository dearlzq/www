<?php

namespace App\Http\Controllers\Shoucang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Indexuser;
use App\Model\UserModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SafeController extends Controller
{
    //安全中心
    public function lists(Request $request){
        $data=$request->all();
        $u_id=request()->session()->get('u_id');
        $res=UserModel::where("user_id",$u_id)->first();
        return view("index/shoucang/safe",compact("res"));
    }
    // 执行·
    public function login_do(Request $request)
    {
        $u_name = $request->u_name;
        $u_pwd = $request->u_pwd;
        $new_pwd = $request->new_pwd;
//        echo $u_pwd;
//        dd($new_pwd);

        $user = new UserModel();
        $isuser = $user::where('user_name',$u_name)->first();
//        dd($isuser);
        if(empty($isuser)){
            echo json_encode(['errno'=>00001,'msg'=>'此用户不存在']);
            die;
        }else if(md5($u_pwd)!=$isuser->password){
            echo json_encode(['errno'=>00001,'msg'=>'密码不正确']);
            die;
        }else{
//            $arr = array(
//                'u_pwd'=>$new_pwd
//            );
//            $res = $user::where('u_name',$u_name)->update($arr);
            $isuser->password=md5($new_pwd);
//            dd($res);
            if($isuser->save()){
                Session::flush('u_phone');
                Session::flush('u_id');
                echo json_encode(['errno'=>00000,'msg'=>'修改成功，请重新登录！']);
            }else{
                echo json_encode(['errno'=>00001,'msg'=>'修改失败']);
                die;
            }
        }

    }

}

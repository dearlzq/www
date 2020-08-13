<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\UserModel;

class UserController extends Controller
{
    //登录
    public function login()
    {
        return view('index.user.login');
    }

    public function DoLogin(Request $request)
    {
        $user_name = $request->input('user_name');
        $password = $request->input('password');
        $u = UserModel::where(['user_name'=>$user_name])->first();
        $res = password_verify($password,$u->password);
        if($res){
            setcookie('uid',$u->user_id,time()+3600,'/');
            setcookie('name',$u->user_name,time()+3600,'/');
            return redirect('/');
        }else{
            return redirect('/login');
        }
    }
    //注册
    public function reg()
    {
        return view('index.user.reg');
    }
    //执行注册
    public function DoReg(Request $request)
    {
        $user_name = $request->input('user_name');
        $email = $request->input('email');
        $password = $request->input('password');
        //获取密码长度
        $len = strlen($password);
        //判断密码不能小于6位
        if($len<6){
            die('密码不能小于6位');
        }
        //用户名是否存在
        $a = UserModel::where(['user_name'=>$user_name])->first();
        if ($a){
            die('该用户已存在');
        }
        $a = UserModel::where(['email'=>$email])->first();
        if($a){
            die("email已存在");
        }
        $password = password_hash($password,PASSWORD_BCRYPT);
        $data = [
            'user_name'=>$user_name,
            'email'=>$email,
            'password'=>$password,
            'reg_time'=>time()
        ];
        $res = UserModel::insert($data);
        if($res){
            return redirect('/login');
        }else{
            return redirect('reg');
        }
    }
}

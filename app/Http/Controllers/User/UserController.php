<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Indexuser;
use App\Model\Shop_code;
use App\model\PhoneCode;
use Illuminate\Support\Facades\DB;
use App\Model\History;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Cookie as cookies;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use Illuminate\Support\Facades\Redis;
use App\Model\UserModel;
class UserController extends Controller
{
    //注册展示页面
    public function reg(Request $request)
    {
        return view("index/user/reg");
    }

    //注册登录页面
    public function login(Request $request)
    {
        return view("index/user/login");
    }

    /**
     * @param Request $request
     * @return array
     *发送手机验证码
     */
    public function sendSMS()
    {
        $name = request()->name;
        $reg = '/^1[3|5|6|7|8|9]\d{9}$/';
        if(!preg_match($reg,$name)){
            return json_encode(['code'=>'00001','msg'=>'请输入正确的手机号']);
        }
        $code = rand(10000,999999);
        $result = $this->send($name,$code);
        if($result['Message']=='OK'){
            return json_encode(['code'=>'00000','msg'=>'发送成功']);
        }else{
            return json_encode(['code'=>'000002','msg'=>'发送成功']);
        }

    }

    public function send($name,$code){


    // Download：https://github.com/aliyun/openapi-sdk-php
    // Usage：https://github.com/aliyun/openapi-sdk-php/blob/master/README.md

            AlibabaCloud::accessKeyClient('LTAI4FxE8oZ8ZkDcFmYdaVCX', 'eOMo2F6fIxk3iqzXIfCVweSAJeaPOF')
                ->regionId('cn-hangzhou')
                ->asDefaultClient();

            try {
                $result = AlibabaCloud::rpc()
                    ->product('Dysmsapi')
                    // ->scheme('https') // https | http
                    ->version('2017-05-25')
                    ->action('SendSms')
                    ->method('POST')
                    ->host('dysmsapi.aliyuncs.com')
                    ->options([
                        'query' => [
                            'RegionId' => "cn-hangzhou",
                            'PhoneNumbers' => $name,
                            'SignName' => "可乐加冰溜子",
                            'TemplateCode' => "SMS_182680083",
                            'TemplateParam' => "{code:$code}",
                        ],
                    ])
                    ->request();
                return $result->toArray();
            } catch (ClientException $e) {
                return $e->getErrorMessage() . PHP_EOL;
            } catch (ServerException $e) {
                return $e->getErrorMessage() . PHP_EOL;
            }

    }

    /**
     * @param Request $request
     * @return array
     * 执行注册
     */
    public function reg_do(Request $request)
    {
        $tel = $request->post('tel');
        $user_name = $request->post('user_name');
        $password = $request->post('password');
        $repwd = $request->post('repwd');
        $len = strlen($password);
        $t = UserModel::where(['tel'=>$tel])->first();
        $a = UserModel::where(['user_name'=>$user_name])->first();
        if($t){
            return json_encode(['code'=>'00001','msg'=>'手机号已存在']);
        }
        if($a){
            return json_encode(['code'=>'00002','msg'=>'用户名已存在']);
        }
        if($len<6){
            return json_encode(['code'=>'00003','msg'=>'密码长度不能小于六位']);
        }
        if($repwd != $password){
            return json_encode(['code'=>'00004','msg'=>'确认密码与密码不一致']);
        }
        $password = password_hash($password,PASSWORD_BCRYPT);
        $data = [
            'user_name' => $user_name,
            'tel' => $tel,
            'reg_time' => time(),
            'password'=>$password
        ];
        $res = UserModel::insert($data);
        if(!$res){
            return json_encode(['code'=>'00005','msg'=>'注册失败']);
        }else{
            return json_encode(['code'=>'00000','msg'=>'注册成功']);
        }
    }

// 登录执行
    public function login_do(Request $request)
    {
        $tel = $request->post('tel');
        $password = $request->post('password');

        $u = UserModel::where(['tel'=>$tel])->first();

        if(!$u){
            return json_encode(['code'=>'00002','msg'=>'账号错误']);
        }else{
            $res = password_verify($password,$u->password);
            if(!$res){
                return json_encode(['code'=>'00001','msg'=>'密码错误']);
            }else{

                session(['u_phone' => $u['tel']]);
                session(['u_id' => $u['user_id']]);
                session(['u_name' => $u['user_name']]);
                $request->session()->save();

                return json_encode(['code'=>'00000','msg'=>'登录成功']);
            }
        }
    }

    //退出页面
    public function tuichu(Request $request){
        $u_id=request()->session()->put('u_id',null);
        $id=request()->session()->get('u_id');
//         print_r($id);exit;
//        dd($id);
        if($id==null){
            return redirect('/login');
        }
    }

    public function githubLogin()
    {
        $url = 'https://github.com/login/oauth/authorize?client_id='.env('OAUTH_GITHUB_ID').'&redirect_uri='.env('APP_URL').'/oauth/github';
        return redirect($url);
    }


    public function user_history_insert($u_id){
        if(!empty($u_id)){
            $sf=Cookie::get('user_history');
            if(!empty($sf)){
                $ar=unserialize($sf);
//            dd($ar);
                foreach($ar as $r5=>$t5){
                    $History_vl=History::where([['u_id',$u_id],['goods_id',$r5]])->first();
                    if($History_vl){
                        $h_hits=$t5['h_hits']+$History_vl['h_hits'];
                        History::where([['u_id',$u_id],['goods_id',$r5]])->update([
                            'h_time'=>$t5['h_time'],
                            'h_hits'=>$h_hits
                        ]);
                    }else{
                        History::insert([
                            'goods_id'=>$t5['goods_id'],
                            'u_id'=>$u_id,
                            'h_time'=>$t5['h_time'],
                            'h_hits'=>$t5['h_hits']
                        ]);
                        $ck=Cookie::queue('user_history',null);

//                  Cookie::queue(Cookie::forget('user_history'));
//                    setCookie(user_history, "", -1);
//                cookies('user_history',null);
//                dd($ck);
                        return $ck;
                    }
                }
            }
        }
    }

}






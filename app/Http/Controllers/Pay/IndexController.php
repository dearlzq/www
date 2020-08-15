<?php

namespace App\Http\Controllers\Pay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\OrderModel;
use Illuminate\Support\Str;
class IndexController extends Controller
{
    /*
     * 支付页面
     */
    public function index(){
        return view('index.pay.checkout');
    }
    /*
     * 支付
     */
    public function add(request $request){
        $order_id = $request->get('ordid');
        $pay_type = $request->get('pay_type',1);

        if($pay_type == 1){
            $return_url = $this->aliPay($order_id);
        }else{
            $return_url = $this->wxPay($order_id);
        }
//        dd($pay_type);die;
        return redirect($return_url);
    }
    protected function aliPay($order_id)
    {

        //根据订单查询到订单信息  订单号  订单金额
        $o = OrderModel::find($order_id);

        if(empty($o))       //订单不存在
        {
            echo "没有此订单";
            die;
        }

        $param2 = [
            'out_trade_no'      => $o->order_sn,     //商户订单号
            'product_code'      => 'FAST_INSTANT_TRADE_PAY',
            'total_amount'      => $o->order_amount,    //订单总金额
            'subject'           => '测试支付'.Str::random(16),
        ];

        $param1 = [
            'app_id'        => '2016101900723581',
            'method'        => 'alipay.trade.page.pay',
            'return_url'    => 'http://1910.www.com/pay/alireturn',   //同步通知地址
            'charset'       => 'utf-8',
            'sign_type'     => 'RSA2',
            'timestamp'     => date('Y-m-d H:i:s'),
            'version'       => '1.0',
            'notify_url'    => 'http://1910.www.com/pay/alinotify',   // 异步通知
            'biz_content'   => json_encode($param2),
        ];


        // 计算签名
        ksort($param1);

        $str = "";
        foreach($param1 as $k=>$v)
        {
            $str .= $k . '=' . $v . '&';
        }
        $str = rtrim($str,'&');     // 拼接待签名的字符串
        $sign = $this->sign($str);

        //沙箱测试地址
        $url = 'https://openapi.alipaydev.com/gateway.do?'.$str.'&sign='.urlencode($sign);
        return $url;
    }
    /*
     * 支付宝签名
     */
    protected function sign($data)
    {
        $priKey = file_get_contents(storage_path('keys/alipay_priv.key'));
        $res = openssl_get_privatekey($priKey);

        ($res) or die('私钥有误，请检查配置');

        openssl_sign($data, $sign, $res, OPENSSL_ALGO_SHA256);
        openssl_free_key($res);
        $sign = base64_encode($sign);
        return $sign;
    }
    /*
     * 微信支付
     */
    public function wxPay(){

    }
    /*
     * 支付宝异步
     */
    public function alinotify(){
        //记录日志
        $data = json_encode($_POST);
        Log::channel('alipay')->info($data);
    }
    /*
     * 支付宝同步
     */
    public function alireturn(){
        $data = [
            'msg'   => "您的订单： ". $_GET['out_trade_no'] . "已经支付成功啦！！！"
        ];
        return view('index.pay.jyl',$data);
    }
}

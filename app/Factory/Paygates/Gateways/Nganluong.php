<?php
namespace App\Factory\Paygates\Gateways;
use App\Modules\Paygate\Models\Paygate;
use App\Modules\Paygate\Models\PaygateLog;
use App\Modules\Setting\Models\Setting;
use App\User;
use App\Modules\Order\Models\Order;
use DB;
use Carbon\Carbon;

class Nganluong
{
	var $name = 'Ví Ngân Lượng';
	var $code = 'Nganluong';
	var $avatar = '';
	var $description = '';
	var $version = '2.0';
	var $currency_code = 'VND';
	var $url       = 'https://www.nganluong.vn/checkout.php';
	var $payment   = true;
	var $deposit   = true;
	var $withdraw  = false;
    var $instant = 1;
	var $withdrawField = [];
	var $configs = ['receiver'=>'demo@nganluong.vn','merchant_id'=>'36680','merchant_pass'=>'matkhauketnoi' , 'affiliate_code'=>''];

    public function postPayment($order)
    {
        if( $order->currency_code != $this->currency_code || $order->paygate_code !== 'Nganluong' )
        {
            return redirect()->route('home')->withErrors(['error' => 'Thanh toán không hợp lệ do người dùng thay đổi thông tin!']);
        }
        $payment_url = $this->buildCheckoutUrlExpand($order);
        return redirect($payment_url);
	}



    public function buildCheckoutUrlExpand($order)
    {

        $paygate = Paygate::where('code',$order->paygate_code)->first();
        $user = User::find($order->payer_id);
        $websetting = Setting::get();
        foreach ($websetting as $wsetting){
            $setting[$wsetting->key] = $wsetting->value;
        }
        $configs = json_decode($paygate->configs);

        $return_url = url('/payment/callback/Nganluong');
        $receiver = $configs->receiver;
        $transaction_info = $order->description;
        $order_code = $order->order_code;
        $price =$order->pay_amount;
        $currency = 'vnd';
        $quantity = 1;
        $tax = 0;
        $discount = 0;
        $fee_cal = 0;
        $fee_shipping = 0;
        $order_description = $order->description;
        $buyer_info = $order->payer_id;
        $affiliate_code = $configs->affiliate_code;

        if ($affiliate_code == "") $affiliate_code = $configs->affiliate_code;
        $arr_param = array(
            'merchant_site_code'=>	strval($configs->merchant_id),
            'return_url'		=>	strval($return_url),
            'receiver'			=>	strval($receiver),
            'transaction_info'	=>	strval($transaction_info),
            'order_code'		=>	strval($order_code),
            'price'				=>	strval($price),
            'currency'			=>	strval($currency),
            'quantity'			=>	strval($quantity),
            'tax'				=>	strval($tax),
            'discount'			=>	strval($discount),
            'fee_cal'			=>	strval($fee_cal),
            'fee_shipping'		=>	strval($fee_shipping),
            'order_description'	=>	strval($order_description),
            'buyer_info'		=>	strval($buyer_info), //"Họ tên người mua *|* Địa chỉ Email *|* Điện thoại *|* Địa chỉ nhận hàng"
            'affiliate_code'	=>	strval($affiliate_code)
        );

        /// Lưu log post
        $log = array();
        $log['order_code']= $order_code;
        $log['user']= $order->payer_id;
        $log['provider']= $order->paygate_code;
        $log['pay_amount']= $order->pay_amount;
        $log['ip']= $order->ip;
        $log['post_logs']= json_encode($arr_param);
        PaygateLog::saveLog($log);


        $secure_code ='';
        $secure_code = implode(' ', $arr_param) . ' ' . $configs->merchant_pass;

        $arr_param['secure_code'] = md5($secure_code);

        $redirect_url = $paygate->url;
        if (strpos($redirect_url, '?') === false) {
            $redirect_url .= '?';
        } else if (substr($redirect_url, strlen($redirect_url)-1, 1) != '?' && strpos($redirect_url, '&') === false) {
            $redirect_url .= '&';
        }

        /* */
        $url = '';
        foreach ($arr_param as $key=>$value) {
            $value = urlencode($value);
            if ($url == '') {
                $url .= $key . '=' . $value;
            } else {
                $url .= '&' . $key . '=' . $value;
            }
        }

        return $redirect_url.$url;
    }


    /// Hành động tiếp theo khi có dữ liệu trả về từ hàm callback trong PaygateFrontController
	public function getResponse($res)
	{
        $order = Order::where('order_code',$res['order_code'])->first();

        $log = PaygateLog::where('order_code', $res['order_code'])->orderBy('id', 'desc')->first();

        if( $log ) {
            ///Update log
            $log->payment_logs = $log->payment_logs. '----------' . json_encode($res);
            $log->update();
        }


        if( ! $order ) {
            $response['message'] = "Giao dịch không tồn tại";
        }else{

            $transaction_info =$res['transaction_info'];
            $order_code =$res['order_code'];
            $price =$res['price'];
            $payment_id =$res['payment_id'];
            $payment_type =$res['payment_type'];
            $error_text =$res['error_text'];
            $secure_code =$res['secure_code'];
            //Tạo link thanh toán đến nganluong.vn
            $checkpay= $this->verifyPaymentUrl($transaction_info, $order_code, $price, $payment_id, $payment_type, $error_text, $secure_code);

            if ($checkpay === true) {
                $order->payment = 'paid';
                $order->update();
                $response['message'] = "Giao dịch thành công";
                $response['payment'] = 'paid';
                $response['order_id'] = $order->id;
            }else{
                $response['message'] = "Giao dịch thất bại";
            }

        }


		return $response;

	}



    public function verifyPaymentUrl($transaction_info, $order_code, $price, $payment_id, $payment_type, $error_text, $secure_code)
    {

        $paygate = Paygate::where('code', $this->code )->first();
        $configs = json_decode($paygate->configs);

        // Tạo mã xác thực từ chủ web
        $str = '';
        $str .= ' ' . strval($transaction_info);
        $str .= ' ' . strval($order_code);
        $str .= ' ' . strval($price);
        $str .= ' ' . strval($payment_id);
        $str .= ' ' . strval($payment_type);
        $str .= ' ' . strval($error_text);
        $str .= ' ' . strval($configs->merchant_id);
        $str .= ' ' . strval($configs->merchant_pass);

        // Mã hóa các tham số
        $verify_secure_code = '';
        $verify_secure_code = md5($str);

        // $payment_type = 1 (thanh toan ngay), $payment_type = 2 (thanh toan tam giu)
        if ($verify_secure_code === $secure_code && $payment_type == 1){
            return true;
        }else{

            return false;
        }

    }


    function GetTransactionDetail($token){

        $paygate = Paygate::where('code', $this->code )->first();
        $configs = json_decode($paygate->configs);

        $params = array(
            'merchant_id'       => $configs->merchant_id ,
            'merchant_password' => MD5($configs->merchant_pass),
            'version'           => '2.0',
            'function'          => 'GetTransactionDetail',
            'token'             => $token
        );
        $api_url = 'http://';
        $post_field = '';
        foreach ($params as $key => $value){
            if ($post_field != '') $post_field .= '&';
            $post_field .= $key."=".$value;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$api_url);
        curl_setopt($ch, CURLOPT_ENCODING , 'UTF-8');
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_field);
        $result = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        if ($result != '' && $status==200){
            $nl_result  = simplexml_load_string($result);
            return $nl_result;
        }

        return false;

    }

    public function getCode(){
        return $this->code;
    }

    public function config(){
        $config = DB::table('paygates')->where('code','=',$this->code)->count();
        if($config >= 1){
            return "already exist";
        }else{
            $insertPaygate = DB::table('paygates')->insert([
                'currency_id'=>1,
                'currency_code'=>'USD',
                'code'=>$this->code,
                'name'=>$this->name,
                'withdraw'=>$this->withdraw,
                'withdrawField'=>json_encode($this->withdrawField),
                'deposit'=>$this->deposit,
                'payment'=>$this->payment,
                'instant'=>$this->instant,
                'description'=>$this->description,
                'avatar'=>$this->avatar,
                'url'=>$this->url,
                'configs'=>json_encode($this->configs),
                'status'=>1,
                'created_at'=>Carbon::now()
            ]);
            if($insertPaygate){
                return "success";
            }else{
                return "errors";
            }
        }
    }

    public function testFactory(){
        return "NganLuong";
    }

}

<?php
namespace App\Factory\Paygates\Gateways;
use App\Modules\Paygate\Models\Paygate;
use App\Modules\Order\Models\Order;
use DB;
use Carbon\Carbon;
class Paypal
{
	var $name = 'Cổng thanh toán Paypal';
	var $code = 'Paypal';
	var $avatar = '';
	var $description = '';
	var $version = '1.0';
	var $currency_code = 'USD';
	var $url       = 'https://www.paypal.com/webscr&cmd=_express-checkout&token=';
	var $url_endpoint       = 'https://api-3t.paypal.com/nvp';
	var $payment   = true;
	var $deposit   = true;
	var $withdraw  = false;
    var $instant = 1;
	var $withdrawField = [];
	var $configs = ['Username'=>'','Password'=>'','Signature'=>'', 'CurrencyCode'=>'USD'];

    public function postPayment($order)
    {
        if($order->paygate_code !== 'Paypal' )
        {
            return redirect()->route('home')->withErrors(['error' => 'Cổng thanh toán của đơn hàng không phải là Paypal!']);
        }

        $paygate = Paygate::where('code','Paypal')->first();
        $configs = json_decode($paygate->configs);

        $amount = convertCurrency($order->pay_amount, $order->currency_id, $paygate->currency_id);

        if(!$amount){
            return redirect()->route('home')->withErrors(['error' => 'Số tiền thanh toán không hợp lệ!']);
        }

        $tran_detail = array(
            'L_NAME0'		=> 'Pay invoice: '.$order->order_code,
            'L_AMT0'		=> $amount,
            'L_QTY0'		=> 1,
        );

        $payment_data = array(
            'METHOD'         => 'SetExpressCheckout',
            'VERSION'        => '64.0',
            'USER'           => $configs->Username,
            'PWD'            => $configs->Password,
            'SIGNATURE'      => $configs->Signature,
            'AMT'			 => $amount,
            'CURRENCYCODE'	 => $this->currency_code,
            'RETURNURL'		 => url('/payment/callback/Paypal'),
            'CANCELURL'		 => url('/payment/callback/Paypal'),
            'PAYMENTACTION'  => 'Sale',
            'DESC'  => 'Pay invoice: '.$order->order_code,
        );

        $payment_data = array_merge($payment_data, $tran_detail);

        $res_set = $this->_pp_get_res($payment_data);

        $ack = strtoupper($res_set["ACK"]);
        if ($ack && $ack == 'SUCCESS')
        {
            $order->paygate_trans = 'Paypal-'.$res_set["TOKEN"];
            $order->update();

            $token = urldecode($res_set["TOKEN"]);

            $url = $paygate->url.$token;

            return redirect($url);

        }else{
            return redirect()->to('/')->withErrors(['error' => 'Lỗi gửi thanh toán']);
        }

	}


	public function getResponse($res)
	{
		$paygate = Paygate::where('code', $this->code )->first();
		$configs = json_decode($paygate->configs);

        if(isset($res['token']) && isset($res['PayerID'])){

            $token = $res['token'];
            $payer_id = $res['PayerID'];

            // Xac thuc thong tin tra ve tu payment
            $payment_data = array(
                'METHOD'         => 'GetExpressCheckoutDetails',
                'VERSION'        => '64.0',
                'USER'           => $configs->Username,
                'PWD'            => $configs->Password,
                'SIGNATURE'      => $configs->Signature,
                'TOKEN'      	 => $token
            );

            $res_get = $this->_pp_get_res($payment_data);
            $ack = strtoupper($res_get["ACK"]);
            if ($ack != 'SUCCESS')
            {
                return FALSE;
            }

            $order = Order::where('paygate_trans','Paypal-'.$res_get['TOKEN'])->first();
            $amount = convertCurrency($order->pay_amount, $order->currency_id, $paygate->currency_id);

            // Thuc hien giao dich
            $payment_data = array(
                'METHOD'         => 'DoExpressCheckoutPayment',
                'VERSION'        => '64.0',
                'USER'           => $configs->Username,
                'PWD'            => $configs->Password,
                'SIGNATURE'      => $configs->Signature,
                'TOKEN'      	 => $token,
                'PAYERID'      	 => $payer_id,
                'AMT'			 => $amount,
                'CURRENCYCODE'	 => $this->currency_code,
                'PAYMENTACTION'  => 'Sale'
            );

            $res_do = $this->_pp_get_res($payment_data);
            $ack = strtoupper($res_do["ACK"]);
            if ($ack == 'SUCCESS')
            {
                $response = array();

                if($res_do["PAYMENTSTATUS"] == 'Completed'){
                        $order->payment = 'paid';
                        $order->update();
                        $response['message'] = "Giao dịch thành công";
                        $response['payment'] = 'paid';
                        $response['order_id'] = $order->id;
                }else{
                    $response['message'] = "Giao dịch thất bại";
                }


            }else{
                $response['message'] = "Giao dịch thất bại";
            }


            return $response;
        }

	}


    /**
     * Lay du lieu tu api endpoint cua paypal
     */
    private function _pp_get_res($params)
    {
        $curl = curl_init($this->url_endpoint);
        $curl_query = http_build_query($params);

        curl_setopt($curl, CURLOPT_PORT, 443);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($curl, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_query);

        $response = curl_exec($curl);

        if (!$response)
        {
            return false;
        }
        else
        {
            curl_close($curl);
        }

        $resArray = $this->_pp_deformat_nvp($response);

        return $resArray;
    }

    private function _pp_deformat_nvp($nvpstr)
    {
        $intial=0;
        $nvpArray = array();

        while(strlen($nvpstr))
        {
            //postion of Key
            $keypos= strpos($nvpstr,'=');
            //position of value
            $valuepos = strpos($nvpstr,'&') ? strpos($nvpstr,'&'): strlen($nvpstr);

            /*getting the Key and Value values and storing in a Associative Array*/
            $keyval=substr($nvpstr,$intial,$keypos);
            $valval=substr($nvpstr,$keypos+1,$valuepos-$keypos-1);
            //decoding the respose
            $nvpArray[urldecode($keyval)] =urldecode( $valval);
            $nvpstr=substr($nvpstr,$valuepos+1,strlen($nvpstr));
        }

        return $nvpArray;
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
        return "Paypal";
    }

}

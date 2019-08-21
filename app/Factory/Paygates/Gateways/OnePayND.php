<?php
namespace App\Factory\Paygates\Gateways;
use App\Modules\Paygate\Models\Paygate;
use App\Modules\Setting\Models\Setting;
use App\User;
use App\Modules\Order\Models\Order;
use DB;
use Carbon\Carbon;
class OnepayND
{
	var $name = 'Onepay Nội địa';
	var $code = 'OnepayND';
	var $avatar = '';
	var $description = '';
	var $version = '2.0';
	var $currency_code = 'VND';
	var $url       = 'http://mtf.onepay.vn/onecomm-pay/vpc.op';
	var $payment   = true;
	var $deposit   = true;
	var $withdraw  = false;
    var $instant = 1;
	var $withdrawField = [];
	var $configs = ['merchant_id'=>'','access_code'=>'','secure_secret'=>''];

    public function postPayment($order)
    {
        if( $order->currency_code != $this->currency_code || $order->paygate_code !== 'OnepayND' )
        {
            return redirect()->route('home')->withErrors(['error' => 'Thanh toán không hợp lệ do người dùng thay đổi thông tin!']);
        }
        $payment_url = $this->createUrl($order);
        return redirect($payment_url);
	}

	//// Hàm khởi tạo dữ liệu để post sang đối tác thực hiện thanh toán
	public function createUrl($order)
	{
		$paygate = Paygate::where('code',$order->paygate_code)->first();
        $user = User::find($order->payer_id);
        $websetting = Setting::get();
        foreach ($websetting as $wsetting){
            $setting[$wsetting->key] = $wsetting->value;
        }

		$configs = json_decode($paygate->configs);
		$SECURE_SECRET = $configs->secure_secret;
		$vpcURL = $paygate->url . "?";
		$stringHashData = "";
		$data['vpc_AccessCode'] = $configs->access_code;
		$data['vpc_Amount']     = $order->pay_amount * 100;
		$data['vpc_Command']    = 'pay';
		$data['vpc_Currency']   = $order->currency_code;
		$data['vpc_Customer_Email'] = ($user->email)? $user->email : $setting['email'];
		$data['vpc_Customer_Id']    = $user->id;
		$data['vpc_Customer_Phone'] = ($user->phone)? $user->phone : $setting['phone'];
		$data['vpc_Locale']      = 'vn';
		$data['vpc_MerchTxnRef'] = $order->order_code;
		$data['vpc_Merchant']  = $configs->merchant_id;
		$data['vpc_OrderInfo'] = 'Mua+hang+online';
		$data['vpc_ReturnURL'] = url('/payment/callback/OnepayND');
		$data['vpc_SHIP_City'] = 'Unknown';
		$data['vpc_SHIP_Country'] = 'Viet+Nam';
		$data['vpc_SHIP_Provice'] = 'Unknown';
		$data['vpc_SHIP_Street01'] = 'Unknown';
		$data['vpc_TicketNo'] = getIpClient();
		$data['vpc_Version'] = 2;

		ksort( $data );
		$appendAmp = 0;
		foreach($data as $key => $value) {
			if (strlen($value) > 0) {

				if ($appendAmp == 0) {
					$vpcURL .= urlencode($key) . '=' . urlencode($value);
					$appendAmp = 1;
				} else {
					$vpcURL .= '&' . urlencode($key) . "=" . urlencode($value);
				}

				if ((strlen($value) > 0) && ((substr($key, 0,4)=="vpc_") || (substr($key,0,5) =="user_"))) {
					$stringHashData .= $key . "=" . $value . "&";
				}
			}
		}

		$stringHashData = rtrim($stringHashData, "&");
		if (strlen($SECURE_SECRET) > 0) {
			$vpcURL .= "&vpc_SecureHash=" . strtoupper(hash_hmac('SHA256', $stringHashData, pack('H*',$SECURE_SECRET)));
		}



		return $vpcURL;
	}

	public function getResponse($res)
	{
		$paygate = Paygate::where('code', $this->code )->first();
		$configs = json_decode($paygate->configs);
		$SECURE_SECRET = $configs->secure_secret;

		$vpc_Txn_Secure_Hash = $res["vpc_SecureHash"];
        unset ($res["vpc_SecureHash"]);
		$errorExists = false;
		ksort ($res);

		if (strlen ( $SECURE_SECRET ) > 0 && $res["vpc_TxnResponseCode"] != "7" && $res["vpc_TxnResponseCode"] != "No Value Returned") {

			$stringHashData = "";

			foreach ( $res as $key => $value ) {
				if ($key != "vpc_SecureHash" && (strlen($value) > 0) && ((substr($key, 0,4)=="vpc_") || (substr($key,0,5) =="user_"))) {
					$stringHashData .= $key . "=" . $value . "&";
				}
			}

			$stringHashData = rtrim($stringHashData, "&");

			if (strtoupper ( $vpc_Txn_Secure_Hash ) == strtoupper(hash_hmac('SHA256', $stringHashData, pack('H*',$SECURE_SECRET)))) {

				$hashValidated = "CORRECT";
			} else {
				$hashValidated = "INVALID HASH";
			}
		} else {
			$hashValidated = "INVALID HASH";
		}

		$amount = $this->null2unknown ( $res["vpc_Amount"] );
		$locale = $this->null2unknown ( $res["vpc_Locale"] );
		$command = $this->null2unknown ( $res["vpc_Command"] );
		$version = $this->null2unknown ( $res["vpc_Version"] );
		$orderInfo = $this->null2unknown ( $res["vpc_OrderInfo"] );
		$merchantID = $this->null2unknown ( $res["vpc_Merchant"] );
		$merchTxnRef = $this->null2unknown ( $res["vpc_MerchTxnRef"] );
		$transactionNo = $this->null2unknown ( $res["vpc_TransactionNo"] );
		$txnResponseCode = $this->null2unknown ( $res["vpc_TxnResponseCode"] );

		$transStatus = "";
		if($hashValidated=="CORRECT" && $txnResponseCode=="0"){
			$order = Order::where('order_code',$res['vpc_MerchTxnRef'])->first();
			if( ! $order ){
                $response['message'] = "Giao dịch thất bại";
			}else if( $order->pay_amount != $res['vpc_Amount']/100 || $order->currency_code != $res['vpc_CurrencyCode'] )
			{
                $response['message'] = "Giao dịch thất bại";
			}else{
                $order->payment = 'paid';
                $order->update();
                $response['message'] = "Giao dịch thành công";
                $response['payment'] = 'paid';
                $response['order_id'] = $order->id;

			}
		}elseif ($hashValidated=="INVALID HASH" && $txnResponseCode=="0"){
            $response['message'] = "Giao dịch Pendding";
		}else {
            $response['message'] = "Giao dịch thất bại";
		}

		return $response;

	}

	private function null2unknown($data) {
		if ($data == "") {
			return "No Value Returned";
		} else {
			return $data;
		}
	}


	private function getResponseDescription($responseCode) {

		switch ($responseCode) {
			case "0" :
				$result = "Giao dịch thành công - Approved";
				break;
			case "1" :
				$result = "Ngân hàng từ chối giao dịch - Bank Declined";
				break;
			case "3" :
				$result = "Mã đơn vị không tồn tại - Merchant not exist";
				break;
			case "4" :
				$result = "Không đúng access code - Invalid access code";
				break;
			case "5" :
				$result = "Số tiền không hợp lệ - Invalid amount";
				break;
			case "6" :
				$result = "Mã tiền tệ không tồn tại - Invalid currency code";
				break;
			case "7" :
				$result = "Lỗi không xác định - Unspecified Failure ";
				break;
			case "8" :
				$result = "Số thẻ không đúng - Invalid card Number";
				break;
			case "9" :
				$result = "Tên chủ thẻ không đúng - Invalid card name";
				break;
			case "10" :
				$result = "Thẻ hết hạn/Thẻ bị khóa - Expired Card";
				break;
			case "11" :
				$result = "Thẻ chưa đăng ký sử dụng dịch vụ - Card Not Registed Service(internet banking)";
				break;
			case "12" :
				$result = "Ngày phát hành/Hết hạn không đúng - Invalid card date";
				break;
			case "13" :
				$result = "Vượt quá hạn mức thanh toán - Exist Amount";
				break;
			case "21" :
				$result = "Số tiền không đủ để thanh toán - Insufficient fund";
				break;
			case "99" :
				$result = "Người sủ dụng hủy giao dịch - User cancel";
				break;
			default :
				$result = "Giao dịch thất bại - Failured";
		}
		return $result;
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
        return "OnePayND";
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paygates;
use App\PaygateLogs;
use DB;

use App\Factory\Paygates\Gateways\Nganluong;
use App\Factory\Paygates\Gateways\OnePayND;
use App\Factory\Paygates\Gateways\Paypal;

use App\Factory\Paygates\PaygateFactory;

class PaygateController extends Controller
{

    public function __construct()
    {

    }

    public function index(){
        // Lấy các cổng thanh toán chưa được cài đặt
        $Paygates = Paygates::all();
        $CurrencyCode = DB::table('currencies_code')->select('id','code')->get();

        return view('admin.Paygate.index', compact('Paygates','CurrencyCode'));
    }

    public function destroy($id){
        $paygate = Paygates::find($id);
        $paygateName = $paygate->name;
        if($paygate->delete()){
            return redirect('admin/Paygate/Paygate')->with('thong_bao','Delete paygate ' . $paygateName. ' success');
        }else {
            return redirect('admin/Paygate/Paygate')->with('thong_bao','Delete paygate ' . $paygateName. ' filed');
        }
    }

    /**
     * Function cài đặt cổng thanh toán
     * Gọi tới các thuộc tính và tham số của lớp thanh toán
     * Update vào CSDL thông tin của cổng thanh toán đó
     * return true, false
     */
    public function config(){

        $sqlNganLuong = DB::table('paygates')
        ->where('code','=',PaygateFactory::PaygateFactory("Nganluong")->getCode())
        ->count();
        $sqlPaypal = DB::table('paygates')
        ->where('code','=',PaygateFactory::PaygateFactory("Paypal")->getCode())
        ->count();
        $sqlOnePayND = DB::table('paygates')
        ->where('code','=',PaygateFactory::PaygateFactory("OnepayND")->getCode())
        ->count();

        if($sqlNganLuong == 0){
            PaygateFactory::PaygateFactory('Nganluong')->config();
        }
        if($sqlPaypal == 0){
            PaygateFactory::PaygateFactory('Paypal')->config();
        }
        if($sqlOnePayND == 0){
            PaygateFactory::PaygateFactory('OnepayND')->config();
        }
        return redirect('admin/Paygate/Paygate');
    }
}

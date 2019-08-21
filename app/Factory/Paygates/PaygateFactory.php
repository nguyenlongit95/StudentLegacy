<?php
namespace App\Factory\Paygates;

use App\Factory\Paygates\Gateways\Paypal;
use App\Factory\Paygates\Gateways\OnePayND;
use App\Factory\Paygates\Gateways\Nganluong;

class PaygateFactory{

    public static function PaygateFactory($paygate)
    {
        if($paygate){
            switch($paygate){
                case "Paypal":
                    return new Paypal;
                    break;
                case "OnepayND":
                    return new OnePayND;
                    break;
                case "Nganluong":
                    return new Nganluong;
                    break;
                default:
                    return "null";
            }
        }else{
            return "null";
        }
    }

}

?>

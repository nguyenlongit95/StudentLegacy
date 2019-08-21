<?php

namespace App\Helpers;

use App\Seo;

class SeoService{
    public function getSeo(){
        $c_url = url()->current();
        $url = url('/');
        if($url != $c_url){
            $uri = str_replace($url, '', $c_url);
            $md5 = md5($uri);
//            dd($md5);
            $seo = Seo::where('checksum', $md5)->first();
        }else{
            /// Trang chủ
            $seo = Seo::find(1);
        }
        if($seo){
            return $seo;
        }else{
            return false;
        }
    }
}

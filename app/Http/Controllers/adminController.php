<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
class adminController extends Controller
{
    /**
     * Quan tri chung cho website
     * Chia cac vung widgets tuong tu cho website
     * widget sẽ được hiểu là các thành phần phụ của website
     * */
    public function DashBoard(){
        return view('admin.index');
    }

    public function createCart(){
        Cart::add('293ad', 'Product 1', 1, 9.99);

        return Cart::content();
    }

    public function uploadVerificationFile(Request $request){
        if($request->hasFile("verification")){
            $file = $request->file('verification');
            $filename = $file->getClientOriginalName();
            $file->move('upload/verification/',$filename);
        }
    }

    public function verification($filename){
        $path = "../public/upload/verification/".$filename.".txt";
        $open = fopen($path, "r");
        $data = fread($open, filesize($path));
        return $data;
    }
}

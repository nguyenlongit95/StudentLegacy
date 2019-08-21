<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tokenAPIController extends Controller
{
    /**
     * Phương thức trả về dữ liệu của các APIs sử dụng của 1 bên thứ 3
     * Phương thức ở đây sẽ tùy chỉnh theo cấu hình và chức năng của từng APIs
     * Xây dựng sau
     * */
    public function index(){
        return view("admin.TokenAPIs.index");
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class CurrencyController extends Controller
{
    //

    public function index(){
        $Currency = DB::table('currencies_code')->get();
        return view('admin.Currency.index', compact('Currency'));
    }

}

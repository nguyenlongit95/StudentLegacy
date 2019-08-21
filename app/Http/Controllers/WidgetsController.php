<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class WidgetsController extends Controller
{
    /**
     * Widgets dùng để quản lý các thành phần cở bản của giao diện người dùng
     * Menus
     * Header
     * Footer
     * Sidebar
     * ...
     * Sẽ được cập nhật thêm trong quá trình phát triển và tùy từng thể loại sản phẩm
     * */
    public function index(){

        $Widgets = DB::table('settings')->select('id','key','value')->get();
        if(!$Widgets){
            return response()->json(['errors','Page not settings']);
        }
        $trimWidgets = count($Widgets) / 2;
        return view("admin.widgets", compact('Widgets','trimWidgets'));
    }

    public function update(Request $request, $id){

        $this->validate($request,[
            'value'=>'required'
        ]);
        $Widgets = DB::table('settings')->where('id',$id)->update([
            'value'=>$request->value
        ]);
        if($Widgets){
            return "success";
        }else{
            return "errors";
        }
    }

    public function store(Request $request){
        $this->validate($request, [
            'key'=>'required',
            'value'=>'required'
        ]);
        $Widgets = DB::table('settings')->insert([
            'key'=>$request->key,
            'value'=>$request->value
        ]);
        if($Widgets){
            return redirect('admin/Widgets/Widgets')->with('thong_bao','Insert widgets item success');
        }else{
            return redirect('admin/Widgets/Widgets')->with('thong_bao','Insert widgets item failed');;
        }
    }

    public function destroy($id){
        $Widgets = DB::table('settings')->where('id',$id)->delete();
        if($Widgets){
            return redirect('admin/Widgets/Widgets')->with('thong_bao','Delete widgets item success');
        }else{
            return redirect('admin/Widgets/Widgets')->with('thong_bao','Delete widgets item failed');;
        }
    }
}

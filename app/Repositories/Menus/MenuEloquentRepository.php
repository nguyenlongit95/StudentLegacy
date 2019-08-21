<?php
namespace App\Repositories\Menus;

use App\CategoriesProducts;
use App\Products;
use App\ImageProducts;
use App\Rattings;
use App\Repositories\Eloquent;
use App\Repositories\Eloquent\EloquentRepository;
use DB;
class MenuEloquentRepository extends EloquentRepository implements MenuRepositoryInterface{

    public function updateChild()
    {
        $countChild = DB::table('menus')
        ->where('parent_id','=',0)
        ->where('status','=',1)->select('id')->get();
        foreach($countChild as $value){
            $sqlTemp = DB::table('menus')->where('parent_id',$value->id)->count();
            if($sqlTemp){
                $sqlTempUpdate = DB::table('menus')->where('id',$value->id)->update([
                    'count_child'=>$sqlTemp
                ]);
                if($sqlTempUpdate){
                    return "success";
                }else{
                    return "errors";
                }
            }else{
                return "nofill";
            }
        }
    }

    public function getModel()
    {
        // TODO: Implement getModel() method.
        return \App\Menus::class;
    }
}

?>

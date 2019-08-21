<?php
/*
 * Tại đây ta khai báo các phương thức cụ thể cho đối tượng
 * Class này sẽ extends EloquentRepository và Implements xxxRepositoryInterface
 * */
namespace App\Repositories\Seo;
use DB;
use App\Repositories\Eloquent\EloquentRepository;
use Illuminate\Support\Facades\File;

class SeoEloquentRepository extends EloquentRepository implements SeoRepositoryInterface {
    /*
     * Tại đây ta sẽ khai báo chi tiết các phương thức đặc biệt
     * Ta khai báo chi tiết cho phương thức getModel
     * */
   public function checkLink($link)
   {
       // TODO: Implement checkLink() method.
       $checkLink = DB::table('seo')
           ->where('link','=', $link)
           ->count();
       if($checkLink > 0){
           return "already exist";
       }else{
           return "ok";
       }
   }

   public function hasLink($link)
   {
       // TODO: Implement checkLink() method.
       if($this->checkLink($link) == "already exist"){
           return "none";
       }else{
           return md5($link);
       }
   }

   public function deleteImage($id)
   {
       // TODO: Implement deleteImage() method.
       $Seo = DB::table('Seo')->where('id','=', $id)->first();
       if(File::exists('upload/Seo/'. $Seo->avatar)){
           if(File::delete('upload/Seo/'. $Seo->avatar)){
               return "ok";
           }else{
               return "no";
           }
       }else{
           return "no file";
       }
   }

    public function getModel()
    {
        // TODO: Implement getModel() method.
        return \App\Seo::class;
    }
}

?>

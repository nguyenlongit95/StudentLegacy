<?php
/*
 * Tại đây ta khai báo các phương thức cụ thể cho đối tượng
 * Class này sẽ extends EloquentRepository và Implements CateogryRepositoryInterface
 * */
namespace App\Repositories\Blogs;

use Illuminate\Support\Facades\File;
use App\Blogs;
use App\Repositories\Eloquent\EloquentRepository;


class BlogEloquentRepository extends EloquentRepository implements BlogRepositoryInterface{
    /*
     * Tại đây ta sẽ khai báo chi tiết các phương thức đặc biệt
     * Ta khai báo chi tiết cho phương thức getModel
     * */
    public function getCategories(){

    }

    public function getDescription($id){

    }

    public function Search($keySearch){

    }
    public function deleteImageBlog($id)
    {
        // TODO: Implement deleteImageBlog() method.
        $ImageBlog = Blogs::find($id);
        if(file_exists("upload/Blogs/".$ImageBlog->image)){
            if(FIle::delete("upload/Blogs/".$ImageBlog->image)){
                $ImageBlog = Blogs::find($id);
                $ImageBlog->image = "";
                $ImageBlog->update();
                return 1;
            }else{
                return 0;
            }
        }else{
            return 2;
        }
    }
    public function insertImage($id, $Image)
    {
        // TODO: Implement insertImage() method.
        $ImageBlog = Blogs::find($id);
        $ImageBlog->image = $Image;
        if($ImageBlog->update()){
            return 1;
        }else{
            return 0;
        }
    }

    public function createSlug($title){
        $slug = changeTitle($title);
        return $slug;
    }

    public function getModel()
    {
        // TODO: Implement getModel() method.
        return \App\Blogs::class;
    }
}

?>

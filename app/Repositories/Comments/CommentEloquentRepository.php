<?php
/*
 * Tại đây ta khai báo các phương thức cụ thể cho đối tượng
 * Class này sẽ extends EloquentRepository và Implements CateogryRepositoryInterface
 * */
namespace App\Repositories\Comments;

use App\CategoriesBlog;
use App\Comments;
use App\Repositories\Eloquent;
use App\Repositories\Eloquent\EloquentRepository;

class CommentEloquentRepository extends EloquentRepository implements CommentRepositoryInterface{

    public function getParent_id($id){
        $Comment = Comments::findOrFail($id)->SELECT("Parent_id")->get();
        return $Comment;
    }

    public function getReply($id)
    {
        // TODO: Implement getReply() method.
        $Comment = Comments::WHERE(
            "parent_id",
            "=",
            $id
        )->SELECT(
            "id",
            "idBlog",
            "idUser",
            "comment",
            "author",
            "state",
            "created_at"
        )->paginate(10);
        return $Comment;
    }

    public function getIdBlog($id)
    {
        // TODO: Implement getIDBlog() method.
        $Comment = Comments::findOrFail($id)->select("idBlog")->first();
        return $Comment;
    }
    public function getIdUser($id)
    {
        // TODO: Implement getIdUser() method.
        $Comment = Comments::findOrFail($id)->select("idUser")->first();
        return $Comment;
    }
    public function updateState($id,$State){
        $Comment = Comments::findOrFail($id);
        $Comment->state = $State;
        if($Comment->update()){
            return 1;
        }else{
            return 0;
        }
    }
    public function getModel()
    {
        // TODO: Implement getModel() method.
        return \App\Comments::class;
    }
}

?>

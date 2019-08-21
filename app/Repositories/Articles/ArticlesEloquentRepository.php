<?php
/*
 * Tại đây ta khai báo các phương thức cụ thể cho đối tượng
 * Class này sẽ extends EloquentRepository và Implements CateogryRepositoryInterface
 * */
namespace App\Repositories\Articles;

use Illuminate\Support\Facades\File;
use App\Repositories\Eloquent\EloquentRepository;
use App\Article;
class ArticlesEloquentRepository extends EloquentRepository implements ArticleRepositoryInterface{

    public function deleteImage($id)
    {
        // TODO: Implement deleteImage() method.
        $Article = Article::findOrFail($id);
        if(file_exists("upload/Articles/".$Article->images)){
            if(File::delete("upload/Articles/".$Article->images)){
                return 1;
            }else{
                return 0;
            }
        }else{
            return 2;
        }
    }

    public function getModel()
    {
        // TODO: Implement getModel() method.
        return \App\Article::class;
    }
}

?>

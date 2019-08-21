<?php
/*
 * Tại đây ta khai báo các phương thức cụ thể cho đối tượng
 * Class này sẽ extends EloquentRepository và Implements CateogryRepositoryInterface
 * */
namespace App\Repositories\CategoryBlogs;

use App\CategoriesBlog;
use App\Repositories\Eloquent;
use App\Repositories\Eloquent\EloquentRepository;
use App\Repositories\CategoryBlogs\CategoryBlogRepositoryInterface;

class CateoryEloquentRepository extends EloquentRepository implements CategoryBlogRepositoryInterface{
    /*
     * Tại đây ta sẽ khai báo chi tiết các phương thức đặc biệt
     * Ta khai báo chi tiết cho phương thức getModel
     * */
    // Thực hiện chi tiết phương thức getParent_id
    public function getParent_id()
    {
        // TODO: Implement getParent_id() method.
        $getParentID = CategoriesBlog::SELECT(
            'id',
            'parent_id',
            'nameCategory'
        )->get();
        return $getParentID;
    }
    // Thực hiện chi tiết phương thức getInfo
    public function getInfo()
    {
        // TODO: Implement getInfo() method.
        $getInfo = CategoriesBlog::SELECT(
            'info'
        )->get();
        return $getInfo;
    }

    public function getModel()
    {
        // TODO: Implement getModel() method.
        return \App\CategoriesBlog::class;
    }
}

?>

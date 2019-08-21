<?php
/*
 * Tại đây ta khai báo các phương thức cụ thể cho đối tượng
 * Class này sẽ extends EloquentRepository và Implements CateogryRepositoryInterface
 * */
namespace App\Repositories\Products;

use App\CategoriesProducts;
use App\Products;
use App\ImageProducts;
use App\Rattings;
use App\Repositories\Eloquent;
use App\Repositories\Eloquent\EloquentRepository;

class ProductEloquentRepository extends EloquentRepository implements ProductRepositoryInterface{
    /*
     * Tại đây ta sẽ khai báo chi tiết các phương thức đặc biệt
     * Ta khai báo chi tiết cho phương thức getModel
     * Cập nhật hình ảnh
     * Xóa hình ảnh
     * Lấy danh mục sản phẩm
     * TÌm kiếm sản phẩm dựa theo từ khóa gửi lên
     * Lấy thông tin sản phẩm
     * Lấy hình ảnh của sản phẩm
     * Lấy model
     * */
    public function updateImage($idImage){

    }

    public function deleteImage($idImage){

    }

    public function getCategory(){
        $CategoriesProduct = CategoriesProducts::all();
        return $CategoriesProduct;
    }

    public function search($keySearch){

    }

    public function getInfo($id){
        $ProductInfo = Products::SELECT('info')
            ->WHERE('id','=',$id)
            ->get();
        if($ProductInfo){
            return $ProductInfo;
        }else{
            return null;
        }
    }

    public function getImages($idProduct){
        $ImageProduct = ImageProducts::WHERE('idProduct','=',$idProduct)->SELECT('id','imageproduct','idProduct')->get();
        return $ImageProduct;
    }

    public function getModel()
    {
        // TODO: Implement getModel() method.
        return \App\Products::class;
    }
}

?>

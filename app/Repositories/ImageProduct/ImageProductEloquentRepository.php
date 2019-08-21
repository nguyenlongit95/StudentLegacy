<?php
/*
 * Tại đây ta khai báo các phương thức cụ thể cho đối tượng
 * Class này sẽ extends EloquentRepository và Implements CateogryRepositoryInterface
 * */
namespace App\Repositories\ImageProduct;

use App\Products;
use App\ImageProducts;
use App\Repositories\Eloquent;
use App\Repositories\Eloquent\EloquentRepository;

class ImageProductEloquentRepository extends EloquentRepository implements ImageProductRepositoryInterface{
    /*
     * Lấy hình ảnh của 1 sản phẩm
     * Thay đổi hình ảnh của sản phẩm đó
     * */
    public function getImages($idProduct,$numberPaginate){
        $ImageProduct = ImageProducts::WHERE('idProduct','=',$idProduct)->SELECT('id','imageproduct','idProduct')->paginate($numberPaginate);
        return $ImageProduct;
    }
    /*
     * Tiến hành thay đổi kích cỡ hình ảnh tại đây
     * */
    public function ResizeImage($id){
        // TODO: Implement ResizeImage() method.
    }

    public function getModel()
    {
        // TODO: Implement getModel() method.
        return \App\ImageProducts::class;
    }
    public function addImage($image, $id){
        $ImageProduct = new ImageProducts();
        $ImageProduct->imageProduct = $image;
        $ImageProduct->idProduct = $id;
        if($ImageProduct->save()){
            return true;
        }else{
            return false;
        }
    }
    public function deleteImage($id){
        echo $id;
    }
}

?>

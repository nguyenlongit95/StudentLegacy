<?php
/*
 * Tại đây ta khai báo các phương thức cụ thể cho đối tượng
 * Class này sẽ extends EloquentRepository và Implements xxxRepositoryInterface
 * */
namespace App\Repositories\Rattings;
use App\Repositories\Eloquent\EloquentRepository;
use App\Rattings;

class RattingsEloquentRepository extends EloquentRepository implements RattingsRepositoryInterface {
    /*
     * Tại đây ta sẽ khai báo chi tiết các phương thức đặc biệt
     * Ta khai báo chi tiết cho phương thức getModel
     * */

    // Ở đây lấy số ratting của 1 sản phẩm
    public function getProductRatting($idProduct)
    {
        // TODO: Implement getProductRatting() method.
        /*
         * Truy vấn số ratting của 1 sản phẩm
         * Lấy tất cả ratting của 1 sản phẩm
         * Tính trung bình của số rattings của sản phẩm
         * */
        $RattingProduct = Rattings::WHERE(
            "idProduct",
            "=",
            $idProduct
        )->SELECT(
            "id",
            "ratting",
            "info"
        )->paginate(5);
        return $RattingProduct;
    }
    public function getStarAVG($idProduct){
        /*
         * Trung bình số sao của 1 sản phẩm
         * Làm tròn đến hàng đơn vị
         * */
        $StarProduct = Rattings::WHERE(
            "idProduct",
            "=",
            $idProduct
        )->SELECT("ratting")->avg("ratting");
        return $StarProduct;
    }

    public function getModel()
    {
        // TODO: Implement getModel() method.
        return \App\Rattings::class;
    }
}

?>

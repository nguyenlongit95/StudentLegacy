<?php
/*
 * Tại đây ta khai báo các phương thức cụ thể cho đối tượng
 * Class này sẽ extends EloquentRepository và Implements xxxRepositoryInterface
 * */
namespace App\Repositories\OrdersDetails;
use App\Repositories\Eloquent\EloquentRepository;
use App\OrderDetails;
use DB;
class OrderDetailsEloquentRepository extends EloquentRepository implements OrderDetilasRepositoryInterface{
    /*
     * Tại đây ta sẽ khai báo chi tiết các phương thức đặc biệt
     * Ta khai báo chi tiết cho phương thức getModel
     * */

    public function getAllPrice($idOrder)
    {
        // TODO: Implement getAllPrice() method.
        $AllPrice = OrderDetails::WHERE("idOrder","=",$idOrder)
            ->sum("price")
            ->get();
        return $AllPrice;
    }
    public function getProduct($idOrder)
    {
        // TODO: Implement getProduct() method.
        $Product = DB::table("order_details")
            ->WHERE("idOrder","=", $idOrder)
            ->get();
        return $Product;
    }
    public function updateQuantity($id, $Quantity)
    {
        // TODO: Implement updateQuantity() method.
        $OrderDetails = OrderDetails::find($id);
        $OrderDetails->quantity = $Quantity;
        if($OrderDetails->update()){
            return 1;
        }else{
            return 0;
        }
    }

    public function getModel()
    {
        // TODO: Implement getModel() method.
        return \App\OrderDetails::class;
    }
}

?>

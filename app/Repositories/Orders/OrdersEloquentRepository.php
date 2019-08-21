<?php
/*
 * Tại đây ta khai báo các phương thức cụ thể cho đối tượng
 * Class này sẽ extends EloquentRepository và Implements xxxRepositoryInterface
 * */
namespace App\Repositories\Orders;
use App\Orders;
use App\Repositories\Eloquent\EloquentRepository;

class OrdersEloquentRepository extends EloquentRepository implements OrdersRepositoryInterface{
    /*
     * Tại đây ta sẽ khai báo chi tiết các phương thức đặc biệt
     * Ta khai báo chi tiết cho phương thức getModel
     * */

    public function getModel()
    {
        // TODO: Implement getModel() method.
        return \App\Orders::class;
    }
}

?>

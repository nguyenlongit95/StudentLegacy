<?php
/*
 * Tại đây ta khai báo các phương thức cụ thể cho đối tượng
 * Class này sẽ extends EloquentRepository và Implements xxxRepositoryInterface
 * */
namespace App\Repositories\Widgets;
use App\Orders;
use App\Repositories\Eloquent\EloquentRepository;

class WidgetsEloquentRepository extends EloquentRepository implements WidgetsReporitoryInterface{
    /*
     * Tại đây ta sẽ khai báo chi tiết các phương thức đặc biệt
     * Ta khai báo chi tiết cho phương thức getModel
     * */

    public function getModel()
    {
        // TODO: Implement getModel() method.
        return \App\Widgets::class;
    }
}

?>

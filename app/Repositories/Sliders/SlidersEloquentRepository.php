<?php
/*
 * Tại đây ta khai báo các phương thức cụ thể cho đối tượng
 * Class này sẽ extends EloquentRepository và Implements xxxRepositoryInterface
 * */
namespace App\Repositories\Sliders;
use App\Rattings;
use App\Repositories\Eloquent\EloquentRepository;

class SlidersEloquentRepository extends EloquentRepository implements SliderRepositoryInterface {
    /*
     * Tại đây ta sẽ khai báo chi tiết các phương thức đặc biệt
     * Ta khai báo chi tiết cho phương thức getModel
     * */

    public function getModel()
    {
        // TODO: Implement getModel() method.
        return \App\Sliders::class;
    }
}

?>

<?php
/*
 * Tại đây ta khai báo các phương thức cụ thể cho đối tượng
 * Class này sẽ extends EloquentRepository và Implements CateogryRepositoryInterface
 * */
namespace App\Repositories\Linked;

use App\Repositories\Eloquent;
use App\Repositories\Eloquent\EloquentRepository;

class LinkedEloquentRepository extends EloquentRepository implements LinkedRepositoryInterface {


    public function getModel()
    {
        // TODO: Implement getModel() method.
        return \App\Linkeds::class;
    }
}

?>

<?php
/*
 * Tại đây ta khai báo các phương thức cụ thể cho đối tượng
 * Class này sẽ extends EloquentRepository và Implements CateogryRepositoryInterface
 * */
namespace App\Repositories\InfoOfPage;

use App\Repositories\Eloquent;
use App\Repositories\Eloquent\EloquentRepository;
use App\Contacts;

class InfoOfPageEloquentRepository extends EloquentRepository implements InfoOfPageRepositoryInterface {

    public function getModel()
    {
        // TODO: Implement getModel() method.
        return \App\InfoOfPages::class;
    }
}

?>

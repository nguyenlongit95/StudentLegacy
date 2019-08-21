<?php
/*
 * Tại đây ta khai báo các phương thức cụ thể cho đối tượng
 * Class này sẽ extends EloquentRepository và Implements CateogryRepositoryInterface
 * */
namespace App\Repositories\Currency;

use App\Repositories\Eloquent;
use App\Repositories\Eloquent\EloquentRepository;
use App\Contacts;

class CurrencyEloquentRepository extends EloquentRepository implements CurrencyRepositoryInterface{

    public function getModel()
    {
        // TODO: Implement getModel() method.
        return \App\Currency::class;
    }
}

?>

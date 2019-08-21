<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{

    protected $table="orders";

    protected $fillable=[
        "idUser",
        "name",
        "address",
        "phone",
        "total",
        "Code_order"
    ];
}

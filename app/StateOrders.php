<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StateOrders extends Model
{
    //
    protected $table="state_orders";

    protected $fillable=[
        "idOrder",
        "state"
    ];
}

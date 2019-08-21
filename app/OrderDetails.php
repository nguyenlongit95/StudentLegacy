<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    //
    protected $table="order_details";

    protected $fillable=[
        "idProduct",
        "idOrder",
        "product_name",
        "quantity",
        "price",
        "code_order"
    ];
}

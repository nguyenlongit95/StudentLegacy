<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    protected $table="products";

    protected $fillable=[
        "product_name",
        "idCategories",
        "quantity",
        "price",
        "sales",
        "info",
        "description"
    ];
}

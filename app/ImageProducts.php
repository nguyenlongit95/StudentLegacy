<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageProducts extends Model
{
    //
    protected $table="image_products";

    protected $fillable=[
        "imageproduct",
        "idProduct"
    ];
}

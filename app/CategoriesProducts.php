<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriesProducts extends Model
{
    //
    protected $table="categories_products";

    protected $fillable=[
        "nameCategory",
        "info",
        "parent_id"
    ];
}

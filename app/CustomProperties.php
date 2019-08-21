<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomProperties extends Model
{
    //
    protected $table="custom_properties";

    protected $fillable=[
        "idProduct",
        "attribute_value_id"
    ];
}

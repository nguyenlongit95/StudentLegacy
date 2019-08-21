<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    //
    protected $table="attribute";

    protected $fillable = [
        "id",
        "attribute",
        "parent_id"
    ];
}

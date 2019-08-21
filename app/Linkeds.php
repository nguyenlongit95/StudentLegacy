<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Linkeds extends Model
{
    //
    protected $table="linkeds";

    protected $fillable=[
        "linked",
        "value",
    ];
}

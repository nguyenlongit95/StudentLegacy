<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tokenAPI extends Model
{
    //
    protected $table="tokenAPIs";

    protected $fillable=[
        "partner",
        "token",
        "config"
    ];
}

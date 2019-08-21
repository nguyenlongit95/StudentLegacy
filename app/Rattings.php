<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rattings extends Model
{
    //
    protected $table="rattings";

    protected $fillable=[
        "idProduct",
        "ratting",
        "info"
    ];
}

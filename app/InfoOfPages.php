<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoOfPages extends Model
{
    //
    protected $table="info_of_pages";

    protected $fillable=[
        "pagename",
        "info",
        "value"
    ];
}

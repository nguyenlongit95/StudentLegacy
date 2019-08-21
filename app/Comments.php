<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    //
    protected $table="comments";

    protected $fillable=[
        "idBlog",
        "idUser",
        "comment",
        "author",
        "state",
        "parent_id"
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $table="articles";
    protected $fillable=[
        "title",
        "slug",
        "info",
        "details",
        "images",
        "author",
        "linked",
        "status",
        "created_at",
        "updated_at",
    ];
}

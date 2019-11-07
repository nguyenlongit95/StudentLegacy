<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "post";

    protected $fillable = [
        "id",
        "type",
        "owner_id",
        "hash_tag",
        "status",
        "title",
        "content",
        "images_enclose",
        "files_enclose",
        "links",
        "likes",
        "rates",
        "comments",
        "created_at",
        "updated_at"
    ];
}

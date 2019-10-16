<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = "blog";

    protected $fillable = [
        "id",
        "owner_id",
        "hash_tag",
        "status",
        "content",
        "images_enclose",
        "files_enclose",
        "liked",
        "rates",
        "comments",
        "created_at",
        "updated_at"
    ];
}

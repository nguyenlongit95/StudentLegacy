<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = "question";

    protected $fillable = [
        "id",
        "owner_id",
        "hash_tag",
        "status",
        "friends_tag",
        "content",
        "images_enclose",
        "files_enclose",
        "liked",
        "comments",
        "created_at",
        "updated_at"
    ];
}

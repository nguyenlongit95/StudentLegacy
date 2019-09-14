<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "Comment";

    protected $fillable = [
        "id",
        "owner_id",
        "friends_tag",
        "status",
        "content",
        "images_enclose",
        "liked",
        "replies",
        "created_at",
        "updated_at"
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = "Blog";

    protected $fillable = [
        "id",
        "owner_id",
        "friends_tag",
        "subjects_tag",
        "access_modifier",
        "status",
        "content",
        "images_enclose",
        "files_enclose",
        "liked",
        "comments",
        "created_at",
        "updated_at"
    ];
}

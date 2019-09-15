<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = "log";

    protected $fillabl = [
        "id",
        "student_id",
        "student_tag_id",
        "blog_id",
        "comment_id",
        "status",
        "created_at",
        "updated_at"
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = "schedule";

    protected $fillable = [
        "id",
        "student_id",
        "course_id",
        "time_remind",
        "completion",
        "status",
        "created_at",
        "updated_at"
    ];
}

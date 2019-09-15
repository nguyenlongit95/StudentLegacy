<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = "lesson";
    
    protected $fillable = [
        "id",
        "class_id",
        "subject_id",
        "room",
        "address",
        "week_day",
        "time_start",
        "time_end",
        "created_at",
        "updated_at"
    ];
}

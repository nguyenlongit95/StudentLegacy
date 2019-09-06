<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = "subject";
    protected $fillable = [
        "id",
        "name",
        "time_start",
        "time_end",
        "max_student",
        "fee",
        "hotline",
        "short_description",
        "description",
        "created_at",
        "updated_at"
    ];
}

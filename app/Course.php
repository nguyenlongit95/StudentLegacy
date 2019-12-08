<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = "Course";

    protected $fillable = [
        "id",
        "name",
        "avatar",
        "description",
        "purpose",
        "fee",
        "reviews",
        "rates",
        "time_limit",
        "lessions_id",	
        "branch_id",
        "student_register",
        "created_at",
        "updated_at",
        "total_student"
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $table = "statistic";

    protected $fillable = [
        "id",
        "student_id",
        "region_id",
        "number_question_post",
        "number_question_seen",
        "number_blog_post",
        "number_blog_seen",
        "number_review_post",
        "number_review_seen",
        "number_time_study",
        "created_at",
        "updated_at"
    ];
}

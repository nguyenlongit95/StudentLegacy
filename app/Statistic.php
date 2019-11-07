<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $table = "statistic";

    protected $fillable = [
        "id",
        "student_id",
        "branch_id",
        "number_question_post",
        "number_question_seen",
        "number_question_like",
        "number_question_rate",
        "number_blog_post",
        "number_blog_seen",
        "number_blog_like",
        "number_blog_rate",
        "number_review_post",
        "number_review_seen",
        "number_review_like",
        "number_review_rate",
        "number_search",
        "number_time_study",
        "created_at",
        "updated_at"
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultStatistic extends Model
{
    protected $table = "result_statistic";

    protected $fillable = [
        "id",
        "date",
        "student_id",
        "course_id",
        "lession_id",
        "completion_percent",
        "time_study_history",
        "created_at",
        "updated_at"
    ];
}

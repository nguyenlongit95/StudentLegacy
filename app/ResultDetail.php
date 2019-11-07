<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultDetail extends Model
{
    protected $table = "result_detail";

    protected $fillable = [
        "id",
        "date",
        "result_lession_id",
        "completion",
        "time_study",
        "created_at",
        "updated_at"
    ];
}

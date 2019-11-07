<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultLession extends Model
{
    protected $table = "result_lession";

    protected $filleable = [
        "id",
        "schedule_id",
        "lession_id",
        "completion",
        "created_at",
        "updated_at"
    ];
}

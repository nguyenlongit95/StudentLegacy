<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = "area";

    protected $fillable = [
        "id",
        "region_id",
        "name",
        "description",
        "number_care",
        "created_at",
        "updated_at"
    ];
}

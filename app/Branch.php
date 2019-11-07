<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = "branch";

    protected $fillable = [
        "id", 
        "name",
        "description",
        "area_id",
        "hash_tags",
        "created_at",
        "updated_at"
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Academy extends Model
{
    protected $table = "academy";

    protected $fillable = [
        "id",
        "name",
        "avatar",
        "address",
        "hotline",
        "description",
        "classes",
        "subjects",
        "created_at",
        "updated_at"
    ];
}

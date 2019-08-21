<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    protected $table="menus";

    protected $fillable=[
        "name",
        "slug",
        "parent_id",
        "level",
        "count_child",
        "status",
        "info",
        "sort",
        "created_at",
        "updated_at"
    ];
}

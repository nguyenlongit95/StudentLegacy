<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lession extends Model
{
    protected $table = "lession";
    
    protected $fillable = [
        "id",
        "name",
        "brief_content",
        "content",
        "images_enclose",
        "files_enclose",
        "links_enclose",
        "quick_test",
        "time_limit",
        "created_at",
        "updated_at"
    ];
}

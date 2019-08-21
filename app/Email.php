<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    //
    protected $table = "mails";

    protected $fillable = [
        "id",
        "name",
        "email",
        "password",
        "status",
        "created_at",
        "updated_at"
    ];
}

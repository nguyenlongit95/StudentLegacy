<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = "student";

    protected $fillable = [
        "id",
        "name",
        "phone",
        "email",
        "password",
        "address",
        "avatar",
        "friends",
        "gender",
        "description",
        "date_of_birth",
        "remember_token",
        "created_at",
        "updated_at"
    ];
    
}

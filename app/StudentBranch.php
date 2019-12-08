<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentBranch extends Model
{
    protected $table = "student_branch";

    protected $filable = [
        "id",
        "student_id",
        "branch_id",
        "ratio"
    ];
}

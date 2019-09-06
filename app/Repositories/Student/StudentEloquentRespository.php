<?php

namespace App\Repositories\Student;

use App\Repositories\Eloquent;
use App\Repositories\Eloquent\EloquentRepository;

class StudentEloquentRespository extends EloquentRepository implements StudentRespositoryInterface {

    public function getSchedule($schedule_id) {
        
    }

    public function getModel()
    {
        // TODO: Implement getModel() method.
        return \App\Student::class;
    }
}

?>
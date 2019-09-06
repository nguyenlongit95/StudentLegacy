<?php

namespace App\Repositories\Subject;

use App\Repositories\Eloquent;
use App\Repositories\Eloquent\EloquentRepository;


class SubjectEloquentRespository extends EloquentRepository implements SubjectRepositoryInterface {

    public function getSubject($id)
    {

    }

    public function getAllSubject()
    {
        
    }

    public function getModel()
    {
        // TODO: Implement getModel() method.
        return \App\Subject::class;
    }
}

?>
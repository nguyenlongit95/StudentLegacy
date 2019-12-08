<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StudentBranch;
use App\http\controllers\BranchController;

class StudentBranchController extends Controller
{
    protected $branchController;

    public function __construct(BranchController $branchCon) 
    {
        $this->branchController = $branchCon;
    }

    //get evaluate ablity of student
    public function getEvaluateAbilityByBranch($studentId) 
    {
        $results = StudentBranch::where('student_id', $studentId - 1)->get();
        $response = [];
        
        foreach ($results as $item) {
            $branch = $this->branchController->getBranch((int)$item->branch_id + 1);

            if ($branch) {
                $temp = [];
                $temp["id"] = $branch->id;
                $temp["name"] = $branch->name;
                $temp["ratio"] = $item->ratio;

                array_push($response, $temp);
            }
        }

        return response()->json(["code"=>200, "message"=>"get evaluate ability of student success", "data_array"=>$response], 200);
    }

}
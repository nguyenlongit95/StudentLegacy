<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\controllers\BranchController;
use App\http\controllers\LessionController;
use App\Course;

class CourseController extends Controller
{
    protected $branchController;
    protected $lessionController;

    public function __construct(BranchController $branchCon, LessionController $lessionCon) {
        $this->branchController = $branchCon;
        $this->lessionController = $lessionCon;
    }

    public function getAllCourse()
    {
        $courses = Course::orderBy('created_at', 'DEC')->get();
        return response()->json(["code"=>200, "data_array"=>$courses], 200);
    }

    // get course by tag - search course
    public function getCoursesByTag($hashTag) 
    {
        $branchId = $this->branchController->getIdBranchBy($hashTag);

        if ($branchId == -1) {
            return response()->json(["code"=>422, "message"=>"Not matched to branch"], 422);
        }

        $courses = Course::where('branch_id', $branchId)->get();

        return response()->json(["code"=>200, "message"=>"success", "data_array"=>$courses], 200);
    }

    //get Course by id
    public function getCourseById($idCourse) 
    {
        $course = Course::find($idCourse);

        return $course;
    }
    
    // get detail course with lession
    public function getDetailCourse($idCourse) 
    {
        $course = Course::find($idCourse);

        if (!$course) {
            return response()->json(["code"=>422, "message"=>"This course id does not exist", "data"=>null], 422);
        }

        $response = [];
        $response["id"] = $course->id;
        $response["name"] = $course->name;
        $response["avatar"] = $course->avatar;
        $response["description"] = $course->description;
        $response["purpose"] = $course->purpose;
        $response["fee"] = $course->fee;
        $response["reviews"] = json_decode($course->reviews);
        $response["rates"] = json_decode($course->rates);
        $response["time_limit"] = $course->time_limit;
        $response["lessions_id"] = json_decode($course->lessions_id);
        $response["branch_id"] = $course->branch_id;
        $response["created_at"] = $course->created_at->toDateTimeString();
        $response["total_student"] = $course->total_student;
        $response["student_register"] = json_decode($course->student_register);
        $lessionsId = json_decode($course->lessions_id);
        $lessions = [];

        foreach ($lessionsId as $item) {
            $lession = $this->lessionController->getLessionById($item);

            if ($lession) {
                array_push($lessions, $lession);
            }
        }


        $response["lessions"] = $lessions;
        return response()->json(["code"=>200, 
                            "message"=>"get detail course success", 
                            "data"=>$response], 200);
    }

    // get detail course with lession when get schedule
    public function getDetailCourseWithSchedule($idCourse) 
    {
        $course = Course::find($idCourse);

        if (!$course) {
            return null;
        }

        $response = [];
        $response["id"] = $course->id;
        $response["name"] = $course->name;
        $response["avatar"] = $course->avatar;
        $response["description"] = $course->description;
        $response["purpose"] = $course->purpose;
        $response["fee"] = $course->fee;
        $response["reviews"] = json_decode($course->reviews);
        $response["rates"] = json_decode($course->rates);
        $response["time_limit"] = $course->time_limit;
        $response["lessions_id"] = json_decode($course->lessions_id);
        $response["branch_id"] = $course->branch_id;
        $response["created_at"] = $course->created_at->toDateTimeString();
        $response["total_student"] = $course->total_student;
        $lessionsId = json_decode($course->lessions_id);
        $lessions = [];

        foreach ($lessionsId as $item) {
            $lession = $this->lessionController->getLessionById($item);

            if ($lession) {
                array_push($lessions, $lession);
            }
        }

        $response["lessions"] = $lessions;
        return $response;
    }

    // get number lession in course
    public function getNumberLessionCourse($courseId) 
    {
        $course = Course::find($courseId);

        if (!$course) {
            return -1;
        }

        return count(json_decode($course->lessions_id));
    }
}

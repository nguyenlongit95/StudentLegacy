<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\controllers\BranchController;
use App\http\controllers\CourseController;
use App\http\controllers\ResultLessionController;
use App\Schedule;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    protected $courseController;
    protected $resultLessionController;

    public function __construct(CourseController $courseCon, ResultLessionController $resultLessionCon) {
        $this->courseController = $courseCon;
        $this->resultLessionController = $resultLessionCon;
    }
    //store new schedule
    public function storeNewSchedule(Request $request) 
    {
        if (!$request->student_id || !$request->course_id) {
            return response()->json(["code"=>400, "message"=>"Invalid input", "data"=>null], 400);
        }

        $schedule = new Schedule();
        $schedule->student_id = $request->student_id;
        $schedule->course_id = $request->course_id;
        
        if (!$request->time_remind) {
            $schedule->time_remind = "[]";
        } else {
            $schedule->time_remind = $request->time_remind;
        }

        $schedule->completion = 0;
        $schedule->status = 1;

        $schedule->created_at = Carbon::now();
        $schedule->updated_at = Carbon::now();

        try {
            $schedule->save();
            return response()->json(["code"=>200, "message"=>"store new schedule success", "data"=>null], 200);
        } catch (\Execption $exception) {
            return response()->json(["code"=>500, "message"=>"serve error", "data"=>null], 500);
        }
    }

    //get schedule of student by IdStudent
    public function getScheduleByIdStudent($studentId) 
    {
        $schedules = Schedule::where('student_id', $studentId)->get();
        
        if (!$schedules) {
            return response()->json(["code"=>200, "message"=>"Now you have no schedule", "data"=>null], 200);
        }

        $response = [];

        foreach ($schedules as $item) {
            $schedule = [];
            $schedule["id"] = $item->id;
            $schedule["student_id"] = $item->student_id;
            $schedule["course_id"] = $item->course_id;
            $schedule["time_remind"] = json_decode($item->time_remind);
            $schedule["completion"] = $item->completion;
            $schedule["status"] = $item->status;
            $course = $this->courseController->getDetailCourseWithSchedule($item->course_id);

            if ($course) {
                $schedule["course"] = $course;
            } else {
                $schedule["course"] = null;
            }
            
            array_push($response, $schedule);
        }

        return response()->json(["code"=>200, "message"=>"get schedule success", "data_array"=>$response], 200);
    }

    /**
     * Display the schedule of student
     *
     * @param  int  idStudent, timeRequest
     * @return \Illuminate\Http\Response
     */
    public function getScheduleBy($idStudent, $time)
    {
        if (!$idStudent || !$time) {
            return response()->json(["message"=>"Please enter idStudent"], 400);
        }

        $schedule = Schedule::where('student_id', $idStudent)->first();

        if (!$schedule) {
            return response()->json(["message"=>"Schedule not found"], 422);
        }

        $lessonsId = json_decode($schedule->lessons);
        $result = [];

        foreach ($lessonsId as $item) {
            $lesson = $this->lessonController->getLessonBy($item, $time);
            
            if ($lesson) {
                $lesson["student_id"] = $idStudent;
                array_push($result, $lesson);
            }
        }
        
        return response()->json($result, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateSchedule(Request $request)
    {
        if (!$request->time_remind || !$request->schedule_id) {
            return response()->json(["code"=>422, "message"=>"invalid in put", "data"=>null], 400);
        }

        $schedule = Schedule::find($request->schedule_id);

        if (!$schedule) {
            return response()->json(["code"=>422, "message"=>"can not find schedule", "data"=>null], 422);
        }

        try {
            $schedule->time_remind = json_encode($request->time_remind);
            $schedule->save();
            return response()->json(["code"=>200, "mesage"=>"save success", "data"=>null], 200);
        } catch (\Excecption $exception) {
            return response()->json(["code"=>500, "message"=>"server error", "data"=>null], 500);
        }
    }

    //update completion of schedule 
    public function updateCompletionSchedule(Request $request)
    {
        if (!$request->schedule_id 
        || !$request->lession_id || !$request->completion || !$request->time_study) {
            return response()->json(["code"=>400, "message"=>"invalid input"], 400);
        }

        $schedule = Schedule::find($request->schedule_id);

        if (!$schedule) {
            return response()->json(["code"=>422, "message"=>"schedule not found"], 422);
        }

        $lessionComplete = $this->resultLessionController->getResultLession($request->schedule_id, $request->lession_id);
        $numberLession = $this->courseController->getNumberLessionCourse($schedule->course_id);

        if ( $lessionComplete < $request->completion && $numberLession > 0) {
            $value = $schedule->completion + ($request->completion - $lessionComplete) / $numberLession;
            $schedule->completion = $value;
        }
        

        try {
            $schedule->save();

            $lessionSaved = $this->resultLessionController->storeResultLession($schedule->id, $request);

            if ($lessionSaved == -1) {
                return response()->json(["code"=>500, "message"=>"can not save result of lession"], 500);
            }

            return response()->json(["code"=>200, "message"=>"update schedule completion success", "data"=>null], 200);

        } catch(\Exception $exception) {
            return response()->json(["code"=>500, "message"=>"systems error"], 500);
        }
    }

    //update status of schedule - 1: studying     2:finish
    public function updateStatusSchedule(Request $request) 
    {
        if ( !$request->schedule_id || !$request->status) {
            return response()-json(["code"=>400, "message"=>"invalid input"], 400);
        }
        
        $schedule = Schedule::find($request->schedule_id);

        if (!$schedule) {
            return response()->json(["code"=>422, "message"=>"schedule not found"], 422);
        }

        $schedule->status = $request->status;

        try {
            $schedule->save();
            return response()->json(["code"=>200, "message"=>"update status schedule success", "data"=> null], 200);
        } catch(\Exception $exception) {
            return response()->json(["code"=>500, "message"=>"system errors"], 500);
        }
    }
}

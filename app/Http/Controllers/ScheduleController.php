<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use App\http\controllers\LessonController;

class ScheduleController extends Controller
{
    protected $lessonController;

    public function __construct(LessonController $controller) 
    {
        $this->lessonController = $controller;
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
    public function update(Request $request, $id)
    {
        //
    }
}

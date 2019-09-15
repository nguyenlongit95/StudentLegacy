<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lesson;
use App\Subject;
use App\http\controllers\SubjectController;
use Carbon\Carbon;

class LessonController extends Controller
{  
    protected $subjectController;

    public function __construct(SubjectController $controller) 
    {
        $this->subjectController = $controller;
    }
    /**
     * Display lesson
     *
     * @param  int  $idLesson
     * @return \Illuminate\Http\Response
     */
    public function getLessonBy($idLesson, $time)
    {
        if (!$idLesson) {
            return response()->json(["message"=>"Please enter idLesson"], 400);
        }

        $lesson = Lesson::find($idLesson);

        if (!$lesson) {
            return response()->json(["message"=>" Lesson not found"], 422);
        }

        $subject = new Subject;
        $timeRequest = Carbon::parse($time);
        $weekDayRequest = $timeRequest->format('w');
        $weekDayLesson = $lesson->week_day;
        $timeRequest = $timeRequest->subDays($weekDayRequest - 6 + $weekDayLesson);
        $subject = $this->subjectController->getSubjectBy($lesson->subject_id, $timeRequest);

        if (!$subject) {
            return null;
        }

        $result = [];
        $result["lesson_id"] = $lesson->id;
        $result["subject_id"] = $subject->id;
        $result["subject_name"] = $subject->name;
        $result["address"] = $lesson->address;
        $result["room"] = $lesson->room;
        $result["week_day"] = $lesson->week_day;
        $result["date"] = $timeRequest;
        $result["time_start"] = $lesson->time_start;
        $result["time_end"] = $lesson->time_end;

        return $result;
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Log;
use App\http\controllers\StudentController;
use Carbon\Carbon;

class LogController extends Controller
{
    protected $studentController;

    public function __construct(StudentController $controller)
    {
        $this->studentController = $controller;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly Log
     *
     * @param  \Illuminate\Http\Request  $request
     * @return message
     */
    public function storeLog(Request $request)
    {
        if (!$request->idStudent || !$request->idStudentTag) {
            return response()->json(["message"=>"Please enter idStudent, and idStudentTag"], 400);
        }

        if (!$request->idBlog && !$request->idComment) {
            return response()->json(["message"=>"Please enter at least idBlog or idComment"], 400);
        }

        if ($this->studentController->checkStudentExist($request->idStudent) &&
            $this->studentController->checkStudentExist($request->idStudentTag)) {
            $log = new Log;
            $log->student_id = $request->idStudent;
            $log->student_tag_id = $request->idStudentTag;
            $log->status = "seen";
            $log->created_at = Carbon::now();
            $log->updated_at = Carbon::now();

            if (!$request->idBlog) {
                $log->blog_id = null;
            } else {
                $log->blog_id = $request->idBlog;
            }

            if (!$request->comment_id) {
                $log->comment_id = null;
            } else {
                $log->comment_id = $request->idComment;
            }

            try {
                $log->save();
                return response()->json($log, 200);
            } catch (\Exception $exception) {
                return response()->json(["message"=>"Systems Errors"], 500);
            }
        }
    }

    /**
     * Display all log for student
     *
     * @param  int  $idStudent
     * @return \Illuminate\Http\Response
     */
    public function getAllLog($idStudent)
    {
        if (!$idStudent) {
            return response()->json(["message"=>"Please enter idStudent"], 400);
        }

        if (!$this->studentController->checkStudentExist($idStudent)) {
            return response()->json(["message"=>"Student not found"], 422);
        }

        $logs = Log::where('student_tag_id', $idStudent)->get();

        $response = [];
        
        foreach ($logs as $item) {
            $temp = [];
            $student = $this->studentController->getBriefStudent($item->student_id);

            if ($student) {
                $temp = $student;
                $temp["blog_id"] = $item->blog_id;
                $temp["comment_id"] = $item->comment_id;
                $temp["time_created"] = $item->created_at->toDateTimeString();
                array_push($response, $temp);
            }
        }

        return response()->json($response, 200);
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

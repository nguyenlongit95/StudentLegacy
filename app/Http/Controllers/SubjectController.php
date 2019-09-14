<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquent\RepositoryInterface;
use Illuminate\Http\Request;
use App\Subject;
use App\http\controllers\AcademyController;
use Carbon\Carbon;

class SubjectController extends Controller
{
   protected $academyController;

   public function __construct(AcademyController $controller) 
   {
        $this->academyController = $controller;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        if (!$request->academy_id) {
            return response()->json(["message"=>"Id academy not found"], 400);
        }

        if (!$request->name) {
            return reponse()->json(["message"=>"Subject name not found"], 400);
        }

        if (!$request->time_start) {
            return reponse()->json(["message"=>"Subject time start not found"], 400);
        }

        if (!$request->time_end) {
            return reponse()->json(["message"=>"Subject time end not found"], 400);
        }

        if (!$request->max_student) {
            return response()->json(["message"=>"Subject max student not found"], 400);
        }

        if (!$request->fee) {
            return response()->json(["message"=>"Subject fee not found"], 400);
        }

        //create new object Subject to insert into database
        $subject = new Subject;
        $subject->name = $request->name;
        $subject->time_start = $request->time_start;
        $subject->time_end = $request->time_end;
        $subject->max_student = $request->max_student;
        $subject->fee = $request->fee;

        if (!$request->hotline) {
            $subject->hotline = null;
        } else {
            $subject->hotline = $request->hotline;
        }

        if (!$request->short_description) {
            $subject->short_description = null;
        } else {
            $subject->short_description = $request->short_description;
        }
        
        if (!$request->description) {
            $subject->description = null;
        } else {
            $subject->description = $request->description;
        }
        
        try {
            $subject->save();

            //save id subject into academy
            $this->academyController->storeSubjectToAcademy($subject->id, $request->academy_id);
            return response()->json($subject, 200);
        } catch (\Exception $exception) {
            return response()->json(["message"=>"DB Errors"], 500);
        } 
    }

    /**
     * get all subject
     *
     * @param  
     * @return list subject
     */
    public function getAllSubject()
    {
        $subjects = Subject::get();
        $response = [];

        $subjects = array_sort($subjects, function ($value) {
            return new Carbon($value['time']);
        });

        foreach ($subjects as $item) {
            $temp = [];
            $temp["id"] = $item->id;

            //get academy
            $academy = $this->academyController->getBriefAcademyByIdSubject($item->id);
            
            $temp["academy"] = $academy;
            $temp["subject_name"] = $item->name;
            $temp["time_start"] = $item->time_start;
            $temp["time_end"] = $item->time_end;
            $temp["max_student"] = $item->max_student;
            $temp["fee"] = $item->fee;
            $temp["hotline"] = $item->hotline;
            $temp["short_description"] = $item->short_description;
            $temp["description"] = $item->description;
            $temp["time_created"] = $item->created_at->toDateTimeString();
            array_push($response, $temp);
        }

        return response()->json($response, 200);
    }
}

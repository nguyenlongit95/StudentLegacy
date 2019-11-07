<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\controllers\StudentController;
use App\http\controllers\CourseController;
use App\http\controllers\LessionController;
use App\ResultStatistic;
use Carbon\Carbon;

class ResultStatisticController extends Controller
{
    protected $studentController;
    protected $courseController;
    protected $lessionController;
    public function __construct(StudentController $studentCon, CourseController $courseCon, LessionController $lessionCon)
    {
        $this->studentController = $studentCon;
        $this->courseController = $courseCon;
        $this->lessionController = $lessionCon;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    /**
     * get statistic result of student
     *
     * @param  int  $idStudent
     * @return \Illuminate\Http\Response
     */
    public function getResult($idStudent)
    {
        $results = ResultStatistic::where('student_id', $idStudent)->get();

        if (!$results) {
            return response()->json(["code"=>400, "message"=>"results of student not found"], 400);
        }

        $response = [];

        foreach ($results as $item) {
            $temp = [];
            $temp["id"] = $item->id;
            $temp["date"] = Carbon::parse($item->date)->toDateString();
            $temp["student_id"] = $item->student_id;
            $temp["course"] = $this->courseController->getDetailCourseWithSchedule($item->course_id);
            $temp["lession"] = $this->lessionController->getLessionById($item->lession_id);
            
            if (!$item->completion_percent) {
                $temp["completion_percent"] = 0;
            } else {
                $temp["completion_percent"] = (double)$item->completion_percent;
            }
            array_push($response, $temp);
        }

        return response()->json(["code"=>200, "message"=>"get results success", "data_array"=>$response], 200);
    }
}

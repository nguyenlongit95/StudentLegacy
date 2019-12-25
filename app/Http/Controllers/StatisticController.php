<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Statistic;
use App\http\controllers\BranchController;

class StatisticController extends Controller
{
    protected $branchController;

    public function __construct(BranchController $branchCon) {
        $this->branchController = $branchCon;
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

     
    public function storeStatistic($idStudent, $idBranch) 
    {
        $statistic = new Statistic;
        $statistic->student_id = $idStudent;
        $statistic->branch_id = $idBranch;
        $statistic->number_question_post = 0;
        $statistic->number_question_seen = 0;
        $statistic->number_question_like = 0;
        $statistic->number_question_rate = 0;

        $statistic->number_blog_post = 0;
        $statistic->number_blog_seen = 0;
        $statistic->number_blog_like = 0;
        $statistic->number_blog_rate = 0;

        $statistic->number_review_post = 0;
        $statistic->number_review_seen = 0;
        $statistic->number_review_like = 0;
        $statistic->number_review_rate = 0;

        $statistic->number_search = 0;
        $statistic->number_time_study = 0;

        try {
            $statistic->save();
            return $statistic;
        } catch (\Exception $exception) {
            return null;
        }
    }

    /**
     * Store a new Statistic
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */ 
    public function updateStatistic(Statistic $statistic) 
    {
        $staNew = Statistic::find($statistic->id);
        $staNew = $statistic;

        try {
            $staNew->save();
            return response()->json(["message"=>"Save success"], 200);
        } catch (\Exception $exception) {
            return response()->json(["message"=>"DB Errors"], 500);
        }
    }

    /**
     * get statistic by idStudent, idRegion
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getStatistic($idStudent, $idRegion)
    {
        $statistic = Statistic::where('student_id', $idStudent)->where('region_id', $idRegion)->first();
        
        if (!$statistic) {
            return null;
        }

        return $statistic;
    }

    /**
     * save into statistic
     *
     * @param  id_student
     * @return \Illuminate\Http\Response
     */
    public function saveIntoStatistic($dataChange, $idStudent, $idBranch) 
    {
        $statistic = Statistic::where('student_id', $idStudent)->where('branch_id', $idBranch)->first();

        if (!$statistic) {
            $statistic = $this->storeStatistic($idStudent, $idBranch);
            // return $statistic;
        }

        // return $statistic;
        // return response()->json($type, 500);
        switch ($dataChange) {
            case "question_seen":
                $statistic->number_question_seen = $statistic->number_question_seen + 1; 
                break;
            case "question_post":
                $statistic->number_question_post = $statistic->number_question_post + 1; 
                break;
            case "question_like":
                $statistic->number_question_like = $statistic->number_question_like + 1; 
                break;
            case "question_rate":
                $statistic->number_question_rate = $statistic->number_question_rate + 1;
                break; 
            case "blog_post":
                $statistic->number_blog_post = $statistic->number_blog_post + 1; 
                break;
            case "blog_seen":
                $statistic->number_blog_seen = $statistic->number_blog_seen + 1;
                break;
            case "blog_like":
                $statistic->number_blog_like = $statistic->number_blog_like + 1;
                break;
            case "blog_rate":
                $statistic->number_blog_rate = $statistic->number_blog_rate + 1;
                break;
            case "review_post":
                $statistic->number_review_post = $statistic->number_review_post + 1;
                break;
            case "review_seen":
                $statistic->number_review_seen = $statistic->number_review_seen + 1;
                break;
            case "review_like":
                $statistic->number_review_like = $statistic->number_review_like + 1;
                break;
            case "review_rate":
                $statistic->number_review_rate = $statistic->number_review_rate + 1;
                break;
            case "search":
                $statistic->number_search = $statistic->number_search + 1;
                break;
            case "time_study":
                $statistic->number_review_seen = $statistic->number_time_study + 1;
                break;
        }


        try {
            $statistic->save();
            return response()->json(["message"=>"Save success"], 200);
        } catch (\Exception $exception) {
            return response()->json(["message"=>"DB Errors"], 500);
        } 
    }

    public function getEvaluateOfStudent($idStudent)
    {
        $statistics = Statistic::where('student_id', $idStudent)->get();

        $response = [];
        foreach ($statistics as $item) {
            $result = [];
            $result["branch_id"] = $item->branch_id;
            $branch = $this->branchController->getBranch($item->branch_id);
            $result["branch"] = $branch;
            $result["ratio"] = (int)$item->number_question_post * 2.1
                                + (int)$item->number_question_seen * 1.2
                                + (int)$item->number_question_like * 1.1
                                + (int)$item->number_question_rate * 1.4
                                + (int)$item->number_blog_post * 2.2
                                + (int)$item->number_blog_seen * 1.3
                                + (int)$item->number_blog_like * 1.1
                                + (int)$item->number_blog_rate * 1.3
                                + (int)$item->number_review_post * 2
                                + (int)$item->number_review_seen * 1.2
                                + (int)$item->number_review_like * 1
                                + (int)$item->number_review_rate * 1.4
                                + (int)$item->number_search * 1.3
                                + (int)$item->number_time_study * 2;
            
            array_push($response, $result);
        }
        return response()->json([ "code"=> 200, "data_array"=> $response], 200);
    }
}

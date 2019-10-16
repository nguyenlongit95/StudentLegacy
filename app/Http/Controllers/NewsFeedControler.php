<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\controllers\QuestionController;
use App\http\controllers\BlogController;
use App\http\controllers\StudentController;
use Carbon\Carbon;

class NewsFeedControler extends Controller
{
    protected $questionController;
    protected $blogController;
    protected $studentController;

    public function __construct(QuestionController $questionController, 
                                BlogController $blogController,
                                StudentController $studentController)
    {
        $this->questionController = $questionController;
        $this->blogController = $blogController;
        $this->studentController = $studentController;
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
     * Store a newly like resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeNewLike(Request $request) {
        if (!$request->type || !$request->student_id || !$request->post_id || !$request->like) {
            return response()->json(["code"=>400], 400);
        }

        if ($request->type == "question") {
            $result = $this->questionController->storeLikedQuestion($request->post_id, $request->student_id, $request->like);
            if ($result) {
                return response()->json(["code"=>200], 200);
            }

            return response()->json(["code"=>500], 500);
        }
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
     * get all newsfeed for student (question, blog, review)
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getAllNewsFeed($idStudent) {
        if (!$this->studentController->checkStudentExist($idStudent)) {
            return response()->json(["message"=>422], 422);
        }

        // depend on statistic to get newsfeed
    }
}

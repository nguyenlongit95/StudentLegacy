<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\controllers\QuestionController;
use App\http\controllers\BlogController;
use App\http\controllers\StudentController;
use App\http\controllers\CommentController;
use App\http\controllers\BranchController;
use Carbon\Carbon;

class NewsFeedControler extends Controller
{
    protected $questionController;
    protected $blogController;
    protected $studentController;
    protected $commentController;

    public function __construct(QuestionController $questionController, 
                                BlogController $blogController,
                                StudentController $studentController,
                                CommentController $commentController)
    {
        $this->questionController = $questionController;
        $this->blogController = $blogController;
        $this->studentController = $studentController;
        $this->commentController = $commentController;
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
    public function storeNewPost(Request $request)
    {
        if (!$request->type) {
            return response()->json(["code"=>400, "message"=>"lack of input"], 400);
        }

        $saveResult = 500;

        if ($request->type == "question") {
            $saveResult  = $this->questionController->store($request);
        }

        if ($saveResult != 200) {
            return response()->json(["code"=>$saveResult, "message"=>"Can not save"], $saveResult);
        }

        return response()->json(["code"=>200, "message"=>"Save new post successful"], 200);
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
     * Store a newly  comment
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeNewComment(Request $request) {
        if (!$request->owner_id || !$request->content 
            || !$request->post_id || !$request->type) {
            return response()->json(["code"=>400], 400);
        }

        $storeInComment = $this->commentController->storeComment($request);

        if ($storeInComment == -1) {
            return response()->json(["code"=>500, "mesage"=>"can not save comment"], 500);
        }

        
        if ($request->type == "question") {
            $result = $this->questionController->storeComment($request->post_id, $storeInComment);
            if ($result) {
                return response()->json(["code"=>200, "message"=>"OK save"], 200);
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

    //get new feed by hashtag
    public function getNewsFeedByHashtag($idStudent, $hashtag) {
        $questions = $this->questionController->getQuestionByhashtag($idStudent, $hashtag);

        return response()->json(["code"=>200, "message"=>"search newfeed success", "data_array"=>$questions], 200);
    }
}

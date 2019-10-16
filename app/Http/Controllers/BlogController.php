<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\Student;
use Carbon\Carbon;

class BlogController extends Controller
{
    protected $studentController;
    protected $commentController;
    public function __construct(StudentController $studentController, CommentController $commentController) {
      $this->studentController = $studentController;
      $this->commentController = $commentController;
    }

    /**
     * Store a newly created blog in DB
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->owner_id || !$request->hash_tag || !$request->content) {
            return response()->json(["message"=>"Please enter all input"], 400);
        }

        // create new blog to insert into DB
        $blog = new Blog;
        $blog->owner_id = $request->owner_id;
        $blog->hash_tag = $request->hash_tag;
        $blog->status = "In Review";
        $blog->content = $request->content;
    
        if (!$request->images_enclose) {
            $blog->images_enclose = "[]";
        } else {
            $blog->images_enclose = $request->images_enclose;
        }
        
        if (!$request->files_enclose) {
            $blog->files_enclose = "[]";
        } else {
            $blog->files_enclose = $request->files_enclose;
        }
        
        $blog->liked = "[]";
        $blog->rates = "[]";
        $blog->comments = "[]";       
        $blog->created_at = Carbon::now();
        $blog->updated_at = Carbon::now();
        
        try {
            $blog->save();
            return response()->json($blog, 200);
        } catch (\Exception $exception) {
            return response()->json(["message"=>"DB Errors"], 500);
        }
    }

    /**
     * Store a new like blog
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */    
    public function storeLikedBlog(Request $request) 
    {
        if (!$request->idBlog || !$request->idStudent || !$request->like) {
            return response()->json(["message"=>"Please enter input"], 400);
        }

        $blog = Blog::find($request->idBlog);

        if (!$blog) {
            return response()->json(["message"=>"Blog not found"], 422);
        }

        $student = Student::find($request->idStudent);

        if (!$student) {
            return response()->json(["message"=>"Student not found"], 422);
        }

        $listLiked = json_decode($blog->liked, true);
        $isLiked = in_array($request->idStudent, $listLiked);

        if ($request->like == 1 && !$isLiked) {
            array_push($listLiked, $student->id);
        }

        if ($request->like == -1 && $isLiked) {
            $idStudent = $student->id;
            $listLiked = array_filter($listLiked, function ($value) use ($idStudent) {
                return $value != $idStudent;
            });

        }

        $blog->liked = json_encode($listLiked);

        try {
            $blog->save();
            $blog->liked = json_decode($blog->liked);
            return response()->json($blog, 200);
        } catch(\Exception $exception) {
            return response()->json(["message"=>"Systems Errors"], 500);
        }
    }

     /**
     * Store a new star blog
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */    
    public function storeRateBlog(Request $request) 
    {
        if (!$request->idBlog || !$request->idStudent || !$request->numberStar) {
            return response()->json(["message"=>"Please enter input"], 400);
        }

        $blog = Blog::find($request->idBlog);

        if (!$blog) {
            return response()->json(["message"=>"Blog not found"], 422);
        }

        $student = Student::find($request->idStudent);

        if (!$student) {
            return response()->json(["message"=>"Student not found"], 422);
        }

        $rates = json_decode($blog->stars, true);
        $newRates = [];
        foreach ($rates as $item) {
            if ($item["student_id"] != $student->id) {
                array_push($newRates, $item);
            }
        }

        $newRate = [];
        $newRate["student_id"] = $student->id;
        $newRate["number_stars"] = (int)$request->numberStar;
        array_push($newRates, $newRate);
        
        $blog->stars = json_encode($newRates);

        try {
            $blog->save();
            $blog->liked = json_decode($blog->liked);
            return response()->json($blog, 200);
        } catch(\Exception $exception) {
            return response()->json(["message"=>"Systems Errors"], 500);
        }
    }

     /**
     * Store a new comment blog
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */ 
    public function storeCommentBlog($idBlog, $idComment)
    {
        $blog = Blog::find($idBlog);

        if (!$blog) {
            return response()->json(["message"=>"Blog not found"], 422);
        }

        $comments= json_decode($blog->comments);
        $isComment = in_array($idComment, $comments);

        if (!$isComment) {
            array_push($comments, $idComment);
        }

        $blog->comments = json_encode($comments);

        try {
            $blog->save();
            return response()->json($blog, 200);
        } catch(\Exception $exception) {
            return response()->json(["message"=>"Systems Errors"], 500);
        }
    }

    /**
     * get all blog from DB
     *
     * @param  id_student
     * @return \Illuminate\Http\Response
     */
    public function getAllBlog($idStudent) 
    {
        $blogs = Blog::get();

        $response = [];

        foreach ($blogs as $item) {
            $temp = [];
            $temp["id"] = $item->id;
            $temp["owner_id"] = $item->owner_id;

            //get info of owner blog
            $student = Student::find($item->owner_id);

            if ($student) {
                $studentResponse = [];
                $studentResponse["username"] = $student->name;
                $studentResponse["avatar"] = $student->avatar;
                $temp["student"] = $studentResponse;
                $temp["time_created"] = $item->created_at->toDateTimeString();
                $temp["content"] = $item->content;
                $temp["images"] = json_decode($item->images_enclose);
                $temp["files"] = json_decode($item->files_enclose);
                $temp["liked"] = count(json_decode($item->liked));
                $stars = json_decode($item->stars);
                $numberStar = 0;

                foreach ($stars as $item) {
                    $numberStar += $item["number_stars"];
                }
                $temp["rates"] = $numberStar;
                $temp["comments"] = count(json_decode($item->comments));
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

    /**
     * get detail blog
     *
     * @param  int  idStudent, idBlog
     * @return \Illuminate\Http\Response
     */
    public function getDetailBlog($idStudent, $idBlog)
    {
        if (!$idStudent || !$idBlog) {
            return response()->json(["message"=>"Please enter all input"], 400);
        }

        $student = Student::find($idStudent);

        if (!$student) {
            return response()->json(["message"=>"Student not found"],422);
        }

        $blog = Blog::find($idBlog);

        if (!$blog) {
            return response()->json(["message"=>"blog not found"], 422);
        }

        $response = [];
        $response["id"] = $blog->id;
        $response["owner_id"] = $blog->owner_id;

        $studentOwner = Student::find($blog->owner_id);

        if (!$studentOwner) {
            return response()->json(["message"=>"Student owner not found"], 422);
        }

        $studentResponse = [];
        $studentResponse["username"] = $student->name;
        $studentResponse["avatar"] = $student->avatar;
        $response["student"] = $studentResponse;

        $response["time_created"] = $blog->created_at;
        $response["time_updated"] = $blog->updated_at;
        $response["content"] = $blog->content;
        $response["images"] = json_decode($blog->images_enclose);
        $response["files"] = json_decode($blog->files_enclose);

        //get list liked
        $likedResponse = [];
        $liked = json_decode($blog->liked);

        foreach ($liked as $item) {
            $studentLiked = Student::find($item);
            if ($studentLiked) {
                $temp = [];
                $temp["id"] = $studentTag->id;
                $temp["name"] = $studentTag->name;
                array_push($likedResponse, $temp);
            }
        }

        $response["liked"] = $likedResponse;

        $response["rates"] = json_decode($blog->rates);

        //get list comments
        $commentsResponse = [];
        $comments = json_decode($blog->comments);

        foreach ($comments as $item) {
            $comment = $this->commentController->getComment($item);

            if ($comment) {
                array_push($commentsResponse, $comment);
            }
        }

        $response["comments"] = $commentsResponse;
        return response()->json($response, 200);
    }
}

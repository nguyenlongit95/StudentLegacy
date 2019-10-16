<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Support\Jsonable;
use App\Question;
use Carbon\Carbon;
use App\Student;
use App\Comment;
use App\http\controllers\StudentController;
use App\http\controllers\CommentController;
use App\http\controllers\StatisticController;

class QuestionController extends Controller
{
    protected $studentController;
    protected $commentController;
    protected $statisticController;

    public function __construct(StudentController $studentController, CommentController $commentController, 
        StatisticController $statisticController) {
        $this->studentController = $studentController;
        $this->commentController = $commentController;
        $this->statisticController = $statisticController;
    }

    /**
     * Store a newly created question in DB
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->owner_id || !$request->hash_tag || !$request->content) {
            return response()->json(["message"=> "Please enter all input"], 400);
        }

        $student = Student::find($request->owner_id);

        if (!$student) {
            return response()->json(["message"=>"Student not found"], 422);
        }
        // create new blog to insert into DB
        $question = new Question;
        $question->owner_id = $request->owner_id;
        $question->hash_tag = $request->hash_tag;
        $question->status = "public";

        if (!$request->friends_tag) {
            $question->friends_tag = "[]";
        } else {
            $question->friends_tag = $request->friends_tag;
        }
        
        $question->content = $request->content;

        if (!$request->images_enclose) {
            return "no image";
            $question->images_enclose = "[]";
        } else {
            $images = $request->images_enclose;
            // $name = $file->getClientOriginalName();
            // $path = "localhost/StudentLegacy/public/upload/Question/$name";
            // $newFile = $file->move('upload/Blogs', $file->getClientOriginalName());
            // return "hihi";
            $imagesPath = [];
            foreach ($images as $file) {
                $name = $file->getClientOriginalName();
                $path = "http://localhost/StudentLegacy/public/upload/Questions/$name";
                $newFile = $file->move('upload/Questions', $file->getClientOriginalName());
                array_push($imagesPath, $path);
            }
            
            $question->images_enclose = json_encode($imagesPath);
            // return "hihi";
            // return json_encode($imagesPath);
        }
        
        if (!$request->files_enclose) {
            $question->files_enclose = "[]";
        } else {
            $file = $request->files_enclose;
            $name = $file->getClientOriginalName();
            $path = "localhost/StudentLegacy/public/upload/Blogs/$name";
            $newFile = $file->move('upload/Blogs', $file->getClientOriginalName());
            
            return $path;
            $question->files_enclose = $request->files_enclose;
        }
        
        if (!$request->liked) {
            $question->liked = "[]";
        } else {
            $question->liked = $request->liked;
        }

        if (!$request->comments) {
            $question->comments = "[]";
        } else {
            $question->comments = $request->comments;
        }        
        
        $question->created_at = Carbon::now();
        $question->updated_at = Carbon::now();

        try {
            $question->save();
            //save into statistic
            $this->statisticController->saveIntoStatistic("question_post", $request->owner_id, 1);
            return response()->json(["code"=>200,
                                     "data"=>null], 200);
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
    public function storeLikedQuestion($idQuestion, $idStudent, $like) 
    {
        $question = Question::find($idQuestion);

        if (!$question) {
            return false;
        }

        $student = Student::find($idStudent);

        if (!$student) {
            return false;
        }

        $listLiked = json_decode($question->liked);
        $isLiked = in_array($idStudent, $listLiked);

        if ($like == 1 && !$isLiked) {
            array_push($listLiked, (int)$idStudent);
        }

        if ($like == -1 && $isLiked) {
            $listLiked = array_filter($listLiked, function ($value) use ($idStudent) {
                return $value != $idStudent;
            });
        }

        $question->liked = json_encode($listLiked);
        try {
            $question->save();
            //save to statistic
            return true;
        } catch(\Exception $exception) {
            return false;
        }
    }

    
    /**
     * get all blog from DB
     *
     * @param  id_student
     * @return \Illuminate\Http\Response
     */
    public function getAllQuestion($idStudent) 
    {
        $questions = Question::paginate(10);

        $response = [];

        foreach ($questions as $item) {
            $temp = [];
            $temp["id"] = $item->id;
            $temp["owner_id"] = $item->owner_id;

            //get info of owner blog
            $student = Student::find($item->owner_id);

            if ($student) {
                $studentResponse = [];
                $studentResponse["id"] = $student->id;
                $studentResponse["name"] = $student->name;
                $studentResponse["avatar"] = $student->avatar;
                $temp["student"] = $studentResponse;
                $friendsTagReponse = [];
                $friendsTag = json_decode($item->friends_tag);
                
                foreach ($friendsTag as $value) {
                    $studentTag = Student::find($value);
                    if ($studentTag) {
                        $tempTag = [];
                        $tempTag["id"] = $studentTag->id;
                        $tempTag["name"] = $studentTag->name;
                        array_push($friendsTagReponse, $tempTag);
                    }
                }
        
                $temp["friends_tag"] = $friendsTagReponse;
                $temp["created_at"] = $item->created_at->toDateTimeString();
                $temp["updated_at"] = $item->updated_at->toDateTimeString();
                $temp["content"] = $item->content;
                $temp["images_enclose"] = json_decode($item->images_enclose);
                $temp["files_enclose"] = json_decode($item->files_enclose);
                $temp["number_liked"] = count(json_decode($item->liked));
                $temp["number_comments"] = count(json_decode($item->comments));
                $listLiked = json_decode($item->liked);
                $isLiked = in_array($idStudent, $listLiked);
                $temp["is_liked"] = $isLiked;
                array_push($response, $temp);
            }
        }

        // $collection = $response;
        // $res = $this->paginate($collection, $perPage = 5, $page = null, $options = []);
        return response()->json(["code"=>200,"data_array"=>$response], 200);
    }

    /**
     * get detail blog
     *
     * @param  int  idStudent, idBlog
     * @return \Illuminate\Http\Response
     */
    public function getDetailQuestion($idStudent, $idQuestion)
    {
        if (!$idStudent || !$idQuestion) {
            return response()->json(["message"=>"Please enter all input"], 400);
        }

        $student = Student::find($idStudent);

        if (!$student) {
            return response()->json(["message"=>"Student not found"],422);
        }

        $question = Question::find($idQuestion);

        if (!$question) {
            return response()->json(["message"=>"blog not found"], 422);
        }

        $response = [];
        $response["id"] = $question->id;
        $response["owner_id"] = $question->owner_id;

        $studentOwner = Student::find($question->owner_id);

        if (!$studentOwner) {
            return response()->json(["message"=>"Student owner not found"], 422);
        }

        $studentResponse = [];
        $studentResponse["id"] = $studentOwner->id;
        $studentResponse["name"] = $studentOwner->name;
        $studentResponse["avatar"] = $studentOwner->avatar;
        $response["student"] = $studentResponse;

        //get name of friends tag
        $friendsTagReponse = [];
        $friendsTag = json_decode($question->friends_tag);

        foreach ($friendsTag as $item) {
            $studentTag = Student::find($item);
            if ($studentTag) {
                $temp = [];
                $temp["id"] = $studentTag->id;
                $temp["name"] = $studentTag->name;
                array_push($friendsTagReponse, $temp);
            }
        }

        $response["friends_tag"] = $friendsTagReponse;
        $response["created_at"] = $question->created_at->toDateTimeString();
        $response["updated_at"] = $question->updated_at->toDateTimeString();
        $response["content"] = $question->content;
        $response["images_enclose"] = json_decode($question->images_enclose);
        $response["files_enclose"] = json_decode($question->files_enclose);

        //get list liked
        $likedResponse = [];
        $liked = json_decode($question->liked);

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

        //get list comments
        $commentsResponse = [];
        $comments = json_decode($question->comments);

        foreach ($comments as $item) {
            $comment = $this->commentController->getComment($item);

            if ($comment) {
                array_push($commentsResponse, $comment);
            }
        }

        $response["comments"] = $commentsResponse;

        // save to statistic 
        return response()->json(["code"=>200,"data"=>$response], 200);
    }

    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}

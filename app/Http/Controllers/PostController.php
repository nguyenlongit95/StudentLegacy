<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\controllers\StudentController;
use App\http\controllers\CommentController;
use App\http\controllers\StatisticController;
use App\http\controllers\BranchController;
use App\Post;
use App\Student;
use Carbon\Carbon;

class PostController extends Controller
{
    protected $studentController;
    protected $commentController;
    protected $statisticController;
    protected $branchController;

    public function __construct(StudentController $studentController, CommentController $commentController, 
        StatisticController $statisticController, BranchController $branchCon) {
        $this->studentController = $studentController;
        $this->commentController = $commentController;
        $this->statisticController = $statisticController;
        $this->branchController = $branchCon;
    }

    //store new post
    public function storePost(Request $request)
    {
        if (!$request->type || !$request->owner_id || !$request->hash_tag || !$request->content) {
            return response()->json(["code"=>400, "message"=>"invalid input","data"=>null], 400);
        }

        $student = Student::find($request->owner_id);

        if (!$student) {
            return response()->json(["code"=>422, "message"=>"student not found", "data"=>null], 422);
        }
        // create new blog to insert into DB
        $post = new Post;
        $post->type = $request->type;
        $post->owner_id = $request->owner_id;
        $post->hash_tag = $request->hash_tag;

        if ($post->type == 1) {
            $post->status = 3;
        } else {
            $post->status = 1;
        }

        if (!$request->friends_tag) {
            $post->friends_tag = "[]";
        } else {
            $post->friends_tag = json_decode($request->friends_tag);
        }

        if (!$request->title) {
            $post->title = null;
        } else {
            $post->title = $request->title;
        }
        
        $post->content = $request->content;

        if (!$request->images_enclose) {
            $post->images_enclose = "[]";
        } else {
            $images = $request->images_enclose;
            $imagesPath = [];
            foreach ($images as $file) {
                $name = $file->getClientOriginalName();
                $path = "http://localhost/StudentLegacy/public/upload/Post/$name";
                $newFile = $file->move('upload/Post', $file->getClientOriginalName());
                array_push($imagesPath, $path);
            }
            
            $post->images_enclose = json_encode($imagesPath);
            // return "hihi";
            // return json_encode($imagesPath);
        }
        
        if (!$request->files_enclose) {
            $post->files_enclose = "[]";
        } else {
            $file = $request->files_enclose;
            $name = $file->getClientOriginalName();
            $path = "localhost/StudentLegacy/public/upload/Post/$name";
            $newFile = $file->move('upload/Post', $file->getClientOriginalName());
            
            $post->files_enclose = $request->files_enclose;
        }

        if (!$request->links) {
            $post->links = "[]";
        } else {
            $post->links = json_decode($request->links);
        }
        
        $post->likes = "[]";
        $post->rates = "[]";
        $post->comments = "[]";      
        $post->created_at = Carbon::now();
        $post->updated_at = Carbon::now();

        // return response()->json(["data"=>$post,"code"=>200], 200);
        try {
            $post->save();
            //save to statistic
            $dataStatistic = $this->getDataChange($post->type, "post");
            $branch = $this->branchController->getIdBranchBy($post->hash_tag);
            if ($branch != - 1) {
                $this->statisticController->saveIntoStatistic($dataStatistic, $post->owner_id, $branch);
            }
            return response()->json(["code"=>200, "message"=>"post a new post success", "data"=>null], 200);
        } catch (\Exception $exception) {
            return response()->json(["message"=>"DB Errors"], 500);
        }
    }

    //store like of post
    public function storeLikedPost(Request $request) 
    {
        if (!$request->type || !$request->student_id || !$request->post_id || !$request->like) {
            return response()->json(["code"=>400, "message"=>"Invalid input", "data"=>null], 400);
        }

        $post = Post::find($request->post_id);

        if (!$post) {
            return response()->json(["code"=>422, "message"=>"Post not found", "data"=>null], 422);
        }

        $student = Student::find($request->student_id);

        if (!$student) {
            return response()->json(["code"=>422, "message"=>"Student not found", "data"=>null], 422);
        }

        $listLiked = json_decode($post->likes);
        $isLiked = in_array($student->id, $listLiked);

        if ($request->like == 1 && !$isLiked) {
            array_push($listLiked, (int)$student->id);
        }

        if ($request->like == -1 && $isLiked) {
            $idStudent = (int)$request->student_id;
            $temp = [];
            foreach ($listLiked as $id) {
                if ($id != $idStudent) {
                    array_push($temp, $id);
                }
            }
            $listLiked = $temp;
        }

        $post->likes = json_encode($listLiked);
        try {
            $post->save();

            //save to statistic
            $dataStatistic = $this->getDataChange($post->type, "like");
            $branch = $this->branchController->getIdBranchBy($post->hash_tag);
            if ($branch != - 1) {
                $this->statisticController->saveIntoStatistic($dataStatistic, $post->owner_id, $branch);
            }
            return response()->json(["code"=>200, "message"=>"store like post success", "data"=>null], 200);
        } catch(\Exception $exception) {
            return response()->json(["code"=>500, "message"=>"Server error", "data"=>null], 500);
        }
    }

    // store comment
    public function storeComment(Request $request) 
    {

        if (!$request->type || !$request->owner_id || !$request->post_id || !$request->content) {
            return response()->json(["code"=>400, "message"=>"invalid input", "data"=>null], 400);
        }

        $post = Post::find($request->post_id);

        if (!$post) {
            return response()->json(["code"=>422, "message"=>"post not found", "data"=>null], 422);
        }

        $idComment = $this->commentController->storeComment($request);

        if ($idComment == -1) {
            return response()->json(["code"=>422, "message"=>"can not save comment", "data"=>null], 422);
        }

        $comments = json_decode($post->comments);
        array_push($comments, $idComment);
        $post->comments = json_encode($comments);
        try {
            $post->save();

            //save to statistic
            // $dataStatistic = $this->getDataChange($post->type, "comment");
            // $branch = $this->branchController->getIdBranchBy($post->hash_tag);
            // if ($branch != - 1) {
            //     $this->statisticController->saveIntoStatistic($dataStatistic, $post->owner_id, $branch);
            // }
            return response()->json(["code"=>200, "message"=>"postnew comment success", "data"=>null], 200);
        } catch(\Exception $exception) {
            return response()-json(["code"=>500, "message"=>"server error", "data"=>null], 500);
        }
    }

    //store rate
    public function storeRate(Request $request) 
    {
        if (!$request->post_id || !$request->student_id || !$request->number_star) {
            return response()->json(["code"=>400, "message"=>"invalid input", "data"=>null], 400);
        }

        $post = Post::find($request->post_id);

        if (!$post) {
            return response()->json(["code"=>422, "message"=>"post not found", "data"=>null], 422);
        }

        $rates = json_decode($post->rates);
        $newRates = [];
        $isRated = false;

        foreach ($rates as $rate) {
            // return response()->json(["rate id"=>$rate->student_id]);
            if ($rate->student_id != $request->student_id) {
                array_push($newRates, $rate);
            } else {
                $newRate = [];
                $newRate["student_id"] = (int)$request->student_id;
                $newRate["number_star"] = (int)$request->number_star;
                array_push($newRates, $newRate);
                $isRated = true;
            }
        }

        if (!$isRated) {
            $newRate = [];
            $newRate["student_id"] = (int)$request->student_id;
            $newRate["number_star"] = (int)$request->number_star;
            array_push($newRates, $newRate);
        }

        $post->rates = json_encode($newRates);
        // return response()->json($post);
        try {
            $post->save();

            //save to statistic
            $dataStatistic = $this->getDataChange($post->type, "rate");
            $branch = $this->branchController->getIdBranchBy($post->hash_tag);
            if ($branch != - 1) {
                $this->statisticController->saveIntoStatistic($dataStatistic, $request->student_id, $branch);
            }

            return response()->json(["code"=>200, "message"=>"store new rate success", "data"=>$post->rates], 200);
        } catch (\Exception $exception) {
            return response()->json(["code"=>500, "message"=>"systems error", "error"=>$exception], 500);
        }
    }

    /**
     * get all post from DB
     *
     * @param  id_student
     * @return \Illuminate\Http\Response
     */
    public function getAllPost($idStudent) 
    {
        $posts = Post::orderBy('created_at', 'DEC')->where('status', 3)->paginate(10);

        $response = [];

        foreach ($posts as $item) {
            $temp = [];
            $temp["id"] = $item->id;
            $temp["type"] = $item->type;
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
                $temp["title"] = $item->title;
                $temp["content"] = $item->content;
                $temp["images_enclose"] = json_decode($item->images_enclose);
                $temp["files_enclose"] = json_decode($item->files_enclose);

                $temp["rates"] = $this->getRateForPost(json_decode($item->rates));

                $temp["number_liked"] = count(json_decode($item->likes));
                $temp["number_comments"] = count(json_decode($item->comments));
                $listLiked = json_decode($item->likes);
                $isLiked = in_array($idStudent, $listLiked);
                $temp["is_liked"] = $isLiked;
                array_push($response, $temp);
            }
        }

        // $collection = $response;
        // $res = $this->paginate($collection, $perPage = 5, $page = null, $options = []);
        return response()->json(["code"=>200,"data_array"=>$response], 200);
    }

    //get all post which was post by student
    public function getPostOfStudent($idOwner, $idStudent) 
    {
        $posts = Post::where('status', 3)->where('owner_id', $idOwner)->paginate(15);

        $response = [];

        foreach ($posts as $item) {
            $temp = [];
            $temp["id"] = $item->id;
            $temp["type"] = $item->type;
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
                $temp["title"] = $item->title;
                $temp["content"] = $item->content;
                $temp["images_enclose"] = json_decode($item->images_enclose);
                $temp["files_enclose"] = json_decode($item->files_enclose);

                $temp["rates"] = $this->getRateForPost(json_decode($item->rates));

                $temp["number_liked"] = count(json_decode($item->likes));
                $temp["number_comments"] = count(json_decode($item->comments));
                $listLiked = json_decode($item->likes);
                $isLiked = in_array($idStudent, $listLiked);
                $temp["is_liked"] = $isLiked;
                array_push($response, $temp);
            }
        }

        // $collection = $response;
        // $res = $this->paginate($collection, $perPage = 5, $page = null, $options = []);
        return response()->json(["code"=>200,"data_array"=>$response], 200);
    }

    //get detail post 
    public function getDetailPost($idStudent, $idPost) 
    {
        $student = Student::find($idStudent);

        if (!$student) {
            return response()->json(["code"=>422, "message"=>"student not found", "data"=>null],422);
        }

        $post = Post::find($idPost);

        if (!$post) {
            return response()->json(["code"=>422, "message"=>"post not found", "data"=>null],422);
        }

        $response = [];
        $response["id"] = $post->id;
        $response["owner_id"] = $post->owner_id;
        $response["type"] = $post->type;

        $studentOwner = Student::find($post->owner_id);

        if (!$studentOwner) {
            return response()->json(["code"=>422, "message"=>"student owner not found", "data"=>null],422);
        }

        $studentResponse = [];
        $studentResponse["id"] = $studentOwner->id;
        $studentResponse["name"] = $studentOwner->name;
        $studentResponse["avatar"] = $studentOwner->avatar;
        $response["student"] = $studentResponse;

        //get name of friends tag
        $friendsTagReponse = [];
        $friendsTag = json_decode($post->friends_tag);

        foreach ($friendsTag as $item) {
            $studentTag = $this->studentController->getBriefStudent();
            if ($studentTag) {
                array_push($friendsTagReponse, $studentTag);
            }
        }

        $response["friends_tag"] = $friendsTagReponse;
        $response["created_at"] = $post->created_at->toDateTimeString();
        $response["updated_at"] = $post->updated_at->toDateTimeString();
        $response["title"] = $post->title;
        $response["content"] = $post->content;
        $response["images_enclose"] = json_decode($post->images_enclose);
        $response["files_enclose"] = json_decode($post->files_enclose);
        $response["links"] = json_decode($post->links);

        //get list liked
        $likedResponse = [];
        $likes = json_decode($post->likes);
        $response["is_liked"] = in_array($idStudent, $likes);
        foreach ($likes as $item) {
            $studentLiked = $this->studentController->getBriefStudent($item);

            if ($studentLiked) {
                array_push($likedResponse, $studentLiked);
            }
        }

        $response["likes"] = $likedResponse;

        //get list rates
        $response["rates"] = $this->getRateForPost(json_decode($post->rates));

        //get list comments
        $commentsResponse = [];
        $comments = json_decode($post->comments);

        foreach ($comments as $item) {
            $comment = $this->commentController->getComment($item);

            if ($comment) {
                array_push($commentsResponse, $comment);
            }
        }

        $response["comments"] = $commentsResponse;

        // save to statistic 
        $dataStatistic = $this->getDataChange($post->type, "seen");
        $branch = $this->branchController->getIdBranchBy($post->hash_tag);
        if ($branch != - 1) {
            $this->statisticController->saveIntoStatistic($dataStatistic, $post->owner_id, $branch);
        }
        
        return response()->json(["code"=>200,"message"=>"get detail post success","data"=>$response], 200);
    }

    //get list post when search by hashtag
    public function getPostsByHashtag($idStudent, $hashtag) 
    {
        $posts = Post::where('status', 3)->paginate(15);

        $response = [];

        foreach ($posts as $item) {
            $check = $this->branchController->checkSameBranch($hashtag, $item->hash_tag);
            if ($check) {
                //save to statistic
                $branch = $this->branchController->getIdBranchBy($item->hash_tag);

                if ($branch != - 1) {
                    $this->statisticController->saveIntoStatistic("search", $item->owner_id, $branch);
                }

                $temp = [];
                $temp["id"] = $item->id;
                $temp["type"] = $item->type;
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
                    $temp["title"] = $item->title;
                    $temp["content"] = $item->content;
                    $temp["images_enclose"] = json_decode($item->images_enclose);
                    $temp["files_enclose"] = json_decode($item->files_enclose);
                    $temp["rates"] = json_decode($item->rates);
                    $temp["number_liked"] = count(json_decode($item->likes));
                    $temp["number_comments"] = count(json_decode($item->comments));
                    $listLiked = json_decode($item->likes);
                    $isLiked = in_array($idStudent, $listLiked);
                    $temp["is_liked"] = $isLiked;
                    array_push($response, $temp);
                }
            }
        }

        // $collection = $response;
        // $res = $this->paginate($collection, $perPage = 5, $page = null, $options = []);
        return response()->json(["code"=>200,"data_array"=>$response], 200);
    }

    //get rates for post
    public function getRateForPost($rates) 
    {
        $result = [];

        foreach ($rates as $item) {
            $studentId = $item->student_id;
            $student = $this->studentController->getBriefStudent($studentId);

            if ($student) {
                $temp = [];
                $temp["student"] = $student;
                $temp["number_star"] = $item->number_star;
                array_push($result, $temp);
            }
        }

        return $result;
    }

    //get data change to save into table statistic
    public function getDataChange($type, $method) 
    {
        if ($type == 1) {
            return "question_{$method}";
        } else if ($type == 2) {
            return "blog_{$method}";
        } else {
            return "review_$method";
        }
    }

    // save to statistic
    public function saveToStatistic(Post $post, $method)
    {
        $dataStatistic = $this->getDataChange($post->type, $method);
        $branch = $this->branchController->getIdBranchBy($post->hash_tag);
        if ($branch != - 1) {
            $this->statisticController->saveIntoStatistic($dataStatistic, $post->owner_id, $branch);
        }
    }
}

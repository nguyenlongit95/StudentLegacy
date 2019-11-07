<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\controllers\QuestionController;
use App\http\controllers\BlogController;
use App\Comment;
use App\Blog;
use App\Student;
use Carbon\Carbon;

class CommentController extends Controller
{
    /**
     * Store a newly comment in DB.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeComment(Request $request)
    {
        if (!$request->owner_id || !$request->content 
            || !$request->post_id || !$request->type) {
            return -1;
        }

        // Create new comment to insert into DB
        $comment = new Comment;
        $comment->owner_id = $request->owner_id;
        
        if (!$request->friends_tag) {
            $comment->friends_tag = "[]";
        } else {
            $comment->friends_tag = $request->friends_tag;
        }

        if (!$request->status) {
            $comment->status = null;
        } else {
            $comment->status = $request->status;
        }

        $comment->content = $request->content;

        if (!$request->images_enclose) {
            $comment->images_enclose = "[]";
        } else {
            $images = $request->images_enclose;
            $imagesPath = [];
            foreach ($images as $file) {
                $name = $file->getClientOriginalName();
                $path = "http://localhost/StudentLegacy/public/upload/Comments/$name";
                $newFile = $file->move('upload/Comments', $file->getClientOriginalName());
                array_push($imagesPath, $path);
            }
            
            $comment->images_enclose = json_encode($imagesPath);
        }

        if (!$request->liked) {
            $comment->liked = "[]";
        } else {
            $comment->liked = $request->liked;
        }

        if (!$request->replies) {
            $comment->replies = "[]";
        } else {
            $comment->replies = $request->replies;
        }

        $comment->created_at = Carbon::now();
        $comment->updated_at = Carbon::now();

        try {
            $comment->save();
            $idComment = $comment->id;
            
            return $idComment;
        } catch (\Exception $exception) {
            return -1;
        }
    }

    /**
     * Store a newly reply comment into DB.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeReplyComment(Request $request)
    {
        if (!$request->owner_id || !$request->content || !$request->parent_cmt_id) {
            return response()->json(["code"=>400,"message"=>"invalid input"], 400);
        }

        $parentComment = Comment::find($request->parent_cmt_id);

        if (!$parentComment) {
            return response()->json(["code"=>422, "message"=>"Parent comment not found"],422);
        }

        // Create new reply comment to insert into DB
        $comment = new Comment;
        $comment->owner_id = $request->owner_id;
        
        if (!$request->friends_tag) {
            $comment->friends_tag = "[]";
        } else {
            $comment->friends_tag = $request->friends_tag;
        }

        if (!$request->status) {
            $comment->status = null;
        } else {
            $comment->status = $request->status;
        }

        $comment->content = $request->content;

        if (!$request->images_enclose) {
            $comment->images_enclose = "[]";
        } else {
            $images = $request->images_enclose;
            $imagesPath = [];
            foreach ($images as $file) {
                $name = $file->getClientOriginalName();
                $path = "http://localhost/StudentLegacy/public/upload/Comments/$name";
                $newFile = $file->move('upload/Comments', $file->getClientOriginalName());
                array_push($imagesPath, $path);
            }
            
            $comment->images_enclose = json_encode($imagesPath);
        }

        if (!$request->liked) {
            $comment->liked = "[]";
        } else {
            $comment->liked = $request->liked;
        }

        if (!$request->replies) {
            $comment->replies = "[]";
        } else {
            $comment->replies = $request->replies;
        }

        $comment->created_at = Carbon::now();
        $comment_updated_at = Carbon::now();

        try {
            $comment->save();

            //change replies of comment's parent
            $idComment = $comment->id;
            $replies = json_decode($parentComment->replies, true);
            array_push($replies, $idComment);
            $parentComment->replies = json_encode($replies);
            $parentComment->save();
            return response()->json(["code"=>200, "message"=>"store reply comment success"], 200);
        } catch (\Exception $exception) {
            return reponse()->json(["code"=>500, "message"=>"System Errors"], 500);
        }
    }

    /**
     * get reply of comment
     *
     * @param  id
     * @return Comment
     */
    public function getReplyComment($idReply) 
    {
        if (!$idReply) {
            return null;
        }

        $commentRep = Comment::find($idReply);

        if (!$commentRep) {
            return null;
        }

        $result = [];
        $result["id"] = $commentRep->id;
        $result["owner_id"] = $commentRep->owner_id;

        $studentOwner = Student::find($commentRep->owner_id);

        if (!$studentOwner) {
            return null;
        }

        $studentResponse = [];
        $studentResponse["id"] = $studentOwner->id;
        $studentResponse["name"] = $studentOwner->name;
        $studentResponse["avatar"] = $studentOwner->avatar;
        $result["student"] = $studentResponse;

        //get name of friends tag
        $friendsTagReponse = [];
        $friendsTag = json_decode($commentRep->friends_tag);

        foreach ($friendsTag as $item) {
            $studentTag = Student::find($item);
            if ($studentTag) {
                $temp = [];
                $temp["id"] = $studentTag->id;
                $temp["name"] = $studentTag->name;
                array_push($friendsTagReponse, $temp);
            }
        }

        $result["friends_tag"] = $friendsTagReponse;
        $result["content"] = $commentRep->content;
        $result["images_enclose"] = json_decode($commentRep->images_enclose);

        //get list liked
        $likedResponse = [];
        $liked = json_decode($commentRep->liked);

        foreach ($liked as $item) {
            $studentLiked = Student::find($item);
            if ($studentLiked) {
                $temp = [];
                $temp["id"] = $studentTag->id;
                $temp["name"] = $studentTag->name;
                array_push($likedResponse, $temp);
            }
        }

        $result["liked"] = $likedResponse;
        $result["created_at"] = $commentRep->created_at->toDateTimeString();

        return $result;
    }

    /**
     * get detail comment
     *
     * @param  id
     * @return Comment with  replies
     */
    public function getComment($idComment) 
    {
        if (!$idComment) {
            return null;
        }

        $comment = Comment::find($idComment);

        if (!$comment) {
            return null;
        }

        $result = [];
        $result["id"] = $comment->id;
        $result["owner_id"] = $comment->owner_id;

        $studentOwner = Student::find($comment->owner_id);

        if (!$studentOwner) {
            return null;
        }
        
        $studentResponse = [];
        $studentResponse["id"] = $studentOwner->id;
        $studentResponse["name"] = $studentOwner->name;
        $studentResponse["avatar"] = $studentOwner->avatar;
        $result["student"] = $studentResponse;

        //get name of friends tag
        $friendsTagReponse = [];
        $friendsTag = json_decode($comment->friends_tag);

        foreach ($friendsTag as $item) {
            $studentTag = Student::find($item);
            if ($studentTag) {
                $temp = [];
                $temp["id"] = $studentTag->id;
                $temp["name"] = $studentTag->name;
                array_push($friendsTagReponse, $temp);
            }
        }

        $result["friends_tag"] = $friendsTagReponse;
        $result["content"] = $comment->content;
        $result["images_enclose"] = json_decode($comment->images_enclose);

        //get list liked
        $likedResponse = [];
        $liked = json_decode($comment->liked);

        foreach ($liked as $item) {
            $studentLiked = Student::find($item);
            if ($studentLiked) {
                $temp = [];
                $temp["id"] = $studentTag->id;
                $temp["name"] = $studentTag->name;
                array_push($likedResponse, $temp);
            }
        }

        $result["liked"] = $likedResponse;

        //get replies
        $repliesResponse = [];
        $replies = json_decode($comment->replies);

        foreach ($replies as $item) {
            $reply = $this->getReplyComment($item);

            if ($reply) {
                array_push($repliesResponse, $reply);
            }
        }

        $result["replies"] = $repliesResponse;
        $result["created_at"] = $comment->created_at->toDateTimeString();

        return $result;
    }
}

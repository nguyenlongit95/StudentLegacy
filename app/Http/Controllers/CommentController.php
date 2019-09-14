<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Blog;
use App\Student;
use Carbon\Carbon;

class CommentController extends Controller
{
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
     * Store a newly comment in DB.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeComment(Request $request)
    {
        if (!$request->owner_id) {
            return response()->json(["message"=>"comment's owner id is null"], 400);
        }

        if (!$request->content) {
            return response()->json(["message"=>"comment's content is null"], 400);
        }

        if (!$request->blog_id) {
            return response()->json(["message"=>"comment's blog id is null"], 400);
        }

        $blog = Blog::find($request->blog_id);
        if (!$blog) {
            return response()->json(["message"=>"Blog include this cmt not found"], 422);
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
            $comment->images_enclose = $request->images_enclose;
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
            $idComment = $comment->id;
            $comments = json_decode($blog->comments);
            // return $comments;
            array_push($comments, $idComment);
            $blog->comments = json_encode($comments);
            $blog->save();

            return response()->json(["comment"=>$comment, "blog"=> $blog], 200);
        } catch (\Exception $exception) {
            return reponse()->json(["message"=>"System Errors"], 500);
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
        if (!$request->owner_id) {
            return response()->json(["message"=>"comment's owner id is null"], 400);
        }

        if (!$request->content) {
            return response()->json(["message"=>"comment's content is null"], 400);
        }

        if (!$request->parent_cmt_id) {
            return response()->json(["message"=>" id parent of comment is null"], 400);
        }

        $parentComment = Comment::find($request->parent_cmt_id);

        if (!$parentComment) {
            return response()->json(["message"=>"Parent comment not found"],422);
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
            $comment->images_enclose = $request->images_enclose;
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
            return response()->json($comment, 200);
        } catch (\Exception $exception) {
            return reponse()->json(["message"=>"System Errors"], 500);
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

        $result["username"] = $studentOwner->name;

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
        $result["images"] = $commentRep->images_enclose;

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
        $result["time_created"] = $commentRep->created_at;

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

        $result["username"] = $studentOwner->name;

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
        $result["images"] = $comment->images_enclose;

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
        $result["time_created"] = $comment->created_at;

        return $result;
    }
}

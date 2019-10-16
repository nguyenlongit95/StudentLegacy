<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use Carbon\Carbon;

class StudentController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);
        $listFriend = $student->friends;
        
        if (!$student) {
            return response()->json(["message"=>"data not found"], 404 );
        }

        return response()->json($student, 200);
    }

    /**
     * store newly student
     *
     * @param  request
     * @return \Illuminate\Http\Response
     */
    public function storeStudent(Request $request) 
    {
        
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
        // validate du lieu
        if (!$request->friends) {
            return response()->json(["message"=>"Please enter a id of friend"], 400);
        }
        
        $student = Student::find($id);

        if (!$student) {
            return response()->json(["message"=>"Data not found"], 422);
        }

        $listFriend = json_decode($student->friends);
        array_push($listFriend, ["id"=>$request->friends]);
        $encodeFriend = json_encode($listFriend);
        $student->friends = $encodeFriend;

        try { 
            $student->save();
            return response()->json($student, 200);
        } catch (\Exception $exception) {
            return response()->json(["message"=>"DB Errors"], 500);
        }
    }

    /**
     * Function store friends request
     *  Param: idStudent, idFriend
     *
     * @return messsage
     */
    public function storeFriendRequest(Request $request) 
    {
        if (!$request->idStudent || !$request->idFriend) {
            return response()->json(["message"=>"Please enter all input"], 400);
        }

        $student = Student::find($request->idStudent);

        if (!$student) {
            return response()->json(["Student not found"], 422);
        }

        $friend = Student::find($request->idFriend);

        if (!$friend) {
            return response()->json(["message"=>"Friend not"], 422);
        }

        $friendsRequest = json_decode($student->friends_requested);

        array_push($friendsRequest, $request->idFriend);

        $student->friends_requested = json_encode($friendsRequest);

        try {
            $student->save();
            return response()->json($student, 200);
        } catch (\Exception $exception) {
            return response()->json(["message"=>"Systems Errors"], 500);
        }
    }

    /**
     * Function confirm the request friend
     *  Param: idStudent, idFriend, confirm
     *
     * @return messsage
     */
    public function confirmFriendRequest(Request $request) 
    {
        if (!$request->idStudent || !$request->idFriend || !$request->confirm) {
            return response()->json(["message"=>"Please enter all input"], 400);
        }

        $student = Student::find($request->idStudent);

        if (!$student) {
            return response()->json(["Student not found"], 422);
        }

        $friend = Student::find($request->idFriend);

        if (!$friend) {
            return response()->json(["message"=>"Friend not found"], 422);
        }

        $friendsRequest = json_decode($student->friends_requested, true);

        $haveRequest = in_array($request->idFriend, $friendsRequest);

        if (!$haveRequest) {
            return response()->json(["message"=>"request friend not found"], 422);
        }

        if ($request->confirm == 1) {
            $this->storeFriend($student, $request->idFriend);
            $this->storeFriend($friend, $request->idStudent);
        }
        //delete request
        // return $friendsRequest;
        $idFriend = $request->idFriend;
        $newFriendsRequest = array_filter($friendsRequest, function ($value) use ($idFriend) {
            return $value != $idFriend;
        });
        $student->friends_requested = json_encode($newFriendsRequest);
        try {
            $student->save();
            return response()->json($student, 200);
        } catch (\Exception $exception) {
            return response()->json(["message"=>"Systems errors"], 500);
        }
    }

    /**
     * Function store friend
     *  Param: idStudent, idFriend
     *
     * @return message
     */
    public function storeFriend(Student $student, $idFriend) 
    {
        $friends = json_decode($student->friends, true);
        $isFriend = in_array(["id"=>$idFriend], $friends);
        if (!$isFriend) {
            array_push($friends, ["id"=>$idFriend]);
            $student->friends = json_encode($friends);

            try {
                $student->save();
            } catch (\Exception $exception) {
                return response()->json(["message"=>"System Errors"], 500);
            }
        }
    }

    /**
     * Function get information of self student
     *  Param: id
     *
     * @return Student
     */
    public function getInfoStudent($id)
    {
        if (!$id) {
            return response()->json(["message"=>"Please enter id of student"], 400);
        }

        $student = Student::find($id);

        if (!$student) {
            return response()->json(["message"=>"Data not found"], 422);
        }

        $student->friends = json_decode($student->friends);
        $student->friends_requested = json_decode($student->friends_requested);
        $result = [];
        $result["code"] = 200;
        $result["data"] = $student;
        return response()->json($result, 200);
    }

    /**
     * Function get brief of student
     *  Param: idStudent
     *
     * @return id, username, avatar
     */
    public function getBriefStudent($idStudent) 
    {
        $student = Student::find($idStudent);

        if (!$student) {
            return null;
        }

        $result = [];
        $result["student_id"] = $idStudent;
        $result["name"] = $student->name;
        $result["avatar"] = $student->avatar;
        return $result;
    }

    /**
     * Function check student exist
     *  Param: id
     *
     * @return yes: 1, no: 0
     */
    public function checkStudentExist($idStudent) 
    {
        $student = Student::find($idStudent);

        if ($student) {
            return 1;
        }

        return 0;
    }

    /**
     * Function validate student with token
     *  Param: string token
     *
     * @return yes: 1, no: 0
     */
    public function validateStudent($token) 
    {
        $student = Student::where('remember_token', $token)->first();

        if (!$student) {
            $result = [];
            $result["active"] = false;
            $result["student"] = null;
            return response()->json(["code"=>200, "data"=>$result], 200);
        }

        $result = [];
        $result["active"] = true;
        $result["student"] = $student;
        return response()->json(["code"=>200, "data"=>$result], 200);
    }

    /**
     * Function get information of student'friends
     *  Param: id
     *
     * @return id, username, avatar, mail, gender, description
     */
    public function getInfoFriend($idStudent, $idFriend)
    {
        if (!$idStudent || !$idFriend) {
            return response()->json(["message"=>"Please enter all input"], 400);
        }

        $student = Student::find($idStudent);

        if (!$student) {
            return response()->json(["message"=>"student not found"], 422);
        }

        $friendSearch = Student::find($idFriend);

        if (!$friendSearch) {
            return response()->json(["message"=>"Friend not found"], 422);
        }

        //Check relationship
        $friends = json_decode($student->friends, true);
        $isFriend = in_array(["id"=>$idFriend], $friends);
                
        return response()->json(["id"=>$student->id,
                                 "username"=>$student->username,
                                 "avatar"=>$student->avatar,
                                 "mail"=>$student->email,
                                 "gender"=>$student->gender,
                                 "description"=>$student->description,
                                 "isFriend"=>$isFriend], 200);
    }    

    /**
     * Function login for student
     *  Param: username and password
     *
     * @return str token
     */
    public function loginStudent(Request $request)
    {
        if (!$request->email && !$request->password) {
            return response()->json(["message"=>401,
                                        "data"=>null], 401);
        }

        $checkLogin = Student::where('email',$request->email)
            ->where('password',$request->password)->first();
        
        if (!$checkLogin) { 
            return response()->json(["message"=>403], 403);
        }

        // Login success encode start time and id student
        $carbonNow = Carbon::now();
        $remember_token = md5($checkLogin->id."_".$carbonNow);

        if ($remember_token) {
            $studentRemember = Student::find($checkLogin->id);
            $studentRemember->remember_token = $remember_token;
            $studentRemember->save();
            $result = [];
            $result["token"] = $remember_token;
            return response()->json(["code"=>200,
                                        "data"=>$result], 200);
        }
        return response()->json(["message"=>"System erros"], 500);
    }
}

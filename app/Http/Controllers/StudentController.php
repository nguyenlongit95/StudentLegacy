<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use Carbon\Carbon;

class StudentController extends Controller
{
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
        $student = Student::find($id);
        $listFriend = $student->friends;
        
        if (!$student) {
            return response()->json(["message"=>"data not found"], 404 );
        }

        return response()->json($student, 200);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Function store friends request
     *  Param: idStudent, idFriend
     *
     * @return messsage
     */
    public function storeFriendRequest(Request $request) 
    {
        if (!$request->idStudent) {
            return response()->json(["message"=>"Please enter idStudent"], 400);
        }

        if (!$request->idFriend) {
            return response()->json(["message"=>"Please enter idFriend"], 400);
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
    public function confirmFriendRequest(Request $request) {
        if (!$request->idStudent) {
            return response()->json(["message"=>"Please enter idStudent"], 400);
        }

        if (!$request->idFriend) {
            return response()->json(["message"=>"Please enter idFriend"], 400);
        }

        if (!$request->confirm) {
            return response()->json(["message"=>"Please enter confirm"], 400);
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
    public function storeFriend(Student $student, $idFriend) {
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

        return response()->json($student, 200);
    }

    /**
     * Function get information of student'friends
     *  Param: id
     *
     * @return id, username, avatar, mail, gender, description
     */
    public function getInfoFriend($idStudent, $idFriend)
    {
        if (!$idStudent) {
            return response()->json(["message"=>"Please enter id of student"], 400);
        }

        $student = Student::find($idStudent);

        if (!$student) {
            return response()->json(["message"=>"student not found"], 422);
        }

        if (!$idFriend) {
            return response()->json(["message"=>"Please enter id of friend"], 400);
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
            return response()->json(["message"=>"Email or password not found"], 401);
        }

        $checkLogin = Student::where('email',$request->email)
            ->where('password',$request->password)->first();
        
        if (!$checkLogin) { 
            return response()->json(["message"=>"Login faild, please check again"], 403);
        }

        // Login success encode start time and id student
        $carbonNow = Carbon::now();
        $remember_token = md5($checkLogin->id."_".$carbonNow);

        if ($remember_token) {
            $studentRemember = Student::find($checkLogin->id);
            $studentRemember->remember_token = $remember_token;
            $studentRemember->save();
            return response()->json(["message"=>$remember_token], 200);
        }
        return response()->json(["message"=>"System erros"], 500);
    }
}

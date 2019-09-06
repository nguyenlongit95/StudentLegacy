<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use Carbon\Carbon;

class StudentController extends Controller
{
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
        //
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

<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquent\RepositoryInterface;
use Illuminate\Http\Request;
use App\Subject;
use App\Repositories\Subject\SubjectRepositoryInterface;

class SubjectController extends Controller
{
    protected $subjectRepositories;

    // Phương thức khởi tạo để gọi đến interface, Tham số đầu vào chính là interface
    public function __construct(SubjectRepositoryInterface $reporitorySubject)
    {
        $this->subjectRepositories = $reporitorySubject;
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
        if (!$request->name) {
            return reponse()->json(["message"=>"Subject name not found"], 204);
        }

        if (!$request->time_start) {
            return reponse()->json(["message"=>"Subject time start not found"], 204);
        }

        if (!$request->time_end) {
            return reponse()->json(["message"=>"Subject time end not found"], 204);
        }

        if (!$request->max_student) {
            return response()->json(["message"=>"Subject max student not found"], 204);
        }

        if (!$request->fee) {
            return response()->json(["message"=>"Subject fee not found"], 204);
        }

        //create new object Subject to insert into database
        $subject = new Subject;
        $subject->name = $request->name;
        $subject->time_start = $request->time_start;
        $subject->time_end = $request->time_end;
        $subject->max_student = $request->max_student;
        $subject->fee = $request->fee;
        $subject->hotline = $request->hotline;
        $subject->short_description = $request->short_description;
        $subject->description = $request->description;

        $subject->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd($id);
        $subject = $this->subjectRepositories->find($id);
        return response()->json($subject);
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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Academy;

class AcademyController extends Controller
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
     * get brief academy contains id subject
     *
     * @param  int  $id
     * @return Academy
     */
    public function storeSubjectToAcademy($idAcademy, $idSubject) 
    {
        if (!$idAcademy) {
            return null;
        }

        if (!$idSubject) {
            return null;
        }

        $academy = Academy::find($idAcademy);

        if (!$academy) {
            return null;
        }

        $subjects = json_decode($academy->subjects);

        array_push($subject, $idSubject);

        try {
            $academy->save();
        } catch( \Exception $exception) {
            return response()->json(["message"=>"Systems Errors"], 500);
        }
    }

    /**
     * get academy
     *
     * @param  int  $id
     * @return Academy
     */
    public function getBriefAcademy($id)
    {
        if (!$id) {
            return null;
        }

        $academy = Academy::find($id);

        if (!$academy) {
            return null;
        }

        $result = [];
        $result["id"] = $academy->id;
        $result["name"] = $academy->name;
        $result["avatar"] = $academy->avatar;
        return $result;
    }
    
    /**
     * get all academy
     *
     * @param  
     * @return list Academy
     */
    public function getAllAcademy()
    {
        $academies = Academy::get();

        return $academies;
    }

    /**
     * get brief academy contains id subject
     *
     * @param  int  $id
     * @return Academy
     */
    public function getBriefAcademyByIdSubject($idSubject)
    {
        if (!$idSubject) {
            return null;
        }

        $academies = Academy::get();

        foreach ($academies as $item) {
            $subjects = json_decode($item->subjects);
            
            foreach ($subjects as $subject) {
                if ($subject == $idSubject) {
                    $result = [];
                    $result["id"] = $item->id;
                    $result["name"] = $item->name;
                    $result["avatar"] = $item->avatar;
                    return $result;
                } 
            }
        }

        return null;
    }
}

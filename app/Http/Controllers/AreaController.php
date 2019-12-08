<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;
use App\http\controllers\BranchController;

class AreaController extends Controller
{
    protected $branchController;

    public function __construct(BranchController $branchCon) 
    {
        $this->branchController = $branchCon;
    }
    //get All area with branch
    public function getAllArea() 
    {
        $areas = Area::get();
        $response = [];

        foreach ($areas as $item) {
            $temp = [];
            $temp["id"] = $item->id;
            $temp["region_id"] = $item->region_id;
            $temp["name"] = $item->name;
            $temp["description"] = $item->description;
            $branches = $this->branchController->getBranchInArea($item->id);
            foreach ($branches as $branch) {
                $branch->hash_tags = json_decode($branch->hash_tags);
            }
            $temp["branches"] = $branches;
            array_push($response, $temp);
        }

        return response()->json(["code"=>200, "message"=>"get all area success", "data_array"=>$response], 200);
    }
}

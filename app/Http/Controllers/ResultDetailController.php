<?php

namespace App\Http\Controllers;
use App\ResultDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ResultDetailController extends Controller
{
    //store new detail result of lession
    public function storeResultDetail($resultLessionId, Request $request) {
        if (!$request->time_study || !$request->completion) {
            return -1;
        }

        $result = ResultDetail::where('result_lession_id', $resultLessionId)
        ->whereDate('created_at', Carbon::today())->first();

        if (!$result) {
            $temp = new ResultDetail;
            $temp->result_lession_id = (int)$resultLessionId;
            $temp->date = Carbon::now();
            $temp->completion = $request->completion;
            $time = [];
            array_push($time, $request->time_study);
            $temp->times_study = json_encode($time);
            $temp->created_at = Carbon::now();
            $temp->updated_at = Carbon::now();
            // return response()->json($temp);
            try {
                $temp->save();
                return $temp->id;
            } catch (\Exception $exception) {
                return -1;
            }
        }

        $times = json_decode($result->times_study);
        array_push($times, $request->time_study);
        $result->times_study = json_encode($times);

        try {
            $result->save();
            return $result->id;
        } catch(\Exception $exception) {
            return -1;
        }
    }
}

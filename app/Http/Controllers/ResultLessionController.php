<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\controllers\ResultDetailController;
use App\ResultLession;
use Carbon\Carbon;

class ResultLessionController extends Controller
{
    protected $resultDetailContronller;

    public function __construct(ResultDetailController $resultDetailCon)
    {
        $this->resultDetailContronller = $resultDetailCon;
    }
    // store result lession
    public function storeResultLession($scheduleId, Request $request) 
    {
        if (!$request->completion || !$request->lession_id) {
            return -1;
        }

        $result = ResultLession::where('schedule_id', $scheduleId)->where('lession_id', $request->lession_id)->first();

        if (!$result) {
            $temp = new ResultLession;
            $temp->schedule_id = $scheduleId;
            $temp->lession_id = $request->lession_id;
            $temp->completion = $request->completion;
            $temp->created_at = Carbon::now();
            $temp->updated_at = Carbon::now();
            try {
                $temp->save();
                $isSavedResultDetail = $this->resultDetailContronller->storeResultDetail($temp->id, $request);
                return $isSavedResultDetail;
                if ($isSavedResultDetail == -1) {
                    return -1;
                }

                return $temp->id;
            } catch (\Exception $exception) {
                return -1;
            }
        }

        if ( $result->completion < $request->completion) {
            $result->completion = $request->completion; 
        }
        
        try {
            $result->save();
            $savedResultDetail = $this->resultDetailContronller->storeResultDetail($result->id, $request);

            if ($savedResultDetail == -1) {
                return -1;
            }

            return $result->id;
        } catch (\Exception $exception) {
            return -1;
        }
    }

    //get result of lession 
    public function getResultLession($scheduleId, $lessionId) 
    {
        $result = ResultLession::where('schedule_id', $scheduleId)->where('lession_id', $lessionId)->first();
        
        if (!$result) {
            return 0;
        }
        
        return $result->completion;
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Models\ActionLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActionLogController extends Controller
{
    //
    public function setActionLog(Request $request){
        $data=[ 
            'user_id' => $request->user_id,
            'post_id' => $request->post_id
        ];
           
        
        ActionLog::create($data);
        $data=ActionLog::where('post_id',$request->post_id)->get();
        return response()->json([
            'post'=>$data
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrendPostController extends Controller
{
    //
    public function index(){
        $posts=ActionLog::select('action_logs.*','posts.*',DB::raw('COUNT(action_logs.post_id) as post_count'))
        ->leftJoin('posts','posts.post_id','action_logs.post_id')
        ->groupBy('action_logs.post_id')
        ->get();
        return  view('admin.trend_post.index',compact('posts'));
    }
    //direct trend post detail page
    public function trendPostDetails($id){
       $post=Post::where('post_id',$id)->first();
      
        return  view('admin.trend_post.detail',compact('post'));
    }
}

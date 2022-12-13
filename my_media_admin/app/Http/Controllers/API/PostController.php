<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    //get all post
    public function allPost(){
        $posts=Post::get();
        return response()->json([
            'status'=>'success',
            'post' => $posts
        ]);
    }

    //search post data
    public function postSearch(Request $request){
        $post=Post::where('title','LIKE','%'.$request->key.'%')->get();
        return response()->json([
          'searchData' => $post
        ]);
    }

    //detail post
    public function postDetail(Request $request){
      $id= $request->postId;
      $post=Post::where('post_id',$id)->first();
      return response()->json([
        'post' => $post,
      ]);
    }
}

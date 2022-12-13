<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //get all category
    public function getAllCategory(){
        $category=Category::select('category_id','title','description')->get();
        return response()->json([
          'category'=>$category
        ]);
    }

    //search category
    public function categorySearch(Request $request){
      $category=Post::where('category_id','LIKE','%'.$request->key.'%')->get();
      return response()->json([
        'result'=>$category
      ]);


    }
}

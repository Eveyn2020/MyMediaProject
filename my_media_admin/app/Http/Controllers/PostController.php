<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    //
    public function index(){
        $categories=Category::get();
        $posts=Post::get();
        return view('admin.post.index',compact('categories','posts'));
    }

    //create post
    public function createPost(Request $request){
       $validator=$this->postValidationCheck($request);
       if($validator->fails()){
        return back()->withErrors($validator)->withInput();
       }
       if(!empty($request->postImage)){
          $file=$request->file('postImage');
          $fileName=uniqid().'_'.$file->getClientOriginalName();
          $file->move(public_path().'/postImage',$fileName);

          $data=$this->getPostData($request,$fileName);
       }else{
        $data=$this->getPostData($request,null);
       }

      Post::create($data);
      return back();
    }

  
    //create post data
    public function getPostData($request,$fileName){
        return [
            'title'=>$request->postTitle,
            'description'=>$request->postDescription,
            'image'=>$fileName,
            'category_id'=>$request->postCategory,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ];
    }

    //delete post
    public function deletePost($id){
        $postData=Post::where('post_id',$id)->first();
        $dbImageName=$postData['image'];
        Post::where('post_id',$id)->delete();
        if(File::exists(public_path().'/postImage/'.$dbImageName)){
            File::delete(public_path().'/postImage/'.$dbImageName);
        }
        return back();
    }

    //direct to update page
    public function updatePage($id){
        $postDetail=Post::where('post_id',$id)->first();
        $categories=Category::get();
        $posts=Post::get();
        return view('admin.post.update',compact('postDetail','categories','posts'));

    }

    // update post
    public function updatePost($id,Request $request){
        $validator=$this->postValidationCheck($request);
        if($validator->fails()){
         return back()->withErrors($validator)->withInput();
        }

        $data=$this->getPostUpdateData($request);
        
       if(isset($request->postImage)){
          $this->storeNewUpdateImage($id,$request,$data);
       }else{
        Post::where('post_id',$id)->update($data);
       }
       return back();
    }


      //validaton check
    private function postValidationCheck($request){
        return Validator::make($request->all(),[
            'postTitle' => 'required',
            'postDescription'=>'required',
            'postCategory'=>'required'
        ]);
    }

    //request post update data
    private function getPostUpdateData($request){
        return [
            'title'=>$request->postTitle,
            'description'=>$request->postDescription,
            'category_id'=>$request->postCategory,
            'updated_at'=>Carbon::now()
        ];
    }
    
    //store update image
    private function storeNewUpdateImage($id,$request,$data){
        //get from client
        $file=$request->file('postImage');
        $fileName=uniqid().'_'.$file->getClientOriginalName();
        
        //put image name
        $data['image']=$fileName;

        //get image name form database
        $postData=Post::where('post_id',$id)->first();
        $dbImageName=$postData['image'];
        
        //delete image form public folder
        if(File::exists(public_path().'/postImage/'.$dbImageName)){
            File::delete(public_path().'/postImage/'.$dbImageName);
        }
        //move new image to public folder
        $file->move(public_path().'/postImage',$fileName);
        Post::where('post_id',$id)->update($data);
    }

}

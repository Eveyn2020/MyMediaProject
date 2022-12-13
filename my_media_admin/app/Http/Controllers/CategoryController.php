<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //
    public function index(){
        $categories=Category::get();
        return view('admin.category.index',compact('categories'));
    }

    //create category
    public function createCategory(Request $request){
        $validator =$this->categoryValidationCheck($request);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
       $data=$this->getCategoryData($request);
       Category::create($data);
       return back();

    }

    //search catgegory
    public function searchCategory(Request $request){
        $categories=Category::orWhere('title','LIKE','%'.$request->searchCategory.'%')
                    ->orWhere('description','LIKE','%'.$request->searchCategory.'%')
                    ->get();

         return view('admin.category.index',compact('categories'));
    }

    //delete category
    public function deleteCategory($id){
        Category::where('category_id',$id)->delete();
        return redirect()->route('admin#category')->with(['deleteSuccess'=>'Category Deleted!']);

    }

    //category  edit page
    public function editCategory($id){
        $data=Category::where('category_id',$id)->first();
        $categories=Category::get();
        return view('admin.category.edit',compact('data','categories'));
    }

    //category edit
    public function updateCategory($id,Request $request){
        $validator =$this->categoryValidationCheck($request);

            if ($validator->fails()) {
                return back()
                            ->withErrors($validator)
                            ->withInput();
            }
           $data=$this->getCategoryData($request);

           Category::where('category_id',$id)->update($data);
           $categories=Category::get();
           return view('admin.category.index',compact('categories'));
    }

    //get category data
    private function getCategoryData($request){
        return [
            'title'=>$request->categoryName,
            'description'=>$request->categoryDescription,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
           ];
    }
    //checlk validaton for  category
    private function categoryValidationCheck($request){
        return  Validator::make($request->all(), [
            'categoryName' => 'required',
            'categoryDescription' => 'required'
        ]);
    }
}

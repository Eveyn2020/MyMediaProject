<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
{
    //
    public function index(){
        $userData=User::select('id','name','email','phone','address','gender')->get();
        $currentUser=Auth::user()->id;
        return view('admin.list.index',compact('userData','currentUser'));
    }

    //delete admin account
    public function deleteAccount($id){
      User::where('id',$id)->delete();
      return back()->with(['deleteSuccess'=>'User Account Deleted!']);
    }

    //admin list Search
    public function adminListSearch(Request $request){
        $userData=User::orWhere('name','Like','%'.$request->adminSearchKey.'%')
        ->orWhere('email','Like','%'.$request->adminSearchKey.'%')
        ->orWhere('phone','Like','%'.$request->adminSearchKey.'%')
        ->orWhere('address','Like','%'.$request->adminSearchKey.'%')
        ->orWhere('gender','Like','%'.$request->adminSearchKey.'%')
        ->get();
        $currentUser=Auth::user()->id;
        return view('admin.list.index',compact('userData','currentUser'));
    }
}

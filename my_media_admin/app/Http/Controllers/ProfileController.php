<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //
    public function index(){
        $id=Auth::user()->id;
        $user=User::select('id','name','address','phone','gender','email')->where('id',$id)->first();

        return view('admin.profile.index',compact('user'));
    }

    // update admin account
    public function updateAdminAccount(Request $request){
        $userData=$this->getUserInfo($request);

        $validator =$this->validationCheck($request);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        User::where('id',Auth::user()->id)->update($userData);
        return back()->with(['updateSuccess'=>'Success Updated!']);
    }

    //direct change password
    public function directChangePassword(){
        return view('admin.profile.changePassword');
    }

    //post method of change password
    public function changePassword(Request $request){
      $validator=$this->changePasswordValidationCheck($request);
      if ($validator->fails()) {
        return back()
                    ->withErrors($validator)
                    ->withInput();
    }
     $dbData=User::where('id',Auth::user()->id)->first();
     $dbPassword=$dbData->password;

     $hashUserPassword=Hash::make($request->newPassword);

     $updateData=[
        'password'=>$hashUserPassword,
        'updated_at'=>Carbon::now()
     ];
    //  if(strlen($request->newPassword) >=8 && strlen($request->conPassword)>=8)
     //Hash::check(password From user, password from datatbase)
     if(Hash::check($request->oldPassword,$dbPassword )){
         User::where('id',Auth::user()->id)->update($updateData);
         return redirect()->route('dashboard');
     }else{
        return back()->with(['fail'=>'Old password do not match.']);
     }
    }

    //get user info
    private function getUserInfo($request){
        return [
            'name' => $request->adminName,
            'email'=> $request->adminEmail,
            'address'=> $request->adminAddress,
            'phone'=>$request->adminNumber,
            'gender'=> $request->adminGender,
            'updated_at'=>Carbon::now()
        ];
    }

    //validaton check
    private function validationCheck($request){
        return  Validator::make($request->all(), [
            'adminName' => 'required',
            'adminEmail' => 'required',
        ]);
    }

    // validation check for change password
    public function changePasswordValidationCheck($request){
        $validationRule=[
            'oldPassword' => 'required',
            'newPassword' => 'required|min:8|max:15',
            'conPassword'=>'required|same:newPassword|min:8|max:15'
        ];
        $validationMessage=[
            'conPassword.same'=>'New Password and confirm password must be same.'
        ];
        return  Validator::make($request->all(),$validationRule,$validationMessage );
    }
}

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

    //direct admin home page
    public function index(){
        $id = Auth::user()->id;
        $user = User::select('id', 'name', 'email', 'phone', 'address', 'gender')->where('id', $id)->first();

        return view('admin.profile.index', compact('user'));
    }

    //update admin account details
    public function updateDetails(Request $request){
        $userData = $this->getUserInfo($request);

        $validator = $this->userValidationCheck($request);;

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        User::where('id', Auth::user()->id)->update($userData);
        return back()->with(['updateSuccess'=>'Admin Account Updated!']);
    }

    // direct change password page
    public function changePasswordPage(){
        return view('admin.profile.changePassword');
    }

    // change password function
    public function changePassword(Request $request){
        $validator = $this->passwordValdiationCheck($request);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $dbData = User::where('id', Auth::user()->id)->first();
        $dbPassword = $dbData->password;
        $hashNewPassword = Hash::make($request->newPassword);
        $updateData = [
            'password' => $hashNewPassword,
            'updated_at' => Carbon::now(),
        ];

        if(Hash::check($request->oldPassword, $dbPassword)){
            User::where('id', Auth::user()->id)->update($updateData);
            return redirect('/dashboard');
        } else {
            return redirect('admin/changePassword')->with(['failed'=>'Old password does not match with the one in Credentials']);
        }
    }

    // get user info function
    private function getUserInfo($request){
        return [
            'name' => $request->adminName,
            'email' => $request->adminEmail,
            'phone' => $request->adminPhone,
            'address' => $request->adminAddress,
            'gender' => $request->adminGender,
            'updated_at' => Carbon::now(),
        ];
    }

    // user validation
    private function userValidationCheck($request){
        return Validator::make($request->all(), [
            'adminName' => 'required',
            'adminEmail' => 'required',
        ], [
            'adminName.required' => 'Name is required',
            'adminEmail' => 'Email is required'
        ]);
    }

    // password validation
    private function passwordValdiationCheck($request){
        return Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:8',
            'confirmPassword' => 'required|same:newPassword|min:8',
        ], [
            'confirmPassword.same' => 'New Password & Confirm Password must be the same!',
            'newPassword.min' => 'New Password must be at least 8 letters long',
            'confirmPassword.min' => 'Confirm Password must be at least 8 letters long',
        ]);
    }
}

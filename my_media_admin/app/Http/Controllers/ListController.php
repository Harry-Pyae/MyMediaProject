<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ListController extends Controller
{
    // admin list page
    public function index(){
        $userData = User::select('id', 'name', 'email', 'phone', 'address', 'gender')->get();
        return view('admin.list.index', compact('userData'));
    }

    // delete admin account
    public function deleteAccount($id){
        User::where('id', $id)->delete();
        return back()->with(['DeleteSuccess'=>'Admin Account deleted successfully']);
    }

    // admin account search
    public function searchList(Request $request){
        $userData = User::orWhere('name', 'like', '%'.$request->adminSearchKey.'%')
                    ->orWhere('email', 'like', '%'.$request->adminSearchKey.'%')
                    ->orWhere('phone', 'like', '%'.$request->adminSearchKey.'%')
                    ->orWhere('address', 'like', '%'.$request->adminSearchKey.'%')
                    ->orWhere('gender', 'like', '%'.$request->adminSearchKey.'%')->get();
        return view('admin.list.index', compact('userData'));
    }
}

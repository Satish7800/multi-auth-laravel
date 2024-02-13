<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    public function index(){
        $role=Auth::user()->role;
        if($role==1){
            return view('Admin');
        }else{
            return view('dashboard');
        }
    }

    public function addUser(Request $request){

        $this->validate($request,[
            'name'=>'required|max:20',
            'email' => 'required|email|unique:users',
            'password'=>'required',
            'role'=>'required'
         ]);
        $data=new User;
        $data->name=$request->name;
        $data->email=$request->email;
        $data->password=bcrypt($request->password);
        $data->role=$request->role;
        $data->save();
        return redirect()->back()->with('message','User Added Successfully');
    }
}

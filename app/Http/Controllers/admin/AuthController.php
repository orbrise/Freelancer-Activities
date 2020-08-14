<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Validator;
use Auth;

class AuthController extends Controller
{

    public function Login()
    {
         if(Auth::check()) {
                return redirect()->route('admin.dashbaord');
            }

        return view('admin.pages.login');
    }

    public function DoLogin(Request $req)
    {
        $attributes = [
            'email' => 'Email Address ',
            'password' => 'Password'
        ];
        $validator = Validator::make($req->only(['email', 'password']) ,[
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ])->setAttributeNames($attributes);
        if($validator->fails())
        {
            return back()->withInput();
        }

        if(Auth::attempt(['email' => $req->email, 'password' => $req->password])){

            return redirect()->route('admin.dashbaord');
        }
         else {return back()->withInput()->with('errormsg','Your Password is Incorrect');}
    }
}

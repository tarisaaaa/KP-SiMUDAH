<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Login;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index() {
        return view('login');
    }

    public function login(Request $request) {
        $user_name = $request->user_name;
        $password = $request->password;

        //dd(Hash::make('123'));
        $user = Login::where(["user_name"=>$user_name])->first();
        if (!empty($user)){
            if(Hash::check($password,$user->password)){
                Session::put('user',$user);
                return redirect('/dashboard');
            }else{
                Session::flash('gagal_login',TRUE);
                return redirect('/login');
            }
        } else{
            Session::flash('gagal_login',TRUE);
            return redirect('/login');
        }
        
        
    }

    public function logout() {
        Session::flush(); 
        return redirect('/login');
    }
}

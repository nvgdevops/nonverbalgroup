<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    

   
    public function login()
    {
        return view('user.login');
    }

    public function authanticate(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->passes()) {
            if (Auth::attempt(['email'=>$request->email,'password'=>$request->password],$request->get('remember'))) {
               
                return redirect()->route('home');
            }else{
                session()->flash('error','email/password incorrect');
                return redirect()->route('login')->withInput($request->only('email'));
            }
        }else{
            return redirect()->route('login')
            ->withErrors($validator)
            ->withInput($request->only('email'));
        }
    }

   public function home()
   {
    return view('user.home');
   }
     

   public function logout()
   {
    Auth::guard()->logout();
    return redirect()->route('login');
   }
   
}

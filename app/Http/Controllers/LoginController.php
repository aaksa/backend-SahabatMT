<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    //

    public function login() {
        return view('auth.login');
    }

    public function store(Request $request) {


        $attributes = $request->validate([
            'email' => ['required'],
            'password' => ['required']
       ]);

       
       if(Auth::attempt($attributes)){
        return redirect()->intended('/');
       }


       throw ValidationException::withMessages([
        'email' => 'Email atau password yang anda masukkan salah',
    ]);


    }


    public function logout(){
        Auth::logout();
        return redirect('/');
    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function index()
    {
        $data = array(
            'title' => 'Login'
        );

        // return view('dashboard',$data);
        return view('login', $data);
    }

    function login(Request $request)
    {
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required'
            ],
            [
                'username.required' => 'Username is Required',
                'password.required' => 'Password is Required'
            ]
        );

        $infoLogin = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if (Auth::attempt($infoLogin)) {
            if (Auth::user()->role == 'admin') {
                return redirect('/admin');
            } elseif (Auth::user()->role == 'barista') {
                return redirect('/barista');
            }
        } else{
            return redirect('')->withErrors('Username or Password invalid')->withInput();
        }
    }

    function logout(){
        Auth::logout();
        return redirect('');
    }
}

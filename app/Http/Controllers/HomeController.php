<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Dashboard'
        );

        // return view('dashboard',$data);
        return view('login', $data);
    }

    public function login(Request $request)
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
            return redirect('admin');
        } else{
            return redirect('')->withErrors('Username or Password invalid')->withInput();
        }
    }
}

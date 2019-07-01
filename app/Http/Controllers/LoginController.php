<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    function index()
    {
        return view('login.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        //dd(Auth::attempt($credentials));
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/board');
        }
        else
        {
            $request->session()->flash('message','<div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Invalid username and password!</strong>.
            </div>');
            return redirect()->back();
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }

}

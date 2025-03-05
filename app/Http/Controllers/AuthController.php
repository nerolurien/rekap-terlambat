<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin(){
        $title = 'Login || Rekap Terlambat';
        return view('auth.login', compact('title'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ],[
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password tidak boleh kosong'
        ]);

        if(Auth::attempt($request->only('email', 'password')))
        {
            return redirect()->route('home');
        }

        return back()->withErrors(['email' => 'Email Atau Password Salah']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

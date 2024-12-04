<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginCotroller extends Controller
{
    public function index()
    {
        return view("Halaman-Login/index");
    }

    public function login(Request $request)
    {
        $request->validate([
            "email"=> "required",
            "password"=> "required",
        ]);

        $infologin = [
            "email"=> $request->email,
            "password"=> $request->password,
        ];

        if (Auth::attempt($infologin)) {
            return redirect()->route('Apps')->with('success', 'Anda Berhasil Login');
        }else{
            return redirect()->route('login')->withErrors('Username atau Password Salah')->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Anda Berhasil Keluar!');
    }
}

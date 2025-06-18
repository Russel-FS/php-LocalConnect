<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        return back()->with('status', 'Funcionalidad de login assún no implementada.');
    }

    public function register(Request $request)
    {
        return back()->with('status', 'Funcionalidad de registro asssún no implementada.');
    }
}

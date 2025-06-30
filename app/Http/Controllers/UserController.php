<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function perfil()
    {
        $user = Auth::user();
        $negocios = $user->negocios()->with('ubicacion')->get();
        return view('usuarios.perfil', compact('user', 'negocios'));
    }
}

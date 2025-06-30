<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Negocio\Negocio;
use App\Models\User;
use App\Models\Negocio\Categoria;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalNegocios = Negocio::count();
        $negociosPendientes = Negocio::where('verificado', 0)->count();
        $totalUsuarios = User::count();
        $totalCategorias = Categoria::count();
        $ultimasSolicitudes = Negocio::where('verificado', 0)->orderByDesc('created_at')->take(5)->get();

        return view('admin.dashboard', compact('totalNegocios', 'negociosPendientes', 'totalUsuarios', 'totalCategorias', 'ultimasSolicitudes'));
    }
}

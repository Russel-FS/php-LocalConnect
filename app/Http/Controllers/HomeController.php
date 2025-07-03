<?php

namespace App\Http\Controllers;

use App\Models\Negocio\Categoria;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // categoria activas con imagenes
        $categorias = Categoria::where('estado', 'activo')
            ->whereNotNull('img_url')
            ->orderBy('nombre_categoria')
            ->limit(4)
            ->get(['id_categoria', 'nombre_categoria', 'img_url']);

        return view('home.index', compact('categorias'));
    }
}

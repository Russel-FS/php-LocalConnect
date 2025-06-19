<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\ServicioPredefinido;

class NegocioController extends Controller
{
    public function showRegistro()
    {
        $serviciosPredefinidos = ServicioPredefinido::all();
        $categorias = Categoria::all();
        return view('negocios.registro', compact('serviciosPredefinidos', 'categorias'));
    }
}

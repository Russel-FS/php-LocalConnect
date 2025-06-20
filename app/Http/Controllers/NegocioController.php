<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\CategoriaServicio;
use Illuminate\Http\Request;

class NegocioController extends Controller
{
    public function showRegistro()
    {
        $categorias = Categoria::all();
        $categoriasServicio = CategoriaServicio::with('serviciosPredefinidos')->get();
        return view('negocios.registro', compact('categorias', 'categoriasServicio'));
    }

    public function guardar(Request $request)
    {
        dd($request->all());
    }
}

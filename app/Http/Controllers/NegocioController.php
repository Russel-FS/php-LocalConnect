<?php

namespace App\Http\Controllers;

use App\Models\Negocio\Categoria;
use App\Models\Negocio\CategoriaServicio;
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
        echo '<h2>Datos recibidos del formulario:</h2>';
        echo '<pre>';
        print_r($request->except(['_token']));
        echo '</pre>';

        if ($request->hasFile('imagen_portada')) {
            echo '<h3>Archivo imagen_portada:</h3>';
            print_r($request->file('imagen_portada')->getClientOriginalName());
        }
        exit;
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Negocio\CategoriaCaracteristica;
use Illuminate\Http\Request;

class AdminCategoriaCaracteristicaController extends Controller
{
    public function index()
    {
        $categoriasCaracteristica = CategoriaCaracteristica::orderBy('nombre_categoria')->paginate(20);
        return view('admin.categorias-caracteristica.index', compact('categoriasCaracteristica'));
    }

    public function create()
    {
        return view('admin.categorias-caracteristica.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_categoria' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'estado' => 'required|in:activo,inactivo',
        ]);
        CategoriaCaracteristica::create($request->only('nombre_categoria', 'descripcion', 'estado'));
        return redirect()->route('admin.categorias-caracteristica.index')->with('success', 'Categoría de característica creada correctamente.');
    }

    public function edit($id)
    {
        $categoriaCaracteristica = CategoriaCaracteristica::findOrFail($id);
        return view('admin.categorias-caracteristica.edit', compact('categoriaCaracteristica'));
    }

    public function update(Request $request, $id)
    {
        $categoriaCaracteristica = CategoriaCaracteristica::findOrFail($id);
        $request->validate([
            'nombre_categoria' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'estado' => 'required|in:activo,inactivo',
        ]);
        $categoriaCaracteristica->update($request->only('nombre_categoria', 'descripcion', 'estado'));
        return redirect()->route('admin.categorias-caracteristica.index')->with('success', 'Categoría de característica actualizada correctamente.');
    }

    public function destroy($id)
    {
        $categoriaCaracteristica = CategoriaCaracteristica::findOrFail($id);
        $categoriaCaracteristica->update(['estado' => 'inactivo']);
        return redirect()->route('admin.categorias-caracteristica.index')->with('success', 'Categoría de característica desactivada correctamente.');
    }

    public function activate($id)
    {
        $categoriaCaracteristica = CategoriaCaracteristica::findOrFail($id);
        $categoriaCaracteristica->update(['estado' => 'activo']);
        return redirect()->route('admin.categorias-caracteristica.index')->with('success', 'Categoría de característica activada correctamente.');
    }
}

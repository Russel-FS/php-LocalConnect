<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Negocio\Caracteristica;
use App\Models\Negocio\CategoriaCaracteristica;
use Illuminate\Http\Request;

class AdminCaracteristicaController extends Controller
{
    public function index()
    {
        $caracteristicas = Caracteristica::with('categoria')->orderBy('nombre')->paginate(20);
        return view('admin.caracteristicas.index', compact('caracteristicas'));
    }

    public function create()
    {
        $categoriasCaracteristica = CategoriaCaracteristica::where('estado', 'activo')->orderBy('nombre_categoria')->get();
        return view('admin.caracteristicas.create', compact('categoriasCaracteristica'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_categoria_caracteristica' => 'nullable|exists:categorias_caracteristica,id_categoria_caracteristica',
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'estado' => 'required|in:activo,inactivo',
        ]);
        Caracteristica::create($request->only('id_categoria_caracteristica', 'nombre', 'descripcion', 'estado'));
        return redirect()->route('admin.caracteristicas.index')->with('success', 'Característica creada correctamente.');
    }

    public function edit($id)
    {
        $caracteristica = Caracteristica::findOrFail($id);
        $categoriasCaracteristica = CategoriaCaracteristica::where('estado', 'activo')->orderBy('nombre_categoria')->get();
        return view('admin.caracteristicas.edit', compact('caracteristica', 'categoriasCaracteristica'));
    }

    public function update(Request $request, $id)
    {
        $caracteristica = Caracteristica::findOrFail($id);
        $request->validate([
            'id_categoria_caracteristica' => 'nullable|exists:categorias_caracteristica,id_categoria_caracteristica',
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'estado' => 'required|in:activo,inactivo',
        ]);
        $caracteristica->update($request->only('id_categoria_caracteristica', 'nombre', 'descripcion', 'estado'));
        return redirect()->route('admin.caracteristicas.index')->with('success', 'Característica actualizada correctamente.');
    }

    public function destroy($id)
    {
        $caracteristica = Caracteristica::findOrFail($id);
        $caracteristica->update(['estado' => 'inactivo']);
        return redirect()->route('admin.caracteristicas.index')->with('success', 'Característica desactivada correctamente.');
    }

    public function activate($id)
    {
        $caracteristica = Caracteristica::findOrFail($id);
        $caracteristica->update(['estado' => 'activo']);
        return redirect()->route('admin.caracteristicas.index')->with('success', 'Característica activada correctamente.');
    }
}

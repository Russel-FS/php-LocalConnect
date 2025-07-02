<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Negocio\ServicioPredefinido;
use App\Models\Negocio\CategoriaServicio;
use Illuminate\Http\Request;

class AdminServicioPredefinidoController extends Controller
{
    public function index()
    {
        $servicios = ServicioPredefinido::with('categoriaServicio')->orderBy('nombre_servicio')->paginate(20);
        return view('admin.servicios-predefinidos.index', compact('servicios'));
    }

    public function create()
    {
        $categoriasServicio = CategoriaServicio::where('estado', 'activo')->orderBy('nombre_categoria_servicio')->get();
        return view('admin.servicios-predefinidos.create', compact('categoriasServicio'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_categoria_servicio' => 'required|exists:categorias_servicio,id_categoria_servicio',
            'nombre_servicio' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
        ]);
        ServicioPredefinido::create($request->only('id_categoria_servicio', 'nombre_servicio', 'descripcion'));
        return redirect()->route('admin.servicios-predefinidos.index')->with('success', 'Servicio creado correctamente.');
    }

    public function edit($id)
    {
        $servicio = ServicioPredefinido::findOrFail($id);
        $categoriasServicio = CategoriaServicio::where('estado', 'activo')->orderBy('nombre_categoria_servicio')->get();
        return view('admin.servicios-predefinidos.edit', compact('servicio', 'categoriasServicio'));
    }

    public function update(Request $request, $id)
    {
        $servicio = ServicioPredefinido::findOrFail($id);
        $request->validate([
            'id_categoria_servicio' => 'required|exists:categorias_servicio,id_categoria_servicio',
            'nombre_servicio' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
        ]);
        $servicio->update($request->only('id_categoria_servicio', 'nombre_servicio', 'descripcion'));
        return redirect()->route('admin.servicios-predefinidos.index')->with('success', 'Servicio actualizado correctamente.');
    }

    public function destroy($id)
    {
        $servicio = ServicioPredefinido::findOrFail($id);
        $servicio->delete();
        return redirect()->route('admin.servicios-predefinidos.index')->with('success', 'Servicio eliminado correctamente.');
    }
}

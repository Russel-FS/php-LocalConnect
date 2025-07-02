<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Negocio\ServicioPredefinido;
use Illuminate\Http\Request;

class AdminServicioPredefinidoController extends Controller
{
    public function index()
    {
        $servicios = ServicioPredefinido::orderBy('nombre_servicio')->paginate(20);
        return view('admin.servicios-predefinidos.index', compact('servicios'));
    }

    public function create()
    {
        return view('admin.servicios-predefinidos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_servicio' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'estado' => 'required|in:activo,inactivo',
        ]);
        ServicioPredefinido::create($request->only('nombre_servicio', 'descripcion', 'estado'));
        return redirect()->route('admin.servicios-predefinidos.index')->with('success', 'Servicio creado correctamente.');
    }

    public function edit($id)
    {
        $servicio = ServicioPredefinido::findOrFail($id);
        return view('admin.servicios-predefinidos.edit', compact('servicio'));
    }

    public function update(Request $request, $id)
    {
        $servicio = ServicioPredefinido::findOrFail($id);
        $request->validate([
            'nombre_servicio' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'estado' => 'required|in:activo,inactivo',
        ]);
        $servicio->update($request->only('nombre_servicio', 'descripcion', 'estado'));
        return redirect()->route('admin.servicios-predefinidos.index')->with('success', 'Servicio actualizado correctamente.');
    }

    public function destroy($id)
    {
        $servicio = ServicioPredefinido::findOrFail($id);
        $servicio->delete();
        return redirect()->route('admin.servicios-predefinidos.index')->with('success', 'Servicio eliminado correctamente.');
    }
}

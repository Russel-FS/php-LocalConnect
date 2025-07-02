<?php

namespace App\Http\Controllers;

use App\Models\Negocio\Promocion;
use App\Models\Negocio\Negocio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class PromocionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Mostrar lista de promociones del usuario
     */
    public function index()
    {
        $promociones = Promocion::whereHas('negocio', function ($query) {
            $query->where('id_usuario', Auth::id());
        })->with('negocio')->orderBy('created_at', 'desc')->get();

        $negocios = Negocio::where('id_usuario', Auth::id())->get();

        return view('promociones.index', compact('promociones', 'negocios'));
    }

    /**
     * Mostrar formulario para crear promoción
     */
    public function create()
    {
        $negocios = Negocio::where('id_usuario', Auth::id())->get();

        if ($negocios->isEmpty()) {
            return redirect()->route('negocios.registro')
                ->with('error', 'Debes tener al menos un negocio registrado para crear promociones.');
        }

        return view('promociones.create', compact('negocios'));
    }

    /**
     * Guardar nueva promoción
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_negocio' => 'required|exists:negocios,id_negocio',
            'titulo' => 'required|string|max:100',
            'descripcion' => 'required|string|max:500',
            'descuento' => 'required|numeric|min:0|max:100',
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin' => 'required|date|after:fecha_inicio',
        ], [
            'id_negocio.required' => 'Debes seleccionar un negocio.',
            'id_negocio.exists' => 'El negocio seleccionado no existe.',
            'titulo.required' => 'El título es obligatorio.',
            'titulo.max' => 'El título no puede tener más de 100 caracteres.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.max' => 'La descripción no puede tener más de 500 caracteres.',
            'descuento.required' => 'El descuento es obligatorio.',
            'descuento.numeric' => 'El descuento debe ser un número.',
            'descuento.min' => 'El descuento no puede ser menor a 0%.',
            'descuento.max' => 'El descuento no puede ser mayor a 100%.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.after_or_equal' => 'La fecha de inicio debe ser hoy o una fecha futura.',
            'fecha_fin.required' => 'La fecha de fin es obligatoria.',
            'fecha_fin.after' => 'La fecha de fin debe ser posterior a la fecha de inicio.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // validacion de que el negocio pertenezca al usuario autenticado
        $negocio = Negocio::where('id_negocio', $request->id_negocio)
            ->where('id_usuario', Auth::id())
            ->first();

        if (!$negocio) {
            return redirect()->back()
                ->with('error', 'No tienes permisos para crear promociones en este negocio.')
                ->withInput();
        }

        $promocion = Promocion::create([
            'id_negocio' => $request->id_negocio,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'descuento' => $request->descuento,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'activa' => true,
        ]);

        return redirect()->route('promociones.index')
            ->with('success', 'Promoción creada exitosamente.');
    }

    /**
     * Mostrar promoción específica
     */
    public function show($id)
    {
        $promocion = Promocion::with('negocio')
            ->whereHas('negocio', function ($query) {
                $query->where('id_usuario', Auth::id());
            })
            ->findOrFail($id);

        return view('promociones.show', compact('promocion'));
    }

    /**
     * Mostrar formulario para editar promoción
     */
    public function edit($id)
    {
        $promocion = Promocion::with('negocio')
            ->whereHas('negocio', function ($query) {
                $query->where('id_usuario', Auth::id());
            })
            ->findOrFail($id);

        $negocios = Negocio::where('id_usuario', Auth::id())->get();

        return view('promociones.edit', compact('promocion', 'negocios'));
    }

    /**
     * Actualizar promoción
     */
    public function update(Request $request, $id)
    {
        $promocion = Promocion::with('negocio')
            ->whereHas('negocio', function ($query) {
                $query->where('id_usuario', Auth::id());
            })
            ->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'id_negocio' => 'required|exists:negocios,id_negocio',
            'titulo' => 'required|string|max:100',
            'descripcion' => 'required|string|max:500',
            'descuento' => 'required|numeric|min:0|max:100',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
        ], [
            'id_negocio.required' => 'Debes seleccionar un negocio.',
            'id_negocio.exists' => 'El negocio seleccionado no existe.',
            'titulo.required' => 'El título es obligatorio.',
            'titulo.max' => 'El título no puede tener más de 100 caracteres.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.max' => 'La descripción no puede tener más de 500 caracteres.',
            'descuento.required' => 'El descuento es obligatorio.',
            'descuento.numeric' => 'El descuento debe ser un número.',
            'descuento.min' => 'El descuento no puede ser menor a 0%.',
            'descuento.max' => 'El descuento no puede ser mayor a 100%.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_fin.required' => 'La fecha de fin es obligatoria.',
            'fecha_fin.after' => 'La fecha de fin debe ser posterior a la fecha de inicio.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Verificar que el negocio pertenece al usuario
        $negocio = Negocio::where('id_negocio', $request->id_negocio)
            ->where('id_usuario', Auth::id())
            ->first();

        if (!$negocio) {
            return redirect()->back()
                ->with('error', 'No tienes permisos para editar promociones en este negocio.')
                ->withInput();
        }

        $promocion->update([
            'id_negocio' => $request->id_negocio,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'descuento' => $request->descuento,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
        ]);

        return redirect()->route('promociones.index')
            ->with('success', 'Promoción actualizada exitosamente.');
    }

    /**
     * Eliminar promoción
     */
    public function destroy($id)
    {
        $promocion = Promocion::with('negocio')
            ->whereHas('negocio', function ($query) {
                $query->where('id_usuario', Auth::id());
            })
            ->findOrFail($id);

        $promocion->delete();

        return redirect()->route('promociones.index')
            ->with('success', 'Promoción eliminada exitosamente.');
    }

    /**
     * Activar-desactivar promociond
     */
    public function toggleStatus($id)
    {
        $promocion = Promocion::with('negocio')
            ->whereHas('negocio', function ($query) {
                $query->where('id_usuario', Auth::id());
            })
            ->findOrFail($id);

        $promocion->update(['activa' => !$promocion->activa]);

        $status = $promocion->activa ? 'activada' : 'desactivada';

        return redirect()->route('promociones.index')
            ->with('success', "Promoción {$status} exitosamente.");
    }
}

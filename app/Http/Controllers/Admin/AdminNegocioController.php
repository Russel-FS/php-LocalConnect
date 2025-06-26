<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Negocio\Negocio;
use Illuminate\Http\Request;

class AdminNegocioController extends Controller
{
    /**
     * Muestra la lista de negocios pendientes de aprobación.
     */
    public function index()
    {
        $negocios = Negocio::where('verificado', 0)
            ->with('usuario', 'ubicacion', 'horarios', 'categorias', 'contactos', 'caracteristicas')
            ->get();
        return view('admin.solicitudes', compact('negocios'));
    }

    /**
     * Muestra los detalles completos de un negocio.
     */
    public function show(Negocio $negocio)
    {
        $negocio->load('usuario', 'ubicacion', 'horarios', 'categorias', 'contactos', 'caracteristicas', 'serviciosPersonalizados', 'serviciosPredefinidos');
        return view('admin.negocios.show', compact('negocio'));
    }

    /**
     * Actualiza el estado de un negocio (aprobar o rechazar).
     */
    public function update(Request $request, Negocio $negocio)
    {
        $request->validate([
            'estado' => 'required|boolean',
        ]);

        $negocio->verificado = $request->estado;
        $negocio->save();

        return back()->with('success', 'El estado del negocio ha sido actualizado.');
    }
}

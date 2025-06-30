<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Negocio\Negocio;
use Illuminate\Http\Request;

class AdminNegocioPanelController extends Controller
{
    /**
     * Muestra un listado general de todos los negocios  
     */
    public function index(Request $request)
    {
        $query = Negocio::with(['usuario', 'ubicacion', 'categorias'])
            ->orderByDesc('created_at');

        // Filtros opcionales
        if ($request->filled('estado')) {
            if ($request->estado === 'aprobado') {
                $query->where('verificado', 1);
            } elseif ($request->estado === 'pendiente') {
                $query->where('verificado', 0);
            }
        }

        $negocios = $query->paginate(15);
        return view('admin.negocios.index', compact('negocios'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Negocio\Categoria;
use App\Models\Negocio\Caracteristica;
use App\Models\Negocio\ServicioPredefinido;
use App\Models\Negocio\Negocio;
use App\Services\NegocioService;
use Illuminate\Http\Request;
use Exception;

class NegocioPublicoController extends Controller
{
    protected $negocioService;

    public function __construct(NegocioService $negocioService)
    {
        $this->negocioService = $negocioService;
    }

    /**
     * Buscar negocios con filtros (público)
     */
    public function buscar(Request $request)
    {
        $query = Negocio::with([
            'categorias',
            'caracteristicas',
            'serviciosPredefinidos',
            'serviciosPersonalizados',
            'ubicacion',
            'valoraciones',
        ]);

        // Búsqueda por texto
        if ($request->filled('q')) {
            $searchTerm = $request->q;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('negocios.nombre_negocio', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('negocios.descripcion', 'LIKE', "%{$searchTerm}%")
                    ->orWhereHas('categorias', function ($q) use ($searchTerm) {
                        $q->where('categorias.nombre_categoria', 'LIKE', "%{$searchTerm}%");
                    })
                    ->orWhereHas('serviciosPredefinidos', function ($q) use ($searchTerm) {
                        $q->where('servicios_predefinidos.nombre_servicio', 'LIKE', "%{$searchTerm}%");
                    })
                    ->orWhereHas('serviciosPersonalizados', function ($q) use ($searchTerm) {
                        $q->where('servicios_personalizados.nombre_servicio', 'LIKE', "%{$searchTerm}%");
                    });
            });
        }

        // Filtro por categorías
        if ($request->filled('categorias')) {
            $query->whereHas('categorias', function ($q) use ($request) {
                $q->whereIn('categorias.id_categoria', $request->categorias);
            });
        }

        // Filtro por características
        if ($request->filled('caracteristicas')) {
            $query->whereHas('caracteristicas', function ($q) use ($request) {
                $q->whereIn('caracteristicas.id_caracteristica', $request->caracteristicas);
            });
        }

        // Filtro por servicios predefinidos
        if ($request->filled('servicios')) {
            $query->whereHas('serviciosPredefinidos', function ($q) use ($request) {
                $q->whereIn('servicios_predefinidos.id_servicio_predefinido', $request->servicios);
            });
        }

        // Solo negocios verificados
        $query->where('negocios.verificado', true);

        // Obtener datos para filtros
        $categorias = Categoria::where('estado', 'activo')->get();
        $caracteristicas = Caracteristica::where('estado', 'activo')->get();
        $serviciosPredefinidos = ServicioPredefinido::all();

        // Paginar resultados
        $negocios = $query->paginate(15);

        // Incrementar vistas de búsqueda para cada negocio en los resultados
        foreach ($negocios as $negocio) {
            $this->negocioService->incrementarVistaBusqueda($negocio->id_negocio);
        }

        return view('negocios.buscar', compact('negocios', 'categorias', 'caracteristicas', 'serviciosPredefinidos'));
    }

    public function sugerencias(Request $request)
    {
        $q = $request->q;
        $sugerencias = [];

        // Negocios
        $negocios = Negocio::with(['ubicacion', 'valoraciones'])
            ->where(function ($query) use ($q) {
                $query->where('nombre_negocio', 'LIKE', "%$q%")
                    ->orWhere('descripcion', 'LIKE', "%$q%");
            })
            ->limit(5)
            ->get()
            ->map(function ($n) {
                $n->tipo = 'negocio';
                return $n;
            });

        // Categorías
        $categorias = Categoria::where('nombre_categoria', 'LIKE', "%$q%")
            ->where('estado', 'activo')
            ->limit(5)
            ->get()
            ->map(function ($c) {
                return [
                    'id_categoria' => $c->id_categoria,
                    'nombre_categoria' => $c->nombre_categoria,
                    'tipo' => 'categoria',
                ];
            });

        // Características
        $caracteristicas = Caracteristica::where('nombre', 'LIKE', "%$q%")
            ->where('estado', 'activo')
            ->limit(5)
            ->get()
            ->map(function ($c) {
                return [
                    'id_caracteristica' => $c->id_caracteristica,
                    'nombre' => $c->nombre,
                    'tipo' => 'caracteristica',
                ];
            });

        // Servicios predefinidoss
        $servicios = ServicioPredefinido::where('nombre_servicio', 'LIKE', "%$q%")
            ->limit(5)
            ->get()
            ->map(function ($s) {
                return [
                    'id_servicio_predefinido' => $s->id_servicio_predefinido,
                    'nombre_servicio' => $s->nombre_servicio,
                    'tipo' => 'servicio',
                ];
            });

        // Unir todas las sugerencias
        $sugerencias = $negocios->toArray();
        $sugerencias = array_merge($sugerencias, $categorias->toArray(), $caracteristicas->toArray(), $servicios->toArray());

        return response()->json($sugerencias);
    }

    /**
     * Mostrar detalles de un negocio específico 
     */
    public function mostrar($id)
    {
        try {
            $negocio = $this->negocioService->obtenerNegocio($id);
            // Incrementar vista de detalle
            $this->negocioService->incrementarVistaDetalle($id);
            return view('negocios.detalle', compact('negocio'));
        } catch (Exception $e) {
            return back()->with('error', 'Negocio no encontrado.');
        }
    }

    /**
     * Sugerencias de negocios para la página de búsqueda
     */
    public function sugerenciasBusqueda(Request $request)
    {
        $q = $request->q;
        $negocios = Negocio::with(['ubicacion', 'valoraciones'])
            ->where(function ($query) use ($q) {
                $query->where('nombre_negocio', 'LIKE', "%$q%")
                    ->orWhere('descripcion', 'LIKE', "%$q%");
            })
            ->limit(8)
            ->get()
            ->map(function ($n) {
                $n->tipo = 'negocio';
                return $n;
            });
        return response()->json($negocios);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Negocio\Categoria;
use App\Models\Negocio\CategoriaServicio;
use App\Models\Negocio\CategoriaCaracteristica;
use App\Services\NegocioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use App\Models\Negocio\Negocio;
use App\Models\Negocio\Caracteristica;
use App\Models\Negocio\ServicioPredefinido;

class NegocioController extends Controller
{
    protected $negocioService;

    public function __construct(NegocioService $negocioService)
    {
        $this->negocioService = $negocioService;
    }

    public function showRegistro()
    {
        $categorias = Categoria::all();
        $categoriasServicio = CategoriaServicio::with('serviciosPredefinidos')->get();
        $categoriasCaracteristica = CategoriaCaracteristica::with('caracteristicas')->get();
        return view('negocios.registro', compact('categorias', 'categoriasServicio', 'categoriasCaracteristica'));
    }

    public function guardar(Request $request)
    {
        Log::info('Inicio de registro de negocio. Datos recibidos:', $request->all());

        try {
            // Verificar que el usuario esté autenticado
            if (!Auth::check()) {
                Log::warning('Intento de registro de negocio sin autenticación.');
                return redirect()->route('login')->with('error', 'Debe iniciar sesión para registrar un negocio.');
            }

            $userId = Auth::id();

            // Registrar el negocio usando el servicio
            $negocio = $this->negocioService->registrarNegocio($request->all(), $userId);

            Log::info('Negocio registrado exitosamente.', ['negocio_id' => $negocio->id_negocio]);
            return redirect()->route('home')->with('success', '¡Negocio registrado exitosamente! Pronto será verificado por nuestro equipo.');
        } catch (ValidationException $e) {
            Log::error('Error de validación al registrar negocio.', [
                'errors' => $e->errors(),
                'request_data' => $request->all()
            ]);
            return back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            Log::error('Excepción general al registrar negocio.', [
                'message' => $e->getMessage(),
                'request_data' => $request->all()
            ]);
            return back()->with('error', 'Error al registrar el negocio: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Mostrar lista de negocios del usuario
     */
    public function misNegocios()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $negocios = $this->negocioService->obtenerNegociosUsuario(Auth::id());
        return view('negocios.mis-negocios', compact('negocios'));
    }

    /**
     * Mostrar detalles de un negocio específico
     */
    public function mostrarNegocio($id)
    {
        try {
            $negocio = $this->negocioService->obtenerNegocio($id);
            return view('negocios.detalle', compact('negocio'));
        } catch (Exception $e) {
            return back()->with('error', 'Negocio no encontrado.');
        }
    }

    /**
     * Buscar negocios con filtros
     */
    public function buscar(Request $request)
    {
        $query = Negocio::with([
            'categorias',
            'caracteristicas',
            'serviciosPredefinidos',
            'serviciosPersonalizados',
            'ubicacion'
        ]);

        // Búsqueda por texto
        if ($request->filled('q')) {
            $searchTerm = $request->q;
            $query->where(function ($q) use ($searchTerm) {

                $q->where('nombre_negocio', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('descripcion', 'LIKE', "%{$searchTerm}%")
                    ->orWhereHas('categorias', function ($q) use ($searchTerm) {
                        $q->where('nombre_categoria', 'LIKE', "%{$searchTerm}%");
                    })
                    ->orWhereHas('serviciosPredefinidos', function ($q) use ($searchTerm) {
                        $q->where('nombre_servicio', 'LIKE', "%{$searchTerm}%");
                    })
                    ->orWhereHas('serviciosPersonalizados', function ($q) use ($searchTerm) {
                        $q->where('nombre_servicio', 'LIKE', "%{$searchTerm}%");
                    });
            });
        }

        // Filtro por categorías
        if ($request->filled('categorias')) {
            $query->whereHas('categorias', function ($q) use ($request) {
                $q->whereIn('id_categoria', $request->categorias);
            });
        }

        // Filtro por características
        if ($request->filled('caracteristicas')) {
            $query->whereHas('caracteristicas', function ($q) use ($request) {
                $q->whereIn('id_caracteristica', $request->caracteristicas);
            });
        }

        // Filtro por servicios predefinidos
        if ($request->filled('servicios')) {
            $query->whereHas('serviciosPredefinidos', function ($q) use ($request) {
                $q->whereIn('id_servicio_predefinido', $request->servicios);
            });
        }

        // Siempre filtrar solo negocios verificados
        $query->where('verificado', true);

        // Obtener datos para filtros
        $categorias = Categoria::where('estado', 'activo')->get();
        $caracteristicas = Caracteristica::where('estado', 'activo')->get();
        $serviciosPredefinidos = ServicioPredefinido::all();

        // Paginar resultados
        $negocios = $query->paginate(12);

        return view('negocios.buscar', compact('negocios', 'categorias', 'caracteristicas', 'serviciosPredefinidos'));
    }
}

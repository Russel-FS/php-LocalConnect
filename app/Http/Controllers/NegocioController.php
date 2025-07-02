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
use App\Models\Negocio\Valoracion;
use Carbon\Carbon;
use App\Exports\NegocioEstadisticasExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

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
            $data = $request->all();
            $data['imagen_portada'] = $request->file('imagen_portada');
            $negocio = $this->negocioService->registrarNegocio($data, $userId);

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

            // Incrementar vista de detalle
            $this->negocioService->incrementarVistaDetalle($id);

            return view('negocios.detalle', compact('negocio'));
        } catch (Exception $e) {
            return back()->with('error', 'Negocio no encontrado.');
        }
    }

    public function editar($id)
    {
        $negocio = Negocio::with(['ubicacion', 'categorias', 'caracteristicas', 'horarios', 'serviciosPredefinidos', 'serviciosPersonalizados'])->findOrFail($id);
        $categorias = Categoria::all();
        $caracteristicas = Caracteristica::all();
        $horarios = $negocio->horarios;
        $categoriasServicio = CategoriaServicio::with('serviciosPredefinidos')->get();

        if ($negocio->id_usuario !== Auth::id()) {
            abort(403);
        }
        return view('negocios.editar', compact('negocio', 'categorias', 'caracteristicas', 'horarios', 'categoriasServicio'));
    }

    public function actualizar(Request $request, $id)
    {
        $negocio =  Negocio::with('ubicacion')->findOrFail($id);

        if ($negocio->id_usuario !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'nombre_negocio' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:500',
            'imagen_portada' => 'nullable|image|max:2048',
            'direccion' => 'nullable|string|max:255',
            'distrito' => 'nullable|string|max:100',
            'ciudad' => 'nullable|string|max:100',
            'provincia' => 'nullable|string|max:100',
            'departamento' => 'nullable|string|max:100',
            'pais' => 'nullable|string|max:100',
            'latitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',
            'categorias' => 'array',
            'caracteristicas' => 'array',
            // Validación de horarios
            'horarios' => 'required|array|size:7',
            'horarios.*.cerrado' => 'required|in:0,1',
            'horarios.*.hora_apertura' => 'nullable|date_format:H:i',
            'horarios.*.hora_cierre' => 'nullable|date_format:H:i',
            'horarios.*.dia_semana' => 'required|string',
        ]);

        // Validación adicional para horarios
        foreach ($validated['horarios'] as $index => $horario) {
            if (!$horario['cerrado']) {
                if (empty($horario['hora_apertura']) || empty($horario['hora_cierre'])) {
                    throw ValidationException::withMessages([
                        "horarios.{$index}.hora_apertura" => 'La hora de apertura es requerida cuando el día está abierto.',
                        "horarios.{$index}.hora_cierre" => 'La hora de cierre es requerida cuando el día está abierto.'
                    ]);
                }

                if ($horario['hora_apertura'] >= $horario['hora_cierre']) {
                    throw ValidationException::withMessages([
                        "horarios.{$index}.hora_cierre" => 'La hora de cierre debe ser mayor que la hora de apertura.'
                    ]);
                }
            }
        }

        // Pasar los horarios explícitamente al servicio
        $this->negocioService->actualizarNegocio($negocio, $validated, $request, $request->input('horarios'));

        return redirect()->route('negocios.mis-negocios')->with('success', '¡Negocio actualizado correctamente!');
    }

    public function comentarNegocio(Request $request, $id)
    {
        $request->validate([
            'calificacion' => 'required|integer|min:1|max:5',
            'comentario' => 'required|string|max:1000',
        ]);

        $user = Auth::user();
        $negocio = Negocio::findOrFail($id);

        // Solo una valoración por usuario-negocio
        $yaComentado = Valoracion::where('id_usuario', $user->id_usuario)->where('id_negocio', $id)->first();
        if ($yaComentado) {
            return back()->with('error', 'Ya has dejado un comentario para este negocio.');
        }

        Valoracion::create([
            'id_usuario' => $user->id_usuario,
            'id_negocio' => $id,
            'calificacion' => $request->calificacion,
            'comentario' => $request->comentario,
            'fecha_valoracion' => now(),
        ]);

        return back()->with('success', '¡Gracias por tu comentario!');
    }

    public function editarComentario(Request $request, $id)
    {
        $request->validate([
            'calificacion' => 'required|integer|min:1|max:5',
            'comentario' => 'required|string|max:1000',
        ]);

        $user = Auth::user();
        $valoracion = Valoracion::findOrFail($id);

        // Verificar que el usuario sea el propietario del comentario
        if ($valoracion->id_usuario !== $user->id_usuario) {
            abort(403, 'No tienes permisos para editar este comentario.');
        }

        $valoracion->update([
            'calificacion' => $request->calificacion,
            'comentario' => $request->comentario,
            'fecha_actualizacion' => now(),
        ]);

        return back()->with('success', '¡Comentario actualizado correctamente!');
    }

    /**
     * Mostrar estadísticas de un negocio
     */
    public function estadisticas($id)
    {
        $negocio = Negocio::findOrFail($id);

        // Verificar que el usuario sea el propietario del negocio
        if ($negocio->id_usuario !== Auth::id()) {
            abort(403, 'No tienes permisos para ver las estadísticas de este negocio.');
        }

        // Calcular totales dinámicamente de datos de negocio
        $estadisticas = [
            'vistas_busqueda' => $negocio->vistas()->where('tipo_vista', 'busqueda')->count(),
            'vistas_detalle' => $negocio->vistas()->where('tipo_vista', 'detalle')->count(),
            'me_gusta' => $negocio->meGusta()->count(),
            'favoritos' => $negocio->favoritos()->count(),
        ];

        // cambios durante los ultimos 14 diass dio tengo sueñññññññññññño revision de codigo n42
        $dias = collect(range(0, 13))->map(function ($i) {
            return now()->subDays(13 - $i)->format('Y-m-d');
        });

        // vistas por dia (detalle)
        $vistasPorDia = $negocio->vistas()
            ->where('tipo_vista', 'detalle')
            ->whereBetween('created_at', [now()->subDays(13)->startOfDay(), now()->endOfDay()])
            ->selectRaw('DATE(created_at) as fecha, COUNT(*) as total')
            ->groupBy('fecha')
            ->pluck('total', 'fecha');

        // vistas por dia (busqueda)
        $vistasBusquedaPorDia = $negocio->vistas()
            ->where('tipo_vista', 'busqueda')
            ->whereBetween('created_at', [now()->subDays(13)->startOfDay(), now()->endOfDay()])
            ->selectRaw('DATE(created_at) as fecha, COUNT(*) as total')
            ->groupBy('fecha')
            ->pluck('total', 'fecha');

        // me gustas por dia
        $meGustaPorDia = $negocio->meGusta()
            ->whereBetween('created_at', [now()->subDays(13)->startOfDay(), now()->endOfDay()])
            ->selectRaw('DATE(created_at) as fecha, COUNT(*) as total')
            ->groupBy('fecha')
            ->pluck('total', 'fecha');

        // etiquetas para el graficoooooooooo
        $labels = $dias->map(function ($fecha) {
            return Carbon::parse($fecha)->isoFormat('D MMM');
        });
        // vsitas acorde fechas
        $vistas = $dias->map(fn($fecha) => $vistasPorDia[$fecha] ?? 0);
        $vistasBusqueda = $dias->map(fn($fecha) => $vistasBusquedaPorDia[$fecha] ?? 0);
        $meGusta = $dias->map(fn($fecha) => $meGustaPorDia[$fecha] ?? 0);

        // Asegurar arrays válidos para la vista
        $labelsArray = $labels ? $labels->toArray() : ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'];
        $vistasArray = $vistas ? $vistas->toArray() : [0, 0, 0, 0, 0, 0, 0];
        $vistasBusquedaArray = $vistasBusqueda ? $vistasBusqueda->toArray() : [0, 0, 0, 0, 0, 0, 0];
        $meGustaArray = $meGusta ? $meGusta->toArray() : [0, 0, 0, 0, 0, 0, 0];

        return view('negocios.estadisticas', [
            'negocio' => $negocio,
            'estadisticas' => $estadisticas,
            'labels' => $labelsArray,
            'vistas' => $vistasArray,
            'vistasBusqueda' => $vistasBusquedaArray,
            'meGusta' => $meGustaArray,
        ]);
    }

    public function eliminarComentario($id)
    {
        $user = Auth::user();
        $valoracion = Valoracion::findOrFail($id);

        // verificar el usaurio para eliminar si es dueño del comentario
        if ($valoracion->id_usuario !== $user->id_usuario) {
            abort(403, 'No tienes permisos para eliminar este comentario.');
        }

        $valoracion->delete();

        return back()->with('success', '¡Comentario eliminado correctamente!');
    }

    /**
     * Visualización interna del dueño del negocio (no cuenta como vista pública)
     */
    public function verPropioNegocio($id)
    {
        $negocio = $this->negocioService->obtenerNegocio($id);

        // Verificar que el usuario sea el propietario del negocio
        if ($negocio->id_usuario !== Auth::id()) {
            abort(403, 'No tienes permisos para ver este negocio.');
        }

        return view('negocios.detalle', compact('negocio'));
    }

    public function estadisticasPDF($id)
    {
        $negocio = Negocio::findOrFail($id);

        // validacion de propietario
        if ($negocio->id_usuario !== auth::id()) {
            abort(403, 'No tienes permisos para exportar las estadísticas de este negocio.');
        }

        // calcular totales
        $estadisticas = [
            'vistas_busqueda' => $negocio->vistas()->where('tipo_vista', 'busqueda')->count(),
            'vistas_detalle' => $negocio->vistas()->where('tipo_vista', 'detalle')->count(),
            'me_gusta' => $negocio->meGusta()->count(),
            'favoritos' => $negocio->favoritos()->count(),
        ];

        $dias = collect(range(0, 13))->map(function ($i) {
            return now()->subDays(13 - $i)->format('Y-m-d');
        });
        $vistasPorDia = $negocio->vistas()
            ->where('tipo_vista', 'detalle')
            ->whereBetween('created_at', [now()->subDays(13)->startOfDay(), now()->endOfDay()])
            ->selectRaw('DATE(created_at) as fecha, COUNT(*) as total')
            ->groupBy('fecha')
            ->pluck('total', 'fecha');
        $vistasBusquedaPorDia = $negocio->vistas()
            ->where('tipo_vista', 'busqueda')
            ->whereBetween('created_at', [now()->subDays(13)->startOfDay(), now()->endOfDay()])
            ->selectRaw('DATE(created_at) as fecha, COUNT(*) as total')
            ->groupBy('fecha')
            ->pluck('total', 'fecha');
        $meGustaPorDia = $negocio->meGusta()
            ->whereBetween('created_at', [now()->subDays(13)->startOfDay(), now()->endOfDay()])
            ->selectRaw('DATE(created_at) as fecha, COUNT(*) as total')
            ->groupBy('fecha')
            ->pluck('total', 'fecha');
        $labels = $dias->map(function ($fecha) {
            return Carbon::parse($fecha)->isoFormat('D MMM');
        });
        $vistas = $dias->map(fn($fecha) => $vistasPorDia[$fecha] ?? 0);
        $vistasBusqueda = $dias->map(fn($fecha) => $vistasBusquedaPorDia[$fecha] ?? 0);
        $meGusta = $dias->map(fn($fecha) => $meGustaPorDia[$fecha] ?? 0);

        $data = [
            'negocio' => $negocio,
            'estadisticas' => $estadisticas,
            'labels' => $labels->toArray(),
            'vistas' => $vistas->toArray(),
            'vistasBusqueda' => $vistasBusqueda->toArray(),
            'meGusta' => $meGusta->toArray(),
            'fecha' => now()->format('d/m/Y H:i'),
        ];

        $pdf =  Pdf::loadView('negocios.estadisticas-pdf', $data);
        return $pdf->download('estadisticas-negocio-' . $negocio->id_negocio . '-' . now()->format('Y-m-d') . '.pdf');
    }

    public function estadisticasExcel($id)
    {
        $negocio = Negocio::findOrFail($id);

        // validacion de propietario
        if ($negocio->id_usuario !== auth::id()) {
            abort(403, 'No tienes permisos para exportar las estadísticas de este negocio.');
        }

        // calcular evolución últimos 14 días
        $dias = collect(range(0, 13))->map(function ($i) {
            return now()->subDays(13 - $i)->format('Y-m-d');
        });
        $vistasPorDia = $negocio->vistas()
            ->where('tipo_vista', 'detalle')
            ->whereBetween('created_at', [now()->subDays(13)->startOfDay(), now()->endOfDay()])
            ->selectRaw('DATE(created_at) as fecha, COUNT(*) as total')
            ->groupBy('fecha')
            ->pluck('total', 'fecha');
        $vistasBusquedaPorDia = $negocio->vistas()
            ->where('tipo_vista', 'busqueda')
            ->whereBetween('created_at', [now()->subDays(13)->startOfDay(), now()->endOfDay()])
            ->selectRaw('DATE(created_at) as fecha, COUNT(*) as total')
            ->groupBy('fecha')
            ->pluck('total', 'fecha');
        $meGustaPorDia = $negocio->meGusta()
            ->whereBetween('created_at', [now()->subDays(13)->startOfDay(), now()->endOfDay()])
            ->selectRaw('DATE(created_at) as fecha, COUNT(*) as total')
            ->groupBy('fecha')
            ->pluck('total', 'fecha');
        $labels = $dias->map(function ($fecha) {
            return Carbon::parse($fecha)->isoFormat('D MMM');
        });
        $vistas = $dias->map(fn($fecha) => $vistasPorDia[$fecha] ?? 0);
        $vistasBusqueda = $dias->map(fn($fecha) => $vistasBusquedaPorDia[$fecha] ?? 0);
        $meGusta = $dias->map(fn($fecha) => $meGustaPorDia[$fecha] ?? 0);

        // resumen: suma de los últimos 14 días
        $estadisticas = [
            'vistas_busqueda' => $vistasBusqueda->sum(),
            'vistas_detalle' => $vistas->sum(),
            'me_gusta' => $meGusta->sum(),
            'favoritos' => $negocio->favoritos()->count(),
            'promedio_valoracion' => $negocio->valoraciones->avg('calificacion') ?? 0,
            'total_valoraciones' => $negocio->valoraciones->count() ?? 0,
            'labels' => $labels->toArray(),
            'vistas' => $vistas->toArray(),
            'vistasBusqueda' => $vistasBusqueda->toArray(),
            'meGusta' => $meGusta->toArray(),
        ];

        return Excel::download(new NegocioEstadisticasExport($negocio, $estadisticas), 'estadisticas_negocio.xlsx');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Negocio\Categoria;
use App\Models\Negocio\CategoriaServicio;
use App\Services\NegocioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

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
        return view('negocios.registro', compact('categorias', 'categoriasServicio'));
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
}

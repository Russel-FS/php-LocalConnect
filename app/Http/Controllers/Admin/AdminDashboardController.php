<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Negocio\Negocio;
use App\Models\User;
use App\Models\Negocio\Categoria;
use App\Models\Negocio\NegocioVista;
use App\Models\Negocio\MeGusta;
use App\Models\Negocio\Favorito;
use App\Models\Negocio\Valoracion;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // datos basicos
        $totalNegocios = Negocio::count();
        $negociosPendientes = Negocio::where('verificado', 0)->count();
        $totalUsuarios = User::count();
        $totalCategorias = Categoria::count();
        $ultimasSolicitudes = Negocio::where('verificado', 0)->orderByDesc('created_at')->take(5)->get();

        // interacciones
        $totalVistas = NegocioVista::count();
        $totalMeGusta = MeGusta::count();
        $totalFavoritos = Favorito::count();
        $totalValoraciones = Valoracion::count();

        // evolucion ultimo 30 dias.
        $dias = collect(range(0, 29))->map(function ($i) {
            return now()->subDays(29 - $i)->format('Y-m-d');
        });

        // Negocios creados por día
        $negociosPorDia = Negocio::whereBetween('created_at', [
            now()->subDays(29)->startOfDay(),
            now()->endOfDay()
        ])
            ->selectRaw('DATE(created_at) as fecha, COUNT(*) as total')
            ->groupBy('fecha')
            ->pluck('total', 'fecha');

        // Usuarios registrados por día
        $usuariosPorDia = User::whereBetween('created_at', [
            now()->subDays(29)->startOfDay(),
            now()->endOfDay()
        ])
            ->selectRaw('DATE(created_at) as fecha, COUNT(*) as total')
            ->groupBy('fecha')
            ->pluck('total', 'fecha');

        // Interacciones por día
        $vistasPorDia = NegocioVista::whereBetween('created_at', [
            now()->subDays(29)->startOfDay(),
            now()->endOfDay()
        ])
            ->selectRaw('DATE(created_at) as fecha, COUNT(*) as total')
            ->groupBy('fecha')
            ->pluck('total', 'fecha');

        // Me gusta por día
        $meGustaPorDia = MeGusta::whereBetween('created_at', [
            now()->subDays(29)->startOfDay(),
            now()->endOfDay()
        ])
            ->selectRaw('DATE(created_at) as fecha, COUNT(*) as total')
            ->groupBy('fecha')
            ->pluck('total', 'fecha');

        // etiqueta de fechas
        $labels = $dias->map(function ($fecha) {
            return Carbon::parse($fecha)->isoFormat('D MMM');
        });

        // metricas
        $negociosArray = $dias->map(fn($fecha) => $negociosPorDia[$fecha] ?? 0);
        $usuariosArray = $dias->map(fn($fecha) => $usuariosPorDia[$fecha] ?? 0);
        $vistasArray = $dias->map(fn($fecha) => $vistasPorDia[$fecha] ?? 0);
        $meGustaArray = $dias->map(fn($fecha) => $meGustaPorDia[$fecha] ?? 0);

        // categorias tops
        $topCategorias = Categoria::withCount('negocios')
            ->orderByDesc('negocios_count')
            ->take(5)
            ->get();

        // negocios mas populares
        $negociosPopulares = Negocio::withCount(['vistas', 'meGusta', 'favoritos'])
            ->orderByDesc('vistas_count')
            ->take(5)
            ->get();

        // estdos de negocios
        $estadosNegocios = [
            'Aprobados' => Negocio::where('verificado', 1)->count(),
            'Pendientes' => Negocio::where('verificado', 0)->count(),
        ];

        return view('admin.dashboard', compact(
            'totalNegocios',
            'negociosPendientes',
            'totalUsuarios',
            'totalCategorias',
            'ultimasSolicitudes',
            'totalVistas',
            'totalMeGusta',
            'totalFavoritos',
            'totalValoraciones',
            'labels',
            'negociosArray',
            'usuariosArray',
            'vistasArray',
            'meGustaArray',
            'topCategorias',
            'negociosPopulares',
            'estadosNegocios'
        ));
    }
}

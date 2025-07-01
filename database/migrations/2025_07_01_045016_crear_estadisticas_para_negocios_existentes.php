<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Obtener todos los negocios que no tienen estadísticas
        $negociosSinEstadisticas = DB::table('negocios')
            ->leftJoin('negocio_estadisticas', 'negocios.id_negocio', '=', 'negocio_estadisticas.id_negocio')
            ->whereNull('negocio_estadisticas.id_negocio')
            ->select('negocios.id_negocio')
            ->get();

        // Crear estadísticas para cada negocio que no las tenga
        foreach ($negociosSinEstadisticas as $negocio) {
            DB::table('negocio_estadisticas')->insert([
                'id_negocio' => $negocio->id_negocio,
                'vistas_busqueda' => 0,
                'vistas_detalle' => 0,
                'me_gusta' => 0,
                'favoritos' => 0,
                'actualizado_en' => now()
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No es necesario hacer nada en el down ya que solo estamos insertando datos
        // que se pueden recrear automáticamente
    }
};

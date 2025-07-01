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
        $negociosSinEstadisticas = DB::table('negocios')
            ->leftJoin('negocio_estadisticas', 'negocios.id_negocio', '=', 'negocio_estadisticas.id_negocio')
            ->whereNull('negocio_estadisticas.id_negocio')
            ->select('negocios.id_negocio')
            ->get();

        foreach ($negociosSinEstadisticas as $negocio) {
            DB::table('negocio_estadisticas')->insert([
                'id_negocio' => $negocio->id_negocio,
                'vistas_busqueda' => 0,
                'vistas_detalle' => 0,
                'actualizado_en' => now()
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('negocios');
    }
};

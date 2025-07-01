<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('negocio_estadisticas', function (Blueprint $table) {
            $table->id('id_estadistica');
            $table->unsignedBigInteger('id_negocio');
            $table->integer('vistas_busqueda')->default(0);
            $table->integer('vistas_detalle')->default(0);
            $table->integer('me_gusta')->default(0);
            $table->integer('favoritos')->default(0);
            $table->timestamp('actualizado_en')->useCurrent()->useCurrentOnUpdate();
            $table->foreign('id_negocio')->references('id_negocio')->on('negocios')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('negocio_estadisticas');
    }
};

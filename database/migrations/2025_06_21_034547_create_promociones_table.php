<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('promociones', function (Blueprint $table) {
            $table->id('id_promocion');
            $table->foreignId('id_negocio')->constrained('negocios', 'id_negocio');
            $table->string('titulo', 100);
            $table->text('descripcion');
            $table->decimal('descuento', 5, 2);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->boolean('activa')->default(true);
            $table->timestamp('creado_en')->useCurrent();
            $table->timestamp('actualizado_en')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promociones');
    }
};

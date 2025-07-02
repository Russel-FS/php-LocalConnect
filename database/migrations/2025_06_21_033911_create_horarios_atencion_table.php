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
        Schema::create('horarios_atencion', function (Blueprint $table) {
            $table->id('id_horario');
            $table->foreignId('id_negocio')->constrained('negocios', 'id_negocio');
            $table->enum('dia_semana', ['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado', 'domingo']);
            $table->time('hora_apertura')->nullable();
            $table->time('hora_cierre')->nullable();
            $table->boolean('cerrado')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios_atencion');
    }
};

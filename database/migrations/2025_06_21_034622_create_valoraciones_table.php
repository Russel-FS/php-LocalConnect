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
        Schema::create('valoraciones', function (Blueprint $table) {
            $table->id('id_valoracion');
            $table->foreignId('id_negocio')->constrained('negocios', 'id_negocio');
            $table->foreignId('id_usuario')->constrained('usuarios', 'id_usuario');
            $table->integer('puntuacion');
            $table->text('comentario')->nullable();
            $table->timestamp('creado_en')->useCurrent();
            $table->timestamp('actualizado_en')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('valoraciones');
    }
};

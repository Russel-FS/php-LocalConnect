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
        Schema::create('servicios_predefinidos', function (Blueprint $table) {
            $table->id('id_servicio_predefinido');
            $table->foreignId('id_categoria_servicio')->constrained('categorias_servicio', 'id_categoria_servicio');
            $table->string('nombre_servicio', 100);
            $table->string('descripcion', 255)->nullable();
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicios_predefinidos');
    }
};

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
        Schema::create('caracteristicas', function (Blueprint $table) {
            $table->id('id_caracteristica');
            $table->unsignedBigInteger('id_categoria_caracteristica')->nullable();
            $table->string('nombre', 100);
            $table->text('descripcion')->nullable();
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->timestamps();

            // Índices y restricciones
            $table->unique('nombre');
            $table->foreign('id_categoria_caracteristica')
                ->references('id_categoria_caracteristica')
                ->on('categorias_caracteristica')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caracteristicas');
    }
};

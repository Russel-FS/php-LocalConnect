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
        Schema::create('negocio_caracteristica', function (Blueprint $table) {
            $table->unsignedBigInteger('id_negocio');
            $table->unsignedBigInteger('id_caracteristica');

            // Clave primaria compuesta
            $table->primary(['id_negocio', 'id_caracteristica']);

            // Claves foráneas
            $table->foreign('id_negocio')
                ->references('id_negocio')
                ->on('negocios')
                ->onDelete('cascade');

            $table->foreign('id_caracteristica')
                ->references('id_caracteristica')
                ->on('caracteristicas')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('negocio_caracteristica');
    }
};

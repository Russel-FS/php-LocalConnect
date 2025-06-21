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
        Schema::create('negocio_servicio_predefinidos', function (Blueprint $table) {
            $table->foreignId('id_negocio')->constrained('negocios', 'id_negocio');
            $table->foreignId('id_servicio_predefinido')->constrained('servicios_predefinidos', 'id_servicio_predefinido');
            $table->decimal('precio', 10, 2)->nullable();
            $table->boolean('disponible')->default(true);
            $table->primary(['id_negocio', 'id_servicio_predefinido']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('negocio_servicio_predefinidos');
    }
};

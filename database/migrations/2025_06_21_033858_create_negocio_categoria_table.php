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
        Schema::create('negocio_categoria', function (Blueprint $table) {
            $table->foreignId('id_negocio')->constrained('negocios', 'id_negocio');
            $table->foreignId('id_categoria')->constrained('categorias', 'id_categoria');
            $table->primary(['id_negocio', 'id_categoria']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('negocio_categoria');
    }
};

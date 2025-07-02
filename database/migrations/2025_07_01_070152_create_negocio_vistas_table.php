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
        Schema::create('negocio_vistas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_negocio');
            $table->string('tipo_vista', 20);
            $table->unsignedBigInteger('id_usuario')->nullable();
            $table->timestamps();
            $table->foreign('id_negocio')->references('id_negocio')->on('negocios')->onDelete('cascade');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('negocio_vistas');
    }
};

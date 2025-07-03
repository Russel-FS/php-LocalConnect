<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('categorias')->where('estado', 'inactivo')->update(['estado' => 'suspendido']);

        DB::statement("ALTER TABLE categorias MODIFY COLUMN estado ENUM('activo', 'suspendido', 'eliminado') DEFAULT 'activo'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('categorias')->where('estado', 'suspendido')->update(['estado' => 'inactivo']);

        DB::statement("ALTER TABLE categorias MODIFY COLUMN estado ENUM('activo', 'inactivo') DEFAULT 'activo'");
    }
};

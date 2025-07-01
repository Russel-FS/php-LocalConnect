<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // negocio_megusta
        Schema::table('negocio_megusta', function (Blueprint $table) {
            $table->renameColumn('creado_en', 'created_at');
            $table->timestamp('updated_at')->nullable()->after('created_at');
        });
        // negocio_favoritos
        Schema::table('negocio_favoritos', function (Blueprint $table) {
            $table->renameColumn('creado_en', 'created_at');
            $table->timestamp('updated_at')->nullable()->after('created_at');
        });
    }

    public function down(): void
    {
        // negocio_megusta
        Schema::table('negocio_megusta', function (Blueprint $table) {
            $table->renameColumn('created_at', 'creado_en');
            $table->dropColumn('updated_at');
        });
        // negocio_favoritos
        Schema::table('negocio_favoritos', function (Blueprint $table) {
            $table->renameColumn('created_at', 'creado_en');
            $table->dropColumn('updated_at');
        });
    }
};

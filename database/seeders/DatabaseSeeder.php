<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolSeeder::class,
        ]);

        // Insertar roles básicos
        DB::table('roles')->insert([
            [
                'code' => 'residente',
                'name' => 'Residente',
                'descripcion' => 'Usuarios que viven en la comunidad y buscan servicios locales',
                'estado' => 'activo',
                'creado_en' => now(),
                'actualizado_en' => now(),
            ],
            [
                'code' => 'negocio',
                'name' => 'Negocio',
                'descripcion' => 'Empresas y comercios que ofrecen servicios en la comunidad',
                'estado' => 'activo',
                'creado_en' => now(),
                'actualizado_en' => now(),
            ],
            [
                'code' => 'admin',
                'name' => 'Administrador',
                'descripcion' => 'Usuarios con permisos administrativos del sistema',
                'estado' => 'activo',
                'creado_en' => now(),
                'actualizado_en' => now(),
            ],
        ]);


        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}

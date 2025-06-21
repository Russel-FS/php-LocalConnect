<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'code' => 'admin',
                'name' => 'Administrador',
                'descripcion' => 'Usuario con acceso completo al sistema',
                'estado' => 'activo'
            ],
            [
                'code' => 'residente',
                'name' => 'Residente',
                'descripcion' => 'Usuario que puede buscar y valorar negocios',
                'estado' => 'activo'
            ],
            [
                'code' => 'negocio',
                'name' => 'Negocio',
                'descripcion' => 'Usuario que puede registrar y gestionar negocios',
                'estado' => 'activo'
            ]
        ];

        foreach ($roles as $rol) {
            DB::table('roles')->updateOrInsert(
                ['code' => $rol['code']],
                $rol
            );
        }
    }
}

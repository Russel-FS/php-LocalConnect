<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Negocio\Categoria;
use App\Models\Negocio\Caracteristica;
use App\Models\Negocio\CategoriaCaracteristica;
use App\Models\Negocio\CategoriaServicio;
use App\Models\Negocio\ServicioPredefinido;

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


        // obtener rol administrador
        $rolAdministrador = DB::table('roles')->where('code', 'admin')->first();

        // creacion de usuario por defecto
        User::factory()->create([
            'name' => 'administrador',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'telefono' => '123456789',
            'id_rol' => $rolAdministrador->id_rol,
            'estado' => 'activo'
        ]);

        // Crear categorías de características
        $categoriaCaracteristica = CategoriaCaracteristica::create([
            'nombre_categoria' => 'Servicios',
            'descripcion' => 'Características relacionadas con servicios',
            'estado' => 'activo'
        ]);

        // Crear características
        Caracteristica::create([
            'id_categoria_caracteristica' => $categoriaCaracteristica->id_categoria_caracteristica,
            'nombre' => 'Atención 24/7',
            'descripcion' => 'Servicio disponible las 24 horas',
            'estado' => 'activo'
        ]);

        Caracteristica::create([
            'id_categoria_caracteristica' => $categoriaCaracteristica->id_categoria_caracteristica,
            'nombre' => 'Delivery',
            'descripcion' => 'Servicio a domicilio',
            'estado' => 'activo'
        ]);

        Caracteristica::create([
            'id_categoria_caracteristica' => $categoriaCaracteristica->id_categoria_caracteristica,
            'nombre' => 'Estacionamiento',
            'descripcion' => 'Estacionamiento disponible',
            'estado' => 'activo'
        ]);

        Caracteristica::create([
            'id_categoria_caracteristica' => $categoriaCaracteristica->id_categoria_caracteristica,
            'nombre' => 'WiFi gratuito',
            'descripcion' => 'Conexión WiFi gratuita',
            'estado' => 'activo'
        ]);

        // Crear categorías
        Categoria::create([
            'nombre_categoria' => 'Restaurantes',
            'descripcion' => 'Restaurantes y lugares de comida',
            'estado' => 'activo'
        ]);

        Categoria::create([
            'nombre_categoria' => 'Peluquerías',
            'descripcion' => 'Salones de belleza y peluquerías',
            'estado' => 'activo'
        ]);

        Categoria::create([
            'nombre_categoria' => 'Talleres Mecánicos',
            'descripcion' => 'Servicios automotrices',
            'estado' => 'activo'
        ]);

        Categoria::create([
            'nombre_categoria' => 'Farmacias',
            'descripcion' => 'Farmacias y boticas',
            'estado' => 'activo'
        ]);

        Categoria::create([
            'nombre_categoria' => 'Tiendas',
            'descripcion' => 'Tiendas y comercios',
            'estado' => 'activo'
        ]);

        Categoria::create([
            'nombre_categoria' => 'Servicios Profesionales',
            'descripcion' => 'Abogados, contadores, etc.',
            'estado' => 'activo'
        ]);

        // Crear categorías de servicios
        $categoriaServicio1 = CategoriaServicio::create([
            'nombre_categoria_servicio' => 'Servicios de Belleza',
            'descripcion' => 'Servicios relacionados con belleza y cuidado personal',
            'estado' => 'activo'
        ]);

        $categoriaServicio2 = CategoriaServicio::create([
            'nombre_categoria_servicio' => 'Servicios Automotrices',
            'descripcion' => 'Servicios para vehículos',
            'estado' => 'activo'
        ]);

        $categoriaServicio3 = CategoriaServicio::create([
            'nombre_categoria_servicio' => 'Servicios de Alimentación',
            'descripcion' => 'Servicios de comida y bebidas',
            'estado' => 'activo'
        ]);

        // Crear servicios predefinidos
        ServicioPredefinido::create([
            'id_categoria_servicio' => $categoriaServicio1->id_categoria_servicio,
            'nombre_servicio' => 'Corte de pelo',
            'descripcion' => 'Corte de cabello profesional'
        ]);

        ServicioPredefinido::create([
            'id_categoria_servicio' => $categoriaServicio1->id_categoria_servicio,
            'nombre_servicio' => 'Tinte de cabello',
            'descripcion' => 'Coloración de cabello'
        ]);

        ServicioPredefinido::create([
            'id_categoria_servicio' => $categoriaServicio1->id_categoria_servicio,
            'nombre_servicio' => 'Manicure',
            'descripcion' => 'Cuidado de uñas'
        ]);

        ServicioPredefinido::create([
            'id_categoria_servicio' => $categoriaServicio2->id_categoria_servicio,
            'nombre_servicio' => 'Cambio de aceite',
            'descripcion' => 'Cambio de aceite del motor'
        ]);

        ServicioPredefinido::create([
            'id_categoria_servicio' => $categoriaServicio2->id_categoria_servicio,
            'nombre_servicio' => 'Alineación',
            'descripcion' => 'Alineación de ruedas'
        ]);

        ServicioPredefinido::create([
            'id_categoria_servicio' => $categoriaServicio2->id_categoria_servicio,
            'nombre_servicio' => 'Frenos',
            'descripcion' => 'Servicio de frenos'
        ]);

        ServicioPredefinido::create([
            'id_categoria_servicio' => $categoriaServicio3->id_categoria_servicio,
            'nombre_servicio' => 'Delivery',
            'descripcion' => 'Entrega a domicilio'
        ]);

        ServicioPredefinido::create([
            'id_categoria_servicio' => $categoriaServicio3->id_categoria_servicio,
            'nombre_servicio' => 'Reservas',
            'descripcion' => 'Reservas de mesa'
        ]);
    }
}

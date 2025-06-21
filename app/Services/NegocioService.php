<?php

namespace App\Services;

use App\Models\Negocio\Negocio;
use App\Models\Negocio\Ubicacion;
use App\Models\Negocio\HorarioAtencion;
use App\Models\Negocio\ServicioPersonalizado;
use App\Models\Negocio\Categoria;
use App\Models\Negocio\ServicioPredefinido;
use App\Models\Negocio\CategoriaServicio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Exception;

class NegocioService
{
    /**
     * Registrar un nuevo negocio con toda su información
     */
    public function registrarNegocio(array $data, $userId)
    {
        // Validar datos de entrada
        $validator = Validator::make($data, [
            'nombre_negocio' => 'required|string|max:100',
            'descripcion_negocio' => 'required|string',
            'imagen_portada' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',

            // Ubicación
            'direccion' => 'required|string|max:255',
            'pais' => 'required|string|max:100',
            'latitud' => 'required|numeric|between:-90,90',
            'longitud' => 'required|numeric|between:-180,180',

            // Categorías
            'categorias' => 'required|array|min:1',
            'categorias.*' => 'exists:categorias,id_categoria',

            // Servicios predefinidos  
            'servicios_predefinidos' => 'nullable|array',
            'servicios_predefinidos.*' => 'exists:servicios_predefinidos,id_servicio_predefinido',

            // Servicios personalizados  
            'servicios_personalizados' => 'nullable|array',
            'servicios_personalizados.nombre' => 'nullable|array',
            'servicios_personalizados.nombre.*' => 'string|max:100',
            'servicios_personalizados.descripcion' => 'nullable|array',
            'servicios_personalizados.descripcion.*' => 'nullable|string',
            'servicios_personalizados.precio' => 'nullable|array',
            'servicios_personalizados.precio.*' => 'nullable|numeric|min:0',

            // Horarios
            'horarios' => 'required|array|size:7',
            'horarios.*.inicio' => 'required_if:horarios.*.cerrado,0|nullable|date_format:H:i',
            'horarios.*.fin' => 'required_if:horarios.*.cerrado,0|nullable|date_format:H:i|after:horarios.*.inicio',
            'horarios.*.cerrado' => 'required|boolean',

            // Contactos
            'telefono' => 'required|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'web' => 'nullable|url|max:255',
        ], [
            'nombre_negocio.required' => 'El nombre del negocio es obligatorio.',
            'descripcion_negocio.required' => 'La descripción del negocio es obligatoria.',
            'imagen_portada.required' => 'La imagen de portada es obligatoria.',
            'imagen_portada.image' => 'El archivo debe ser una imagen.',
            'imagen_portada.max' => 'La imagen no puede superar los 10MB.',
            'direccion.required' => 'La dirección es obligatoria.',
            'pais.required' => 'El país es obligatorio.',
            'latitud.required' => 'Debe seleccionar una ubicación en el mapa.',
            'longitud.required' => 'Debe seleccionar una ubicación en el mapa.',
            'categorias.required' => 'Debe seleccionar al menos una categoría.',
            'categorias.min' => 'Debe seleccionar al menos una categoría.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'horarios.required' => 'Debe configurar los horarios de atención.',
            'horarios.size' => 'Debe configurar los horarios para todos los días de la semana.',
            'web.url' => 'El sitio web debe ser una URL válida (ej: https://mi-negocio.com).',
            'horarios.*.inicio.required_if' => 'Debes ingresar la hora de inicio para cada día abierto.',
            'horarios.*.fin.required_if' => 'Debes ingresar la hora de fin para cada día abierto.',
            'horarios.*.fin.after' => 'La hora de fin debe ser mayor que la de inicio para cada día abierto.',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return DB::transaction(function () use ($data, $userId) {
            // Guardar imagen de portada
            $imagenPath = $this->guardarImagen($data['imagen_portada']);

            // Crear ubicación
            $ubicacion = Ubicacion::create([
                'direccion' => $data['direccion'],
                'distrito' => $data['distrito'] ?? '',
                'ciudad' => $data['ciudad'] ?? '',
                'provincia' => $data['provincia'] ?? '',
                'departamento' => $data['departamento'] ?? '',
                'pais' => $data['pais'],
                'latitud' => $data['latitud'],
                'longitud' => $data['longitud']
            ]);

            // Crear negocio
            $negocio = Negocio::create([
                'id_usuario' => $userId,
                'id_ubicacion' => $ubicacion->id_ubicacion,
                'nombre_negocio' => $data['nombre_negocio'],
                'descripcion' => $data['descripcion_negocio'],
                'verificado' => false,
                'imagen_portada' => $imagenPath
            ]);

            //Asociar categorías
            if (isset($data['categorias'])) {
                $negocio->categorias()->attach($data['categorias']);
            }

            //Asociar servicios predefinidos
            if (isset($data['servicios_predefinidos']) && !empty($data['servicios_predefinidos'])) {
                $negocio->serviciosPredefinidos()->attach($data['servicios_predefinidos']);
            }

            // Crear servicios personalizados
            if (isset($data['servicios_personalizados']['nombre']) && !empty($data['servicios_personalizados']['nombre'])) {
                $this->crearServiciosPersonalizados($negocio->id_negocio, $data['servicios_personalizados']);
            }

            //Crear horarios de atención
            $this->crearHorariosAtencion($negocio->id_negocio, $data['horarios']);

            // Crear contactos
            $this->crearContactos($negocio->id_negocio, $data);

            return $negocio->load(['ubicacion', 'categorias', 'serviciosPredefinidos', 'serviciosPersonalizados', 'horarios']);
        });
    }

    /**
     * Guardar imagen de portada
     */
    private function guardarImagen($imagen)
    {
        $nombreArchivo = time() . '_' . $imagen->getClientOriginalName();
        $ruta = $imagen->storeAs('negocios/portadas', $nombreArchivo, 'public');
        return $ruta;
    }

    /**
     * Crear servicios personalizados
     */
    private function crearServiciosPersonalizados($negocioId, $serviciosData)
    {
        $nombres = $serviciosData['nombre'] ?? [];
        $descripciones = $serviciosData['descripcion'] ?? [];
        $precios = $serviciosData['precio'] ?? [];

        foreach ($nombres as $index => $nombre) {
            if (!empty($nombre)) {
                ServicioPersonalizado::create([
                    'id_negocio' => $negocioId,
                    'nombre_servicio' => $nombre,
                    'descripcion' => $descripciones[$index] ?? null,
                    'precio' => $precios[$index] ?? null,
                    'disponible' => true
                ]);
            }
        }
    }

    /**
     * Crear horarios de atención
     */
    private function crearHorariosAtencion($negocioId, $horariosData)
    {
        $dias = ['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado', 'domingo'];

        foreach ($dias as $index => $dia) {
            $horario = $horariosData[$index] ?? [];
            $cerrado = filter_var($horario['cerrado'] ?? false, FILTER_VALIDATE_BOOLEAN);

            HorarioAtencion::create([
                'id_negocio' => $negocioId,
                'dia_semana' => $dia,
                'hora_apertura' => $cerrado ? null : ($horario['inicio'] ?? null),
                'hora_cierre' => $cerrado ? null : ($horario['fin'] ?? null),
                'cerrado' => $cerrado
            ]);
        }
    }

    /**
     * Crear contactos del negocio
     */
    private function crearContactos($negocioId, $data)
    {
        $contactos = [
            'telefono' => $data['telefono'] ?? null,
            'whatsapp' => $data['whatsapp'] ?? null,
            'facebook' => $data['facebook'] ?? null,
            'instagram' => $data['instagram'] ?? null,
            'web' => $data['web'] ?? null
        ];

        foreach ($contactos as $tipo => $valor) {
            if (!empty($valor)) {
                DB::table('contactos')->insert([
                    'id_negocio' => $negocioId,
                    'tipo_contacto' => $tipo,
                    'valor_contacto' => $valor,
                    'activo' => true,
                ]);
            }
        }
    }

    /**
     * Obtener negocio por ID con todas sus relaciones
     */
    public function obtenerNegocio($id)
    {
        return Negocio::with([
            'ubicacion',
            'categorias',
            'serviciosPredefinidos',
            'serviciosPersonalizados',
            'horarios',
            'contactos'
        ])->findOrFail($id);
    }

    /**
     * Obtener todos los negocios del usuario
     */
    public function obtenerNegociosUsuario($userId)
    {
        return Negocio::with(['ubicacion', 'categorias'])
            ->where('id_usuario', $userId)
            ->get();
    }
}

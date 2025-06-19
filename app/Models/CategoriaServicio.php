<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaServicio extends Model
{
    protected $table = 'categorias_servicio';
    protected $primaryKey = 'id_categoria_servicio';
    public $timestamps = true;

    protected $fillable = [
        'nombre_categoria_servicio',
        'descripcion',
        'estado',
        'creado_en',
        'actualizado_en',
    ];

    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';
    protected $primaryKey = 'id_categoria';
    public $timestamps = true;

    protected $fillable = [
        'nombre_categoria',
        'descripcion',
        'estado',
        'creado_en',
        'actualizado_en',
    ];

    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';
}

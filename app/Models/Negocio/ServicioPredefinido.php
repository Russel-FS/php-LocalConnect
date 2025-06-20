<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicioPredefinido extends Model
{
    protected $table = 'servicios_predefinidos';
    protected $primaryKey = 'id_servicio_predefinido';
    public $timestamps = false;

    protected $fillable = [
        'id_categoria',
        'nombre_servicio',
        'descripcion',
    ];

    public function categoriaServicio()
    {
        return $this->belongsTo(CategoriaServicio::class, 'id_categoria_servicio', 'id_categoria_servicio');
    }
}

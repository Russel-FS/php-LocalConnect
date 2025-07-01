<?php

namespace App\Models\Negocio;

use App\Models\Negocio\ServicioPredefinido;
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
    ];

    const CREATED_AT = 'creado_en';

    public function serviciosPredefinidos()
    {
        return $this->hasMany(ServicioPredefinido::class, 'id_categoria_servicio', 'id_categoria_servicio');
    }
}

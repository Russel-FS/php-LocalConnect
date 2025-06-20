<?php

namespace App\Models\Negocio;

use Illuminate\Database\Eloquent\Model;
use App\Models\Negocio\Ubicacion;
use App\Models\Negocio\Categoria;
use App\Models\Negocio\HorarioAtencion;
use App\Models\Negocio\ServicioPersonalizado;

class Negocio extends Model
{
    protected $table = 'negocios';
    protected $primaryKey = 'id_negocio';
    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'id_ubicacion',
        'nombre_negocio',
        'descripcion',
        'verificado',
        'imagen_portada'
    ];

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'id_ubicacion');
    }

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'negocio_categoria', 'id_negocio', 'id_categoria');
    }

    public function horarios()
    {
        return $this->hasMany(HorarioAtencion::class, 'id_negocio');
    }

    public function serviciosPersonalizados()
    {
        return $this->hasMany(ServicioPersonalizado::class, 'id_negocio');
    }
}

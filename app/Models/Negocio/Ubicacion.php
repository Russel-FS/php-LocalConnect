<?php

namespace App\Models\Negocio;

use Illuminate\Database\Eloquent\Model;
use App\Models\Negocio\Negocio;

class Ubicacion extends Model
{
    protected $table = 'ubicaciones';
    protected $primaryKey = 'id_ubicacion';
    public $timestamps = false;

    protected $fillable = [
        'direccion',
        'distrito',
        'ciudad',
        'provincia',
        'departamento',
        'pais',
        'latitud',
        'longitud'
    ];

    public function negocios()
    {
        return $this->hasMany(Negocio::class, 'id_ubicacion');
    }
}

<?php

namespace App\Models\Negocio;

use Illuminate\Database\Eloquent\Model;

class ServicioPersonalizado extends Model
{
    protected $table = 'servicios_personalizados';
    protected $primaryKey = 'id_servicio';
    public $timestamps = false;

    protected $fillable = [
        'id_negocio',
        'nombre_servicio',
        'descripcion',
        'precio',
        'disponible'
    ];

    public function negocio()
    {
        return $this->belongsTo(Negocio::class, 'id_negocio');
    }
}

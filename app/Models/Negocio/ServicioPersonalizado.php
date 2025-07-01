<?php

namespace App\Models\Negocio;

use Illuminate\Database\Eloquent\Model;

class ServicioPersonalizado extends Model
{
    protected $table = 'servicios_personalizados';
    protected $primaryKey = 'id_servicio';

    protected $fillable = [
        'id_negocio',
        'nombre_servicio',
        'descripcion',
        'precio',
        'disponible'
    ];

    /**
     * Relación uno a muchos con Negocio
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function negocio()
    {
        return $this->belongsTo(Negocio::class, 'id_negocio');
    }
}

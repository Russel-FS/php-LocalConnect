<?php

namespace App\Models\Negocio;

use Illuminate\Database\Eloquent\Model;

class Estadistica extends Model
{
    protected $table = 'negocio_estadisticas';
    protected $primaryKey = 'id_estadistica';
    public $timestamps = false;

    protected $fillable = [
        'id_negocio',
        'vistas_busqueda',
        'vistas_detalle',
        'actualizado_en',
    ];

    public function negocio()
    {
        return $this->belongsTo(Negocio::class, 'id_negocio');
    }
}

<?php

namespace App\Models\Negocio;

use Illuminate\Database\Eloquent\Model;

class HorarioAtencion extends Model
{
    protected $table = 'horarios_atencion';
    protected $primaryKey = 'id_horario';

    protected $fillable = [
        'id_negocio',
        'dia_semana',
        'hora_apertura',
        'hora_cierre',
        'cerrado'
    ];

    protected $casts = [
        'hora_apertura' => 'datetime:H:i',
        'hora_cierre' => 'datetime:H:i',
        'cerrado' => 'boolean'
    ];

    public function negocio()
    {
        return $this->belongsTo(Negocio::class, 'id_negocio');
    }
}

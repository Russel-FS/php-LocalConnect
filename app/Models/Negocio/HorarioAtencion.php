<?php

namespace App\Models\Negocio;

use Illuminate\Database\Eloquent\Model;

class HorarioAtencion extends Model
{
    protected $table = 'horarios_atencion';
    protected $primaryKey = 'id_horario';
    public $timestamps = false;

    protected $fillable = [
        'id_negocio',
        'dia_semana',
        'hora_apertura',
        'hora_cierre',
        'cerrado'
    ];

    public function negocio()
    {
        return $this->belongsTo(Negocio::class, 'id_negocio');
    }
}

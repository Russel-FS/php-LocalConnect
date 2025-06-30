<?php

namespace App\Models\Negocio;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Valoracion extends Model
{
    protected $table = 'valoraciones';
    protected $primaryKey = 'id_valoracion';
    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'id_negocio',
        'calificacion',
        'comentario',
        'fecha_valoracion',
    ];

    public function negocio()
    {
        return $this->belongsTo(Negocio::class, 'id_negocio');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}

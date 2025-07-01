<?php

namespace App\Models\Negocio;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class NegocioVista extends Model
{
    protected $table = 'negocio_vistas';

    protected $fillable = [
        'id_negocio',
        'tipo_vista',
        'id_usuario',
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

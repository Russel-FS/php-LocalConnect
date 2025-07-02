<?php

namespace App\Models\Negocio;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class MeGusta extends Model
{
    protected $table = 'negocio_megusta';
    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'id_usuario',
        'id_negocio',
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

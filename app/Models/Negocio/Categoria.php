<?php

namespace App\Models\Negocio;

use App\Models\Negocio\Negocio;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';
    protected $primaryKey = 'id_categoria';

    protected $fillable = [
        'nombre_categoria',
        'descripcion',
        'img_url',
        'estado',
    ];

    public function negocios()
    {
        return $this->belongsToMany(Negocio::class, 'negocio_categoria', 'id_categoria', 'id_negocio');
    }
}

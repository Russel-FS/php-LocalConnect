<?php

namespace App\Models\Negocio;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';
    protected $primaryKey = 'id_categoria';
    public $timestamps = false;

    protected $fillable = [
        'nombre_categoria',
        'descripcion',
        'estado'
    ];

    public function negocios()
    {
        return $this->belongsToMany(Negocio::class, 'negocio_categoria', 'id_categoria', 'id_negocio');
    }
}

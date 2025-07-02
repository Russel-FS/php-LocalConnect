<?php

namespace App\Models\Negocio;

use Illuminate\Database\Eloquent\Model;

class CategoriaCaracteristica extends Model
{
    protected $table = 'categorias_caracteristica';
    protected $primaryKey = 'id_categoria_caracteristica';
    protected $fillable = [
        'nombre_categoria',
        'descripcion',
        'estado'
    ];

    /**
     * Relación uno a muchos con Caracteristica
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function caracteristicas()
    {
        return $this->hasMany(Caracteristica::class, 'id_categoria_caracteristica');
    }
}

<?php

namespace App\Models\Negocio;

use Illuminate\Database\Eloquent\Model;

class Caracteristica extends Model
{
    protected $table = 'caracteristicas';
    protected $primaryKey = 'id_caracteristica';
    protected $fillable = [
        'id_categoria_caracteristica',
        'nombre',
        'descripcion',
        'estado'
    ];

    /**
     * Relación muchos a uno con CategoriaCaracteristica
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoria()
    {
        return $this->belongsTo(CategoriaCaracteristica::class, 'id_categoria_caracteristica');
    }

    /**
     * Relación muchos a muchos con Negocio
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function negocios()
    {
        return $this->belongsToMany(Negocio::class, 'negocio_caracteristica', 'id_caracteristica', 'id_negocio');
    }
}

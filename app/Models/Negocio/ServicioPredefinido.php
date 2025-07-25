<?php

namespace App\Models\Negocio;

use App\Models\Negocio\Negocio;
use Illuminate\Database\Eloquent\Model;

class ServicioPredefinido extends Model
{
    protected $table = 'servicios_predefinidos';
    protected $primaryKey = 'id_servicio_predefinido';

    protected $fillable = [
        'id_categoria_servicio',
        'nombre_servicio',
        'descripcion',
        'estado',
    ];

    /**
     * Relación uno a muchos con CategoriaServicio
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoriaServicio()
    {
        return $this->belongsTo(CategoriaServicio::class, 'id_categoria_servicio', 'id_categoria_servicio');
    }


    /**
     * Relación muchos a muchos con Negocio
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function negocios()
    {
        return $this->belongsToMany(
            Negocio::class,
            'negocio_servicio_predefinidos',
            'id_servicio_predefinido',
            'id_negocio'
        );
    }
}

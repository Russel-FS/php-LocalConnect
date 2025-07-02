<?php

namespace App\Models\Negocio;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $table = 'contactos';
    protected $primaryKey = 'id_contacto';

    protected $fillable = [
        'id_negocio',
        'tipo_contacto',
        'valor_contacto',
        'activo',

    ];

    /**
     * Relación con Negocio
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function negocio()
    {
        return $this->belongsTo(Negocio::class, 'id_negocio');
    }
}

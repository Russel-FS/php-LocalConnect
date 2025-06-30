<?php

namespace App\Models\Negocio;

use App\Models\Negocio\Categoria;
use Illuminate\Database\Eloquent\Model;
use App\Models\Negocio\Ubicacion;
use App\Models\Negocio\HorarioAtencion;
use App\Models\Negocio\ServicioPersonalizado;
use App\Models\Negocio\ServicioPredefinido;
use App\Models\Negocio\Caracteristica;
use App\Models\User;
use App\Models\Negocio\Estadistica;
use App\Models\Negocio\Favorito;
use App\Models\Negocio\Valoracion;

class Negocio extends Model
{
    protected $table = 'negocios';
    protected $primaryKey = 'id_negocio';
    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'id_ubicacion',
        'nombre_negocio',
        'descripcion',
        'verificado',
        'imagen_portada'
    ];


    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
    /**
     * Relación uno a muchos con Ubicacion
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'id_ubicacion');
    }
    /**
     * Relación uno a muchos con HorarioAtencion
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function horarios()
    {
        return $this->hasMany(HorarioAtencion::class, 'id_negocio');
    }


    /**
     *  Relación de muchos a muchos con Categoria
     * 
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'negocio_categoria', 'id_negocio', 'id_categoria');
    }

    /**
     * Relación uno a muchos con ServicioPersonalizado
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function serviciosPersonalizados()
    {
        return $this->hasMany(ServicioPersonalizado::class, 'id_negocio');
    }

    /**
     * Relación muchos a muchos con ServicioPredefinido
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function serviciosPredefinidos()
    {
        return $this->belongsToMany(
            ServicioPredefinido::class,
            'negocio_servicio_predefinidos',
            'id_negocio',
            'id_servicio_predefinido'
        );
    }

    /**
     * Relación con contactos del negocio
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contactos()
    {
        return $this->hasMany(\App\Models\Negocio\Contacto::class, 'id_negocio');
    }

    /**
     * Relación muchos a muchos con Caracteristica
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function caracteristicas()
    {
        return $this->belongsToMany(Caracteristica::class, 'negocio_caracteristica', 'id_negocio', 'id_caracteristica');
    }

    public function estadistica()
    {
        return $this->hasOne(Estadistica::class, 'id_negocio');
    }

    public function favoritos()
    {
        return $this->hasMany(Favorito::class, 'id_negocio');
    }

    public function valoraciones()
    {
        return $this->hasMany(Valoracion::class, 'id_negocio');
    }
}

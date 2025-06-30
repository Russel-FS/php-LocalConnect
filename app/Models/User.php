<?php

namespace App\Models;

use App\Models\Negocio\Negocio;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'telefono',
        'id_rol',
        'estado',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'estado' => 'string',
    ];

    /**
     * Relación muchos a uno con Rol
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }

    /**
     * Relación uno a muchos con Negocio
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function negocios()
    {
        return $this->hasMany(Negocio::class, 'id_usuario');
    }

    /**
     * Obtener el código del rol del usuario
     * 
     * @return string|null
     */
    public function getRolCode()
    {
        return $this->rol ? $this->rol->code : null;
    }

    /**
     * Obtener el nombre del rol del usuario
     * 
     * @return string|null
     */
    public function getRolName()
    {
        return $this->rol ? $this->rol->name : null;
    }

    /**
     * Verificar si el usuario es de tipo negocio
     * 
     * @return bool
     */
    public function isNegocio()
    {
        return $this->getRolCode() === 'negocio';
    }

    /**
     * Verificar si el usuario es de tipo residente
     * 
     * @return bool
     */
    public function isResidente()
    {
        return $this->getRolCode() === 'residente';
    }

    /**
     * Verificar si el usuario es administrador
     * 
     * @return bool
     */
    public function isAdmin()
    {
        return $this->getRolCode() === 'admin';
    }

    /**
     * Verificar si el usuario está activo
     * 
     * @return bool
     */
    public function isActivo()
    {
        return $this->estado === 'activo';
    }

    /**
     * Scope para usuarios activos
     */
    public function scopeActivos($query)
    {
        return $query->where('estado', 'activo');
    }

    /**
     * Scope para usuarios por rol
     */
    public function scopePorRol($query, $rolCode)
    {
        return $query->whereHas('rol', function ($q) use ($rolCode) {
            $q->where('code', $rolCode);
        });
    }

    /**
     * Relación uno a muchos con Favorito
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favoritos()
    {
        return $this->hasMany(\App\Models\Negocio\Favorito::class, 'id_usuario');
    }

    /**
     * Relación uno a muchos con Valoracion
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function valoraciones()
    {
        return $this->hasMany(\App\Models\Negocio\Valoracion::class, 'id_usuario');
    }
}

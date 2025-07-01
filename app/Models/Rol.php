<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id_rol';
    public $timestamps = false;

    protected $fillable = [
        'code',
        'name',
        'descripcion',
        'estado'
    ];

    /**
     * Relación uno a muchos con Usuario
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usuarios()
    {
        return $this->hasMany(User::class, 'id_rol');
    }

    /**
     * Scope para roles activos
     */
    public function scopeActivos($query)
    {
        return $query->where('estado', 'activo');
    }

    /**
     * Buscar rol por código
     */
    public static function findByCode($code)
    {
        return static::where('code', $code)->first();
    }

    /**
     * Verificar si el rol es de negocio
     */
    public function isNegocio()
    {
        return $this->code === 'negocio';
    }

    /**
     * Verificar si el rol es de residente
     */
    public function isResidente()
    {
        return $this->code === 'residente';
    }

    /**
     * Verificar si el rol es de administrador
     */
    public function isAdmin()
    {
        return $this->code === 'admin';
    }
}

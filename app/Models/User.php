<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'nombre',
        'email',
        'contraseña',
        'telefono',
        'tipo',
        'estado'
    ];

    protected $hidden = [
        'contraseña',
        'remember_token',
    ];

    protected $casts = [
        'fecha_registro' => 'datetime',
        'contraseña' => 'hashed',
        'tipo' => 'string',
        'estado' => 'string'
    ];

    // Relación con negocios (si el usuario es de tipo 'negocio')
    public function negocio()
    {
        return $this->hasOne(Negocio::class, 'id_usuario');
    }

    // Relación con valoraciones hechas por el usuario
    public function valoraciones()
    {
        return $this->hasMany(Valoracion::class, 'id_usuario');
    }

    // Método helper para verificar el tipo de usuario
    public function isNegocio()
    {
        return $this->tipo === 'negocio';
    }

    public function isAdmin()
    {
        return $this->tipo === 'admin';
    }

    public function isResidente()
    {
        return $this->tipo === 'residente';
    }
}

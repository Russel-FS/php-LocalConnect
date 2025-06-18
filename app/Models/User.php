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


}
